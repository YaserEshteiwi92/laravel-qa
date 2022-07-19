<div class="max-w-4xl mx-auto mt-6 pt-6 pb-10 px-2 sm:px-0">
  <div class="flex flex-col bg-gray-200 rounded border border-gray-300 overflow-hidden">
    <div class="py-2 px-4 bg-sky-900 text-white text-2xl font-bold">
      {{ __('Answers') }}
    </div>
    <div class="divide-y-2 divide-gray-100 mt-4 border-b-2 border-gray-100">
      @foreach ($answers as $answer)
      <x-answer.single :answer="$answer" :question="$question" />
      @endforeach
    </div>
    {{-- Answer Form --}}
    @auth
    @include('answers._form' , [
    'question' => $question,
    'answer' => null,
    'btnText' => 'Save',
    'method' => 'post'
    ])
    @endauth
  </div>
</div>