<?php

namespace App\Http\Controllers\Bildung;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Models\Message;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Facades\Log;

class TutorController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bildung.tutor');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $toolIdentifier = 'tutor';

            # make sure, $request->text1 is set and not empty
            if (!isset($request->text1) || empty($request->text1)) {
                return response()->json([
                    "status" => false,
                    "error" => "Bitte geben Sie eine Frage ein"
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

            $response = OpenAI::client()->chat()->create($payload);

            # create new message for response
            $message = new Message();
            $message->user_id = auth()->user()->id;
            $message->content = $response->choices[0]->message->content;
            $message->role = 'assistant';

            # add message to conversation
            $conversation->messages()->save($message);

            return response()->json([
                "status" => true,
                "message" => $message->toArray(),
            ]);
        } catch (\Exception $e) {
            Log::error('Tutor-Fehler: ' . $e->getMessage());
            return response()->json([
                "status" => false,
                "error" => "Ein Fehler ist aufgetreten. Bitte versuchen Sie es später erneut."
            ], 500);
        }
    }
}
