<?php

namespace App\Http\Controllers\Karriere;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Models\Message;
use App\Custom\Prompt;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class JobInsiderController extends Controller
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
    public function create()
    {
        return view('karriere.job_insider');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'field1' => [
                    'required',
                    'string',
                    'max:2000',
                    'min:10',
                    function ($attribute, $value, $fail) {
                        if (preg_match('/[<>]/', $value)) {
                            $fail('HTML-Tags sind nicht erlaubt.');
                        }
                    },
                ]
            ]);

            $toolIdentifier = 'job_insider';

            # make sure $request->field1 is set and not empty
            if (!isset($request->field1) || empty($request->field1)) {
                return response()->json([
                    "status" => false,
                    "error" => "Bitte geben Sie einen Jobnamen ein"
                ]);
            }

            # Create a new conversation
            $conversation = new Conversation();
            $conversation->user_id = auth()->user()->id;
            $conversation->tool_identifier = $toolIdentifier;
            $conversation->save();

            # Create a new message
            $message = new Message();
            $message->user_id = auth()->user()->id;
            $message->role = 'user';
            $message->content = $conversation->loadTaskPrompt(['replacements' => ['job_name' => $request->field1]]);

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
        } catch (ValidationException $e) {
            return response()->json([
                "status" => false,
                "error" => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error("JobInsiderError: " . $e->getMessage());
            return response()->json([
                "status" => false,
                "error" => "Ein unerwarteter Fehler ist aufgetreten."
            ], 500);
        }
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
