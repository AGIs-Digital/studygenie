<?php

namespace App\Http\Controllers\Karriere;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;

class LebenslaufController extends Controller
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
        return view('karriere.lebenslauf');
    }

    /**
     * Preview CV
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function preview(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();
        // \Log::info('cvPreview data:', $data); // Debugging-Ausgabe

        // Generiere das PDF
        $pdf = PDF::loadView('Karriere.cv_template', $data)
                  ->setPaper('a4', 'portrait')
                  ->setOptions(['isHtml5ParserEnabled' => true, 'isPhpEnabled' => true]);

        // Konvertiere das PDF in einen Base64-kodierten String
        $base64Pdf = base64_encode($pdf->output());

        // Rückgabe des Base64-kodierten Strings
        return response()->json(['pdf' => $base64Pdf]);
    }

    /**
     * Method to download the CV PDF
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function download(Request $request): \Illuminate\Http\Response
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
