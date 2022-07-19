@php
$actionUrl = $method === 'store' ? route('questions.store') : route('questions.update' , $question->slug)
@endphp


<form action="{{ $actionUrl }}" method="post" class="space-y-8">
  @csrf

  @if ($method === 'update')
  @method('PUT')
  @endif

  <div class="flex flex-col gap-1">
    <x-label value="{{ __('Title') }}" />
    <x-input name="title" value="{{ old('title' , $question->title) }}" />
    <x-input-error for="title" />
  </div>
  <div class="flex flex-col gap-1">
    <x-label value="{{ __('Explain your problem') }}" />
    <x-textarea name="body" rows="6">{{ old('body' , $question->body) }}</x-textarea>
    <x-input-error for="body" />
  </div>
  <div>
    <x-button class="w-full">{{ __("$btnText") }}</x-button>
  </div>
</form>