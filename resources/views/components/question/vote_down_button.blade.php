@props(['value' , 'id' , 'slug'])

@php
$classes = $value == -1 ? 'bg-gray-400 hover:bg-gray-500 cursor-not-allowed' : 'bg-red-400 hover:bg-red-500';

$event = $value ? ($value == -1 ? '' : "getElementById('questionVoteDown_$id').submit()"):
"getElementById('questionVoteDown_$id').submit()";
@endphp

<button class="flex-1 flex justify-center items-center py-2 text-white {{ $classes }}" onclick="{{ $event }}">
  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
    stroke-width="2">
    <path stroke-linecap="round" stroke-linejoin="round"
      d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.096c.5 0 .905-.405.905-.904 0-.715.211-1.413.608-2.008L17 13V4m-7 10h2m5-10h2a2 2 0 012 2v6a2 2 0 01-2 2h-2.5" />
  </svg>
</button>

@if ($value != -1)
<form action="{{ route('questions.vote' , $slug) }}" method="POST" class="hidden" id="questionVoteDown_{{ $id }}">
  @csrf
  <input type="hidden" name="vote" value="-1" />
</form>
@endif