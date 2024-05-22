<?php

namespace App\Http\Controllers;

use App\Models\UserAnswer;
use Illuminate\Http\Request;

class UserAnswerController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', UserAnswer::class);
        return UserAnswer::with('userAttempt', 'question')->get();
    }

    public function store(Request $request)
    {
        $this->authorize('create', UserAnswer::class);
        $validated = $request->validate([
            'user_attempt_id' => 'required|exists:user_attempts,id',
            'question_id' => 'required|exists:questions,id',
            'answer' => 'required|string',
            'is_correct' => 'nullable|boolean',
        ]);
        return UserAnswer::create($validated);
    }

    public function show(UserAnswer $userAnswer)
    {
        $this->authorize('view', $userAnswer);
        return $userAnswer->load('userAttempt', 'question');
    }

    public function update(Request $request, UserAnswer $userAnswer)
    {
        $this->authorize('update', $userAnswer);
        $validated = $request->validate([
            'user_attempt_id' => 'required|exists:user_attempts,id',
            'question_id' => 'required|exists:questions,id',
            'answer' => 'required|string',
            'is_correct' => 'nullable|boolean',
        ]);
        $userAnswer->update($validated);
        return $userAnswer;
    }

    public function destroy(UserAnswer $userAnswer)
    {
        $this->authorize('delete', $userAnswer);
        $userAnswer->delete();
        return response()->noContent();
    }
}
