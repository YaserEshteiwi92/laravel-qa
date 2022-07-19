@props(['viewsCount' , 'answersCount'])

<div class="w-[80px] flex flex-col gap-6 py-4">
  {{-- Views Count --}}
  <div class="flex flex-col gap-1 items-center">
    <div class="text-xs">{{ __('Views') }}</div>
    <div class="font-bold">{{ $viewsCount }}</div>
  </div>
  {{-- Answers Count --}}
  <div class="flex flex-col gap-1 items-center">
    <div class="text-xs">{{ __('Answers') }}</div>
    <div class="font-bold">{{ $answersCount }}</div>
  </div>
</div>