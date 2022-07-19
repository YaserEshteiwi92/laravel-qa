<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Notifications') }}
    </h2>
    <a href="{{ route('dashboard') }}"
      class="text-white bg-cyan-500 hover:bg-cyan-600 transition-colors py-2 px-4 rounded">{{ __('Back') }}</a>
  </x-slot>

  <div class="max-w-3xl mx-auto pt-6 pb-10 px-2 sm:px-0">
    <div>
      @if ($notifications->count())
      <div class="flex justify-end">
        <a href="{{ route('notifications.readAll') }}" class="transition-colors hover:text-gray-600">
          {{ __('Make all as read') }}
        </a>
      </div>
      <ul class="space-y-4 mt-6 list-none" id="notification-list">
        @foreach ($notifications as $notification)
        {{-- Notification --}}
        <x-notification.single :notification=" $notification" />
        @endforeach
      </ul>
      @else
      {{ __('No notifications') }}
      @endif
    </div>
  </div>

</x-app-layout>