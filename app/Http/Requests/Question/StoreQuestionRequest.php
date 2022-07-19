<?php

namespace App\Http\Requests\Question;

use App\Models\Question;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreQuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'body' => 'required'
        ];
    }

    public function save()
    {
        try {
            $this->user()->questions()->create($this->only(['title', 'body']));
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                $question = new Question();
                $question->title = $this->input('title');
                $question->slug = Str::slug($this->input('title') . ' ' . Str::random(6));
                $question->body = $this->input('body');
                $question->user_id = $this->user()->id;
                $question->save();
            } else {
                return $e;
            }
        }
    }
}
