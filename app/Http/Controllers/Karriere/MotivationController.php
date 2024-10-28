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
        try {
            // Hier wird die OpenAI-Antwort verarbeitet
            $data = $request->all();
            $openAIResponse = $this->getOpenAIResponse($data);

            // Füge die OpenAI-Antwort zu den Daten hinzu
            $data['motivational_letter'] = $openAIResponse;

            // Generiere das PDF nur mit den gefilterten Daten
            $pdf = PDF::loadView('karriere.motivation_template', $data)
                          ->setPaper('a4', 'portrait')
                          ->setOptions(['isHtml5ParserEnabled' => true, 'isPhpEnabled' => true]);

            // Rückgabe der PDF-Daten als Base64
            return response()->json(['pdf' => base64_encode($pdf->output())]);
        } catch (\Exception $e) {
            // Fehlerbehandlung und Debugging-Informationen
            \Log::error('Fehler in preview Methode: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Download the PDF with the motivational letter
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function downloadPDF(Request $request)
    {
        try {
            $data = $request->all();
            
            if (empty($data['openai_response'])) {
                throw new \Exception('Keine OpenAI-Antwort gefunden');
            }

            // Generiere das PDF mit den Daten
            $pdf = PDF::loadView('karriere.motivation_template', $data)
                  ->setPaper('a4', 'portrait')
                  ->setOptions(['isHtml5ParserEnabled' => true, 'isPhpEnabled' => true]);

            return $pdf->download('Motivationsschreiben_' . date('d_m_Y') . '.pdf');
        } catch (\Exception $e) {
            \Log::error('Fehler beim PDF-Download: ' . $e->getMessage());
            return response()->json(['error' => 'PDF konnte nicht erstellt werden'], 500);
        }
    }

    private function getOpenAIResponse($data)
    {
        // Hier wird die OpenAI-Anfrage gesendet und die Antwort zurückgegeben
        // Dies ist ein Platzhalter. Implementiere die tatsächliche OpenAI-Anfrage hier.
        $generated_text = $data['openai_response'] ?? "OpenAI Antwort basierend auf den Benutzereingaben.";

        // Entferne bekannte Abschiedsformeln, falls vorhanden
        $abschiedsformeln = [
            'Mit freundlichen Grüßen,',
            'Hochachtungsvoll,',
            'Freundliche Grüße,',
            'Mit besten Grüßen,',
            'Mit herzlichen Grüßen,',
            'Mit den besten Wünschen,',
            'Beste Grüße,',
            'Viele Grüße,',
            'Liebe Grüße,',
            'Viele liebe Grüße,',
            'Bis bald,',
            'Alles Gute,',
            'Herzlichst,',
            '[Dein Name],',
            '[Dein Name]',
            '(Dein Name),',
            '(Dein Name)',
            '[Ihr Name],',
            '[Ihr Name]',
            '(Ihr Name),',
            '(Ihr Name)'
        ];

        foreach ($abschiedsformeln as $formel) {
            $generated_text = str_replace($formel, '', $generated_text);
        }

        // Entferne den authentifizierten Benutzernamen aus der Antwort, falls vorhanden
        if (auth()->check()) {
            $username = auth()->user()->name;
            $generated_text = str_replace($username, '', $generated_text);
        }

        // Trimme den Text, um mgliche Leerzeichen oder Zeilenumbrche zu entfernen
        $generated_text = trim($generated_text);

        return $generated_text;
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
            $prompt->replace('task_job', $request->stellenbezeichnung_job, "keine Angabe");
            $prompt->replace('task_description', $request->stellenbezeichnung_stellenbeschreibung, "keine Angabe");
            
            $prompt->replace('task_academic', $request->qualification_grade, "keine Angabe");
            $prompt->replace('task_experience', $request->qualification_jobs, "keine Angabe");
            $prompt->replace('task_tasks_now', $request->qualification_tasks_now, "keine Angabe");
            $prompt->replace('task_tasks_earlier', $request->qualification_tasks_earlier, "keine Angabe");
            $prompt->replace('task_skills', $request->qualification_skills, "keine Angabe");

            $prompt->replace('task_goals', $request->motivationen_type, "keine Angabe");
            $prompt->replace('task_motivation', $request->motivationen_level, "keine Angabe");
            $prompt->replace('task_style', $request->motivationen_style, "keine Angabe");
            $prompt->replace('task_personal', $request->motivationen_freitext, "keine Angabe");

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
