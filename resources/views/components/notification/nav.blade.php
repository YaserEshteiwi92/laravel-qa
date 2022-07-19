@props(['screen' => 'web'])

@if ($screen === 'web')
<x-nav-link :href="route('notifications.index')" :active="request()->routeIs('notifications.index')">
    {{ __('Notifications') }}
    <x-notification.count :count="$count" />
</x-nav-link>
@else
<x-responsive-nav-link :href="route('notifications.index')" :active="request()->routeIs('notifications.index')">
    {{ __('Notifications') }}
    <x-notification.count :count="$count" />
</x-responsive-nav-link>
@endif