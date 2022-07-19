@props(['answer' , 'question'])

<div class="flex gap-2">
  {{-- Update Button --}}
  <div class="flex gap-4">
    @can('update' , $answer)
    <a href="{{ route('answers.edit' , ['question' => $question->slug , 'answer' => $answer->id]) }}">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hover:text-gray-600 transition-colors" fill="none"
        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
      </svg>
    </a>
    @endcan

    {{-- Delete Button --}}
    @can('delete' , $answer)
    <form action="{{ route('answers.destroy' , ['question' => $question->slug , 'answer' => $answer->id]) }}"
      method="post" class="inline" onsubmit="return confirm('are you sure ?')">
      @csrf
      @method('DELETE')
      <button type="submit">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hover:text-gray-600 transition-colors" fill="none"
          viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </form>
    @endcan
  </div>
</div>