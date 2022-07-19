<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ $user->name }}
    </h2>
    <div>
      {{ $questions->count() . " " . __('Question') }}
    </div>
  </x-slot>

  <div class="max-w-3xl mx-auto pt-6 pb-10 px-2 sm:px-0">
    <div class="space-y-8">
      @forelse ($questions as $question)
      {{-- Question --}}
      <x-question.single :question="$question" />
      @empty
      {{ __('No question') }}
      @endforelse
    </div>
  </div>
</x-app-layout>