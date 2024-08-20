<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class AdminFeedbackController extends Controller
{
    public function index(Request $request)
    {
        $query = Feedback::query();

        if ($request->filled('page')) {
            $query->where('page', $request->input('page'));
        }

        if ($request->filled('type')) {
            $query->where('type', $request->input('type'));
        }

        $feedbacks = $query->orderBy('created_at', 'desc')->paginate(10);

        // Alle verfügbaren Seiten (pages) laden
        $pages = Feedback::select('page')->distinct()->get();

        return view('admin.feedbacks.index', compact('feedbacks', 'pages'));
    }
}