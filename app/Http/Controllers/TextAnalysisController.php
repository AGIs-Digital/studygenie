<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Models\Message;
use App\Custom\Prompt;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Facades\Log;

class TextAnalysisController extends Controller
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
        return view('bildung.text_analyse');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $toolIdentifier = 'text_analysis';

            # make sure, $request->text1 is set and not empty
            if (!isset($request->text1) || empty($request->text1)) {
                return response()->json([
                    "status" => false,
                    "error" => "Bitte geben Sie einen Text ein"
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
            $message->content = $request->text1;

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

            Log::error("TextAnalysis: " . $e->getMessage());
            print($e->getMessage());
            return response()->json([
                "status" => false,
                "error" => "Ein Fehler ist aufgetreten. Bitte versuchen Sie es später erneut."
            ]);
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
