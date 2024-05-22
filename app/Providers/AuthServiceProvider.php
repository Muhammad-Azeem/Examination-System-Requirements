<?php

namespace App\Providers;

use App\Models\{Subject, Paper, Question, UserAttempt, UserAnswer, Notification};
use App\Policies\{SubjectPolicy, PaperPolicy, QuestionPolicy, UserAttemptPolicy, UserAnswerPolicy, NotificationPolicy};
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Subject::class => SubjectPolicy::class,
        Paper::class => PaperPolicy::class,
        Question::class => QuestionPolicy::class,
        UserAttempt::class => UserAttemptPolicy::class,
        UserAnswer::class => UserAnswerPolicy::class,
        Notification::class => NotificationPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
