@props(['answer'])

<div class="flex flex-col">
  <div>
    <span class="text-xs text-gray-500">{{ __('Answed by') }}</span>
    @if ($answer->user->name)
    <a href="{{ $answer->user->url }}" class="font-bold text-sky-500">
      {{ $answer->user->name }}
    </a>
    @else
    <span>Anonymous</span>
    @endif
  </div>
  <div class="text-xs">
    {{ $answer->created_date }}
  </div>
</div>