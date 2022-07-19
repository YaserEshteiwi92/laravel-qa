<?php

namespace App\Observers;

use App\Models\Answer;

class AnswerObserve
{
    /**
     * Handle the Answer "created" event.
     *
     * @param  \App\Models\Answer  $answer
     * @return void
     */
    public function created(Answer $answer)
    {
        $answer->question()->increment('answers_count');
    }

    /**
     * Handle the Answer "deleted" event.
     *
     * @param  \App\Models\Answer  $answer
     * @return void
     */
    public function deleted(Answer $answer)
    {
        $answer->question()->decrement('answers_count');
    }
}
