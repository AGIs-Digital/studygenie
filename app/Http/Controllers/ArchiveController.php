<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Models\Archive;
use Illuminate\Support\Facades\Cache;

class ArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->user()->id;

        // Load all archives to user with type = Bildung
        $Bildung = Archive::where('user_id', $userId)->where('type', 'Bildung')->get();

        // Load all archives to user with type = Karriere
        $Karriere = Archive::where('user_id', $userId)->where('type', 'Karriere')->get();

        return view('archive', compact('Bildung', 'Karriere'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Archive $archive)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Archive $archive)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Archive $archive)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Archive $archive)
    {
        // If the given archive belongs the the auth user, delete it
        if ($archive->user_id === auth()->id()) {
            $archive->delete();
        }

        // Return json
        return response()->json(['message' => 'Archive deleted successfully', 'status' => 'success']);
    }
}
