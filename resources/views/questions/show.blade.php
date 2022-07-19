<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ $question->title }}
    </h2>
    <a href="{{ route('questions.index') }}"
      class="text-white bg-cyan-500 hover:bg-cyan-600 transition-colors py-2 px-4 rounded">{{ __('Back') }}</a>
  </x-slot>

  <div class="max-w-4xl mx-auto pt-6 pb-10 px-2 sm:px-0">
    {{-- Question --}}
    <x-question.single :question="$question" />
  </div>

  {{-- Answers --}}
  @include('answers._index' , [
  'question' => $question,
  'answers' => $question->answers
  ])

</x-app-layout>