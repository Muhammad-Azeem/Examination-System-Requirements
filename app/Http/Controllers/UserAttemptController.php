<?php

namespace App\Http\Controllers;

use App\Models\UserAttempt;
use App\Notifications\UserCompletedPaper;
use Illuminate\Http\Request;

class UserAttemptController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', UserAttempt::class);
        return UserAttempt::with('user', 'paper')->get();
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'paper_id' => 'required|exists:papers,id',
        ]);

        $userAttempt = UserAttempt::create($validated);

        // Send notification
        $userAttempt->notify(new UserCompletedPaper($userAttempt));

        return $userAttempt;
    }
    public function show(UserAttempt $userAttempt)
    {
        $this->authorize('view', $userAttempt);
        return $userAttempt->load('user', 'paper', 'answers');
    }
    public function update(Request $request, UserAttempt $userAttempt)
    {
        $this->authorize('update', $userAttempt);
        $validated = $request->validate([
            'auto_checked' => 'boolean',
            'manually_reviewed' => 'boolean',
        ]);
        $userAttempt->update($validated);
        return $userAttempt;
    }
    public function destroy(UserAttempt $userAttempt)
    {
        $this->authorize('delete', $userAttempt);
        $userAttempt->delete();
        return response()->noContent();
    }
}
