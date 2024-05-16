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
        if (!$conversation) {
            $conversation = new Conversation([
                'user_id' => auth()->id(),
                'role' => 'user',
                'tool_identifier' => $toolIdentifier,
            ]);

            $conversation->save();
        }

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
    public function askAi($id, Request $request)
    {
        // Make sure, $id and message content are set
        $request->validate([
            'content' => 'required',
        ]);

        // Get the conversation by the id
        $conversation = Conversation::find($id);

        // Create a new message for the conversation
        $message = $conversation->messages()->create([
            'user_id' => auth()->id(),
            'role' => 'user',
            'content' => $request->input('content'),
        ]);

        $payload = $conversation->createPayload();

        $result = OpenAI::chat()->create($payload);

        # create new message for response
        $message = new Message();
        $message->user_id = auth()->user()->id;
        $message->content = $result->choices[0]->message->content;
        $message->role = 'assistant';

        # add message to conversation
        $conversation->messages()->save($message);

        // Return the message as resource
        return new MessageResource($message);
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
