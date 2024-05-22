<?php

namespace App\Jobs;

use App\Models\UserAttempt;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AutoCheckAnswers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userAttempt;

    public function __construct(UserAttempt $userAttempt)
    {
        $this->userAttempt = $userAttempt;
    }

    public function handle()
    {
        foreach ($this->userAttempt->answers as $answer) {
            $question = $answer->question;
            if (in_array($question->type, ['MCQ', 'Radio'])) {
                // Auto-check logic (assume correct options are stored in the options JSON)
                $correctOptions = $question->options['correct'];
                $answer->is_correct = in_array($answer->answer, $correctOptions);
                $answer->save();
            }
        }

        // Mark as auto-checked
        $this->userAttempt->auto_checked = true;
        $this->userAttempt->save();
    }
}
