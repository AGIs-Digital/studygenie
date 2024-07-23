<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;

class CVController extends Controller
{
    public function cvPreview(Request $request)
    {
        $data = $request->all();
        \Log::info('cvPreview data:', $data); // Debugging-Ausgabe

        // Generiere das PDF
        $pdf = PDF::loadView('Karriere.cv_template', $data)
                  ->setPaper('a4', 'portrait')
                  ->setOptions(['isHtml5ParserEnabled' => true, 'isPhpEnabled' => true]);

        // Konvertiere das PDF in einen Base64-kodierten String
        $base64Pdf = base64_encode($pdf->output());

        // Rückgabe des Base64-kodierten Strings
        return response()->json(['pdf' => $base64Pdf]);
    }

    public function downloadPDF(Request $request)
    {
        $data = $request->all();

        // Filtere leere Felder heraus
        $filteredData = array_filter($data, function($value) {
            return !empty($value);
        });

        // Generiere das PDF nur mit den gefilterten Daten
        $pdf = PDF::loadView('Karriere.cv_template', $filteredData)
                  ->setPaper('a4', 'portrait')
                  ->setOptions(['isHtml5ParserEnabled' => true, 'isPhpEnabled' => true]);
        return $pdf->download('lebenslauf.pdf');
    }
}