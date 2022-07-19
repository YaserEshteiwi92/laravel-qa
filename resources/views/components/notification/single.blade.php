@props(['notification'])

<li>
  <a href="{{ route('notifications.read' , $notification->id) }}"
    class="w-full flex justify-between gap-4 p-4 bg-gray-200 rounded border border-gray-300 overflow-hidden">
    <div>
      {{ $notification->data['body'] }}
    </div>
    <div class="text-xs self-end">
      {{ $notification->created_at->diffForHumans() }}
    </div>
  </a>
</li>