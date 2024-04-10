<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Models\AIResponse; // Stellen Sie sicher, dass Sie Ihr Modell entsprechend anpassen

class newFrontController extends Controller
{
    // Konstanten für die OpenAI-API
    private const OPENAI_API_URL = 'https://api.openai.com/v1/chat/completions';
    private const OPENAI_API_KEY = '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';

    public function processOpenAIRequest(Request $request, $toolIdentifier)
    {
        //Ruft die Tool Einstellung wie Prompt etc. anhand des toolIdentifier ab
        $toolConfig = $this->getPromptForTool($toolIdentifier, $request);

        if (!$toolConfig) {
            return response()->json([
                "status" => false,
                "error" => "Ungültiges Tool oder fehlende Daten."
            ]);
        }

        //Bereitet die Anfrage an OpenAI vor
        $payload = $this->createPayload($toolConfig);
        //Sendet die Anfrage an OpenAI
        $responseData = $this->sendOpenAIRequest($payload, auth()->user()->id, $toolIdentifier);

        if (isset($responseData['error'])) {
            return response()->json([
                "status" => false,
                "error" => $responseData['error']
            ]);
        }

        //Formatiert die Antwort von OpenAI für die Anzeige im Frontend
        $formattedData = $this->formatApiResponse($responseData);

        return response()->json([
            "status" => true,
            "data" => $formattedData,
        ]);
    }

    //Switch Cases für jedes Tool mit individuellen Einstellungen
    private function getPromptForTool($toolIdentifier, $request)
    {
        switch ($toolIdentifier) {
            case 'test':
                return $this->test($request);
            // Fügen Sie hier weitere Cases für andere Tools hinzu
            default:
                return null;
        }
    }

    //Bereitet die Anfrage an OpenAI vor
    private function createPayload($toolConfig)
    {
        return [
            'prompt' => $toolConfig['prompt'],
            'max_tokens' => $toolConfig['max_tokens'],
            'temperature' => $toolConfig['temperature'],
            // Fügen Sie hier weitere Konfigurationen hinzu, falls nötig
        ];
    }
    
    //Sendet die Anfrage an OpenAI
    private function sendOpenAIRequest($payload)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . self::OPENAI_API_KEY,
        ])->post(self::OPENAI_API_URL, $payload);

        return $response->json();
    }

    //Formatiert die Antwort von OpenAI für die Anzeige im Frontend
    private function formatApiResponse($responseData)
    {
        // Beispiel für eine einfache Formatierung. Passen Sie dies an Ihre Bedürfnisse an.
        if (isset($responseData['choices'][0]['text'])) {
            return ['response' => trim($responseData['choices'][0]['text'])];
        }

        return ['response' => 'Keine Antwort erhalten.'];
    }

    private function getUsername()
    {
        if (is_null($this->username)) {
            $this->username = auth()->user() ? auth()->user()->name : 'Gast';
        }
        return $this->username;
    }

    // Spezifische Prompt-Methode für das Tool TextAnalyse
    private function test($request)
    {
        $input1 = $request->input('input1', '');
        $prompt = "Analysiere den folgenden Text auf Rechtschreib-, Grammatikfehler und stilistische Aspekte. Korrigiere Rechtschreibfehler und Grammatikfehler nicht direkt im Text, sondern erstelle eine Liste mit den Fehlern und füge dahinter in Klammern die Korrekte Schreibweise an. Vorschläge für Stilverbesserungen sind ebenfalls in der Liste aufzuführen. Argumentiere eventuelle Stilverbesserungen, damit ich die Verbesserungsvorschläge verstehen kann. Ich werde dann entscheiden, ob ich diese Vorschläge übernehmen möchte oder nicht. Weise mich auf meine Schwächen und wiederholende Fehler hin. Hilf mir mit Merksätzen, Eselsbrücken oder einfache Beispiele diese Fehler künftig zu vermeiden. Mein Text: " . $input1;
        $config = [
            'prompt' => $prompt,
            'temperature' => 0.7,
            'max_tokens' => 1500,
            'model' => 'gpt-3.5-turbo-1106',
            'role' => 'system',
            'content' => "Name: " . $this->getUsername() . ". Alter: 16. Ich führe Aufgaben direkt und zielgerichtet aus und überprüfe jede meiner Antworten auf Vollständigkeit und Genauigkeit. Meine Antworten sind deinem Alter entsprechend leicht verständlich formuliert. Ich nutze bevorzugt Aufzählungen statt Fließtext. Ich spreche Dich mit Deinem Namen an und interagiere im Stil eines Gesprächs mit einem wohlwollendem Mentor. In meinen Antworten benutze ich Emojis nach eigenem Ermessen."
        ];
        return $config;
    }
}
