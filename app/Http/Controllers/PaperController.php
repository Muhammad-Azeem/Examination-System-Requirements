<?php

namespace App\Http\Controllers;

use App\Models\Paper;
use Illuminate\Http\Request;

class PaperController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Paper::class);
        return Paper::with('subject')->get();
    }

    public function store(Request $request)
    {
        $this->authorize('create', Paper::class);
        $validated = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'title' => 'required|string|max:255',
            'duration' => 'required|integer',
        ]);
        return Paper::create($validated);
    }

    public function show(Paper $paper)
    {
        $this->authorize('view', $paper);
        return $paper->load('subject', 'questions');
    }

    public function update(Request $request, Paper $paper)
    {
        $this->authorize('update', $paper);
        $validated = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'title' => 'required|string|max:255',
            'duration' => 'required|integer',
        ]);
        $paper->update($validated);
        return $paper;
    }

    public function destroy(Paper $paper)
    {
        $this->authorize('delete', $paper);
        $paper->delete();
        return response()->noContent();
    }
}
