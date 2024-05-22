<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{SubjectController, PaperController, QuestionController, UserAttemptController, UserAnswerController, NotificationController};
Route::get('/testing', function () {
    return view('welcome');
});
Route::middleware('api')->group(function () {
    Route::apiResource('subjects', SubjectController::class);
});
Route::apiResource('subjects', SubjectController::class);
Route::apiResource('papers', PaperController::class);
Route::apiResource('questions', QuestionController::class);
Route::apiResource('user-attempts', UserAttemptController::class);
Route::apiResource('user-answers', UserAnswerController::class);
Route::apiResource('notifications', NotificationController::class);
