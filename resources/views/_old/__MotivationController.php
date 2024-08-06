<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;

class MotivationController extends Controller
{
    public function motivationPreview(Request $request)
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
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function downloadPDF(Request $request)
    {
        try {
            $data = $request->all();

            // Füge die OpenAI-Antwort zu den Daten hinzu
            $data['motivational_letter'] = $this->getOpenAIResponse($data);

            // Generiere das PDF nur mit den gefilterten Daten
            $pdf = PDF::loadView('karriere.motivation_template', $data)
                          ->setPaper('a4', 'portrait')
                          ->setOptions(['isHtml5ParserEnabled' => true, 'isPhpEnabled' => true]);

            return $pdf->download('motivationsschreiben.pdf');
        } catch (\Exception $e) {
            // Fehlerbehandlung und Debugging-Informationen
            return response()->json(['error' => $e->getMessage()], 500);
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
            '(Dein Name)'
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
}