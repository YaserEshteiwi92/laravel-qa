<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Notifications\VoteQuestionNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Question $question)
    {
        $fields = $request->validate([
            'vote' => 'required|in:1,-1'
        ]);

        $voteValue = $fields['vote'];

        $question->vote($voteValue);

        $user = Auth::user();

        if ($question->user_id != $user->id) {
            $question->user->notify(new VoteQuestionNotification($question, $voteValue, $user));
        }

        return back();
    }
}
