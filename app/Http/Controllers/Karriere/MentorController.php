<?php

namespace App\Http\Controllers\Karriere;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Models\Message;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Facades\Log;

class MentorController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('karriere.mentor');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $toolIdentifier = 'mentor';

            if (!isset($request->text1) || empty($request->text1)) {
                return response()->json([
                    "status" => false,
                    "error" => "Bitte geben Sie eine Frage ein"
                ]);
            }

            $conversation = new Conversation();
            $conversation->user_id = auth()->user()->id;
            $conversation->tool_identifier = $toolIdentifier;
            $conversation->save();

            $message = new Message();
            $message->user_id = auth()->user()->id;
            $message->role = 'user';
            $message->content = $request->text1;

            $conversation->messages()->save($message);
            
            $payload = $conversation->createPayload();
            $response = OpenAI::chat()->create($payload);

            $message = new Message();
            $message->user_id = auth()->user()->id;
            $message->content = $response->choices[0]->message->content;
            $message->role = 'assistant';

            $conversation->messages()->save($message);

            return response()->json([
                "status" => true,
                "message" => $message->toArray()
            ]);
        } catch (\Exception $e) {
            Log::error('Mentor-Fehler: ' . $e->getMessage());
            return response()->json([
                "status" => false,
                "error" => "Ein Fehler ist aufgetreten. Bitte versuchen Sie es später erneut."
            ]);
        }
    }
}
