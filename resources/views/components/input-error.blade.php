@props(['for'])

@error ($for)
<div class="text-sm text-red-600">
  {{ $message }}
</div>
@enderror