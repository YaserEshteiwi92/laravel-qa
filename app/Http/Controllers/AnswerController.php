<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Http\Requests\Answer\StoreAnswerRequest;
use App\Http\Requests\Answer\UpdateAnswerRequest;
use App\Models\Question;
use App\Notifications\AddNewAnswerNotification;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAnswerRequest  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAnswerRequest $request, Question $question)
    {
        $fields = $request->only('content');
        $fields['question_id'] = $question->id;

        $user = Auth::user();

        $answer = $user->answers()->create($fields);

        if ($question->user_id != $user->id) {
            $question->user->notify(new AddNewAnswerNotification($question, $answer, $user));
        }


        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question, Answer $answer)
    {
        return view('answers.edit', compact('question', 'answer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAnswerRequest  $request
     * @param  \App\Models\Question  $question
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAnswerRequest $request, Question $question, Answer $answer)
    {
        $fields = $request->only('content');

        $answer->update($fields);

        return redirect()->route('questions.show', $question->slug);
    }

    /**
     * Remove the specified resource from storage.
     * @param  \App\Models\Question  $question
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question, Answer $answer)
    {
        $answer->delete();

        return back();
    }
}
