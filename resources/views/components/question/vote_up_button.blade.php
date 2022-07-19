@props(['value' , 'id' , 'slug'])

@php
$classes = $value == 1 ? 'bg-gray-400 hover:bg-gray-500 cursor-not-allowed' : 'bg-sky-400 hover:bg-sky-500';

$event = $value ? ($value == 1 ? '' : "getElementById('questionVoteUp_$id').submit()") :
"getElementById('questionVoteUp_$id').submit()";
@endphp

<button class="flex-1 flex justify-center items-center py-2 text-white {{ $classes }}" onclick="{{ $event }}">
  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
    stroke-width="2">
    <path stroke-linecap="round" stroke-linejoin="round"
      d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
  </svg>

</button>

@if ($value != 1)
<form action="{{ route('questions.vote' , $slug) }}" method="POST" class="hidden" id="questionVoteUp_{{ $id }}">
  @csrf
  <input type="hidden" name="vote" value="1" />
</form>
@endif