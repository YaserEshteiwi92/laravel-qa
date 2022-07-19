<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body'];

    public $timestamps = false;

    protected $with = ['user', 'answers'];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    protected $appends = ['vote_value'];

    public function incrementViews(): void
    {
        $this->increment('views_count');
    }

    public function vote($voteValue): void
    {
        if ($this->_userIsVote()) {
            $this->votes()->updateExistingPivot(Auth::id(), ['vote' => $voteValue]);
        } else {
            $this->votes()->attach(Auth::id(), ['vote' => $voteValue]);
        }

        $this->_sumVotes();
    }

    private function _userIsVote(): bool
    {
        return $this->votes()->where('user_id', Auth::id())->exists();
    }

    private function _sumVotes(): void
    {
        $sum = $this->votes()->sum('vote');
        $this->votes_count = $sum;
        $this->save();
    }

    /* ----------------------- Attribute ----------------------- */

    protected function title(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => [
                'title' => $value,
                'slug' => Str::slug($value)
            ]
        );
    }

    public function getCreatedDateAttribute(): string
    {
        return $this->created_at->diffForHumans();
    }

    public function getBodyHtmlAttribute(): string
    {
        return nl2br($this->body);
    }

    protected function voteValue(): Attribute
    {
        return new Attribute(
            get: fn () => $this->votes()->where('user_id', Auth::id())->value('vote'),
        );
    }

    /* ----------------------- Relations ----------------------- */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class)->latest();
    }

    public function votes(): MorphToMany
    {
        return $this->morphToMany(User::class, 'voteable', 'voteables')->withPivot('vote');
    }
}
