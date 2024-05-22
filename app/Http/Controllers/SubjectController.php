<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Subject::class);
        return Subject::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', Subject::class);
        $validated = $request->validate(['name' => 'required|string|max:255']);
        return Subject::create($validated);
    }

    public function show(Subject $subject)
    {
        $this->authorize('view', $subject);
        return $subject;
    }

    public function update(Request $request, Subject $subject)
    {
        $this->authorize('update', $subject);
        $validated = $request->validate(['name' => 'required|string|max:255']);
        $subject->update($validated);
        return $subject;
    }

    public function destroy(Subject $subject)
    {
        $this->authorize('delete', $subject);
        $subject->delete();
        return response()->noContent();
    }
}
