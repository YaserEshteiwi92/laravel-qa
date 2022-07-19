@php
$actionUrl = $method === 'update'
? route('answers.update' , [$question->slug , $answer->id])
: route('answers.store' , $question);
@endphp

<div class="p-2">
  <form action="{{ $actionUrl }}" method="post" class="space-y-4">
    @csrf
    @if ($method === 'update')
    @method('PUT')
    @endif
    <div class="flex flex-col gap-1">
      <x-textarea name="content" rows="8" placeholder="{{ __('Your answer') }}">{{ old('content' ,
        $answer->content ?? null)
        }}
      </x-textarea>
      <x-input-error for="content" />
    </div>
    <div>
      <x-button class="w-full">{{ __("$btnText") }}</x-button>
    </div>
  </form>
</div>