<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Update question') . " " . $question->title }}
    </h2>
    <a href="{{ route('questions.index') }}"
      class="text-white bg-cyan-500 hover:bg-cyan-600 transition-colors py-2 px-4 rounded">{{ __('Back') }}</a>
  </x-slot>

  <div class="max-w-3xl mx-auto pt-6 pb-10 px-2 sm:px-0">
    @include('questions._form' , [
    'question' => $question,
    'btnText' => 'Update',
    'method' => 'update'
    ])
  </div>

</x-app-layout>