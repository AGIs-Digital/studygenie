<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class AdminFeedbackController extends Controller
{
    public function index(Request $request)
    {
        $query = Feedback::query();

        if ($request->has('sort') && $request->has('direction')) {
            $query->orderBy($request->get('sort'), $request->get('direction'));
        }

        $feedbacks = $query->paginate(10);

        return view('admin.feedbacks.index', [
            'feedbacks' => $feedbacks
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();

        return response()->json(['status' => 'success']);
    }
}