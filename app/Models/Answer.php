<?php

namespace App\Models;

use App\Observers\AnswerObserve;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'question_id'];

    public function getContentHtmlAttribute(): string
    {
        return nl2br($this->content);
    }

    public function getcreatedDateAttribute(): string
    {
        return $this->created_at->diffForHumans();
    }


    /* ----------------------- Relations ----------------------- */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
