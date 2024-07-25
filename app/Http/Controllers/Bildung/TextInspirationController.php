<?php

namespace App\Http\Controllers\Bildung;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Models\Message;
use App\Custom\Prompt;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Facades\Log;

class TextInspirationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('bildung.text_inspiration');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $toolIdentifier = 'text_inspiration';

            # Create a new conversation
            $conversation = new Conversation();
            $conversation->user_id = auth()->user()->id;
            $conversation->tool_identifier = $toolIdentifier;
            $conversation->save();

            # Create a new message
            $message = $this->create_message($request, $conversation);

            # add message to conversation
            $conversation->messages()->save($message);

            $payload = $conversation->createPayload();

            $response = OpenAI::chat()->create($payload);

            # create new message for response
            $message = new Message();
            $message->user_id = auth()->user()->id;
            $message->content = $response->choices[0]->message->content;
            $message->role = 'assistant';

            # add message to conversation
            $conversation->messages()->save($message);

            return response()->json([
                "status" => true,
                "message" => $message->toArray()
            ]);
        } catch (\Exception $e) {

            Log::error("TextInspiration: " . $e->getMessage());
            print($e->getMessage());
            return response()->json([
                "status" => false,
                "error" => "Ein Fehler ist aufgetreten. Bitte versuchen Sie es später erneut."
            ]);
        }
    }

    /**
     * Creates the prompt for the TextInspiration tool
     */
    private function create_message(Request $request, Conversation $conversation): Message
    {
        // Create the user message
        $message = new Message();
        $message->user_id = auth()->user()->id;
        $message->role = 'user';

        // Load the prompt template and insert the user input
        $prompt = $conversation->loadTaskPrompt(['replacements' => [
            'task_type' => $request->field1,
            'task_level' => $request->field2,
            'task_topic' => $request->field3,
            'task_requirements' => $request->field4,
            'task_text_to_create' => $request->field5,
            'task_previous_text' => $request->field6
        ]]);

        # If a previous text is set, add a continuation prompt
        if (!empty($request->field6)) {
            $prompt = str_replace('continuation_prompt', config('prompts.text_inspiration.continuation_prompt'), $prompt);
        } else {
            $prompt = str_replace('continuation_prompt', '', $prompt);
        }

        $message->content = $prompt;

        return $message;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
