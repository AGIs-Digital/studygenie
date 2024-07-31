<?php

namespace App\Http\Controllers\Karriere;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;
use App\Models\Conversation;
use App\Models\Message;
use App\Custom\Prompt;
use OpenAI\Laravel\Facades\OpenAI;

class MotivationController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('karriere.motivationsschreiben');
    }

    /**
     * Generate a preview of the motivational letter
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function preview(Request $request): \Illuminate\Http\JsonResponse
    {
        return response()->json($request->all());
    }

    /**
     * Download the PDF with the motivational letter
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function downloadPDF(Request $request): \Illuminate\Http\Response
    {
        $data = $request->all();

        // Filtere leere Felder heraus
        $filteredData = array_filter($data, function($value) {
            return !empty($value);
        });

        // Generiere das PDF nur mit den gefilterten Daten
        $pdf = PDF::loadView('karriere.motivation_template', ['motivational_letter' => $filteredData['pdf_content']])
                      ->setPaper('a4', 'portrait')
                      ->setOptions(['isHtml5ParserEnabled' => true, 'isPhpEnabled' => true]);
        return $pdf->download('motivationsschreiben.pdf');
    }

    /**
     * Generate the motivational letter
     */
    public function generate(Request $request)
    {
        try {
            $toolIdentifier = 'motivational_letter';

            # Create a new conversation
            $conversation = new Conversation();
            $conversation->user_id = auth()->user()->id;
            $conversation->tool_identifier = $toolIdentifier;
            $conversation->save();

            $prompt = new Prompt('prompts.motivational_letter.task_prompt');
            $prompt->replace('task_job', $request->field1, "keine Angabe");
            $prompt->replace('task_strengths', $request->field2, "keine Angabe");
            $prompt->replace('task_academic', $request->field3, "keine Angabe");
            $prompt->replace('task_experience', $request->field4, "keine Angabe");
            $prompt->replace('task_motivation', $request->field5, "keine Angabe");
            $prompt->replace('task_personal', $request->field6, "keine Angabe");
            $prompt->replace('task_description', $request->field7, "keine Angabe");

            # Create a new message
            $message = new Message();
            $message->user_id = auth()->user()->id;
            $message->role = 'user';
            $message->content = $prompt->get();

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
                "data" => $message->content
            ]);
        } catch (\Exception $e) {

            return $this->handleException($e, "Fehler beim Motivationsschreiben");
        }
    }
}
