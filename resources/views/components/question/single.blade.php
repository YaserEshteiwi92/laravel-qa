@props(['question'])

<div class="flex flex-col bg-gray-200 rounded border border-gray-300 overflow-hidden">
  <div class="flex">
    {{-- Views & Answer Count Section --}}
    <x-question.statistics :viewsCount="$question->views_count" :answersCount="$question->answers_count" />
    {{-- Question Content Section --}}
    <x-question.content :question="$question" />
  </div>
  {{-- Vote Section --}}
  <x-question.vote :question="$question" />
</div>