<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'feedbackType' => 'required|string',
            'feedbackText' => 'required|string',
            'currentPage' => 'required|string',
        ]);

        Feedback::create([
            'type' => $request->feedbackType,
            'text' => $request->feedbackText,
            'page' => $request->currentPage,
        ]);

        return response()->json(['success' => true]);
    }
}
