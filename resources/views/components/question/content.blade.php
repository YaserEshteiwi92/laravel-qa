@props(['question'])

@php
$limit = request()->routeIs('questions.index') ? '255' : '0';
@endphp

<div class="p-4 flex-1">
  {{-- Question Title --}}
  @if (request()->routeIs('questions.show'))
  <div>
    <div class="flex justify-between items-start">
      {{-- User Information --}}
      <x-question.user :user="$question->user" :createdDate="$question->created_date" />
      {{-- Actions --}}
      <x-question.actions_btn :question="$question" />
    </div>

    {{-- Title --}}
    <h2 class="text-2xl font-semibold mt-2">
      {{ $question->title }}
    </h2>
  </div>
  @else
  <div class="flex justify-between items-center gap-4">
    {{-- Title --}}
    <h2 class="text-2xl font-bold">
      <a href="{{ route('questions.show' , $question->slug) }}" class="text-sky-500">
        {{ $question->title }}
      </a>
    </h2>
    {{-- Actions --}}
    <x-question.actions_btn :question="$question" />
  </div>
  {{-- User Information --}}
  <div class="text-sm mt-2">
    {{ __('Asked by') }} <a href="{{ $question->user->url }}" class="text-sky-500 font-bold">{{ $question->user->name
      }}</a>
    <span class="text-[10px] ml-1">{{ $question->created_date }}</span>
  </div>

  @endif
  {{-- Question Content --}}
  <p class="mt-4">
    @if ($limit)
    {{ Str::limit($question->body ,$limit ,' ...') }}
    @else
    {!! $question->body_html !!}
    @endif
  </p>
</div>