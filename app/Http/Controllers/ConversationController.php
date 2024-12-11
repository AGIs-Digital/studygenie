<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Http\Resources\Conversation as ConversationResource;
use Illuminate\Support\Facades\DB;
use OpenAI\Laravel\Facades\OpenAI;
use App\Models\Message;
use App\Http\Resources\Message as MessageResource;
use App\Models\Archive;
use Carbon\Carbon;

class ConversationController extends Controller
{

    // GET /conversation/{toolIdentifier}
    public function get($toolIdentifier)
    {
        // Get the conversation by the tool identifier for the current logged in user
        $conversation = Conversation::where('tool_identifier', $toolIdentifier)
            ->where('user_id', auth()->id())
            ->first();

        // If the conversation does not exist, create a new one
        // Todo: We could redirect to /conversation/init/{toolIdentifier} here
        if (!$conversation) {
            $conversation = new Conversation([
                'user_id' => auth()->id(),
                'role' => 'user',
                'tool_identifier' => $toolIdentifier,
            ]);

            $conversation->save();
            $conversation->load('messages');
        }

        // If the conversation exists, but has no messages, we save it to
        // create the initial conversation message
        if ($conversation->messages->count() === 0) {
            $conversation->save();
        }

        // Load all messages to conversation
        $conversation->load('messages');

        // Return the conversation as resource
        return new ConversationResource($conversation);
    }

    // GET /conversation/init/{toolIdentifier}
    public function init($toolIdentifier)
    {
        // Get the conversation by the tool identifier for the current logged in user
        $conversation = Conversation::where('tool_identifier', $toolIdentifier)
            ->where('user_id', auth()->id())
            ->first();

        // If the conversation does not exist, create a new conversation
        if (!$conversation) {
            $conversation = new Conversation([
                'user_id' => auth()->id(),
                'tool_identifier' => $toolIdentifier,
            ]);
            $conversation->save();
        } else {
            // If the conversation already exists, delete all messages
            $conversation->deleteMessages();
        }

        $message = $conversation->messages()->create([
            'user_id' => auth()->id(),
            'content' => config('prompts.' . $toolIdentifier . '.first_message'),
        ]);

        // Return the conversation as resource
        return new ConversationResource($conversation);
    }

    // POST /conversation/{id}/message
    public function askAi(Conversation $conversation, Request $request)
    {
        $message = new Message();
        $message->user_id = auth()->user()->id;
        $message->role = 'user';
        $message->content = $request->content;
        $conversation->messages()->save($message);

        $payload = $conversation->createPayload();
        
        return response()->stream(function () use ($payload) {
            $stream = OpenAI::chat()->createStreamed($payload);
            
            foreach ($stream as $response) {
                $text = $response->choices[0]->delta->content;
                if (connection_aborted()) {
                    break;
                }
                echo "data: " . json_encode(['content' => $text]) . "\n\n";
                ob_flush();
                flush();
            }
        }, 200, [
            'Cache-Control' => 'no-cache',
            'X-Accel-Buffering' => 'no',
            'Content-Type' => 'text/event-stream',
        ]);
    }

    public function archive(Conversation $conversation, Request $request)
    {
        // Find the latest assistant message in conversation
        $latestAssistantMessage = $conversation->messages()->where('role', 'assistant')->latest()->first();

        $data = new Archive();
        $data->user_id = auth()->user()->id;
        $data->question = $request->save_name;
        $data->answer = $latestAssistantMessage->content;
        $data->tooltype = $request->tooltype;
        $data->type = $request->type;
        $data->save();
        return response()->json([
            'status' => '200',
            'message' => 'Nachricht gespeichert'
        ], 200);
    }

}
