@props(['question'])

@php
$voteValue = $question->voteValue;
$id = $question->id;
$slug = $question->slug;
$votesCount = $question->votes_count;
@endphp


<div class="flex">
  {{-- Like Button --}}
  <x-question.vote_up_button :value="$voteValue" :id="$id" :slug="$slug" />

  {{-- Vote Count --}}
  <div class="w-16 flex items-center justify-center font-extrabold bg-white">{{ $votesCount }}</div>

  {{-- Dislike Button --}}
  <x-question.vote_down_button :value="$voteValue" :id="$id" :slug="$slug" />
</div>