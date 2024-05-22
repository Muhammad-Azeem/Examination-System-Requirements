<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Notification::class);
        return Notification::with('userAttempt')->get();
    }

    public function store(Request $request)
    {
        $this->authorize('create', Notification::class);
        $validated = $request->validate([
            'user_attempt_id' => 'required|exists:user_attempts,id',
            'message' => 'required|string',
        ]);
        return Notification::create($validated);
    }

    public function show(Notification $notification)
    {
        $this->authorize('view', $notification);
        return $notification->load('userAttempt');
    }

    public function update(Request $request, Notification $notification)
    {
        $this->authorize('update', $notification);
        $validated = $request->validate([
            'user_attempt_id' => 'required|exists:user_attempts,id',
            'message' => 'required|string',
        ]);
        $notification->update($validated);
        return $notification;
    }

    public function destroy(Notification $notification)
    {
        $this->authorize('delete', $notification);
        $notification->delete();
        return response()->noContent();
    }
}
