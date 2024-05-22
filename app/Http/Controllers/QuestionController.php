<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Question::class);
        return Question::with('paper')->get();
    }

    public function store(Request $request)
    {
        $this->authorize('create', Question::class);
        $validated = $request->validate([
            'paper_id' => 'required|exists:papers,id',
            'type' => 'required|in:MCQ,Radio,TextInput,DatePicker,ColorPicker,Textarea',
            'question_text' => 'required|string',
            'options' => 'nullable|json',
        ]);
        return Question::create($validated);
    }

    public function show(Question $question)
    {
        $this->authorize('view', $question);
        return $question->load('paper');
    }

    public function update(Request $request, Question $question)
    {
        $this->authorize('update', $question);
        $validated = $request->validate([
            'paper_id' => 'required|exists:papers,id',
            'type' => 'required|in:MCQ,Radio,TextInput,DatePicker,ColorPicker,Textarea',
            'question_text' => 'required|string',
            'options' => 'nullable|json',
        ]);
        $question->update($validated);
        return $question;
    }

    public function destroy(Question $question)
    {
        $this->authorize('delete', $question);
        $question->delete();
        return response()->noContent();
    }
}
