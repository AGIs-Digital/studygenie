<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;

class MotivationController extends Controller
{

    public function generatePreview(Request $request)
    {
        return response()->json($request->all());
    }

    public function downloadPDF(Request $request)
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

}