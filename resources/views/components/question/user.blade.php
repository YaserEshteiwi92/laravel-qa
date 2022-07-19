@props(['user' , 'createdDate'])

<div class="flex items-center gap-2">
  <img src="{{ $user->avatar_url }}" alt="img_{{ Str::slug($user->name) }}" class="w-14 h-14 rounded-full" />
  <div>
    <h3 class="text-3xl font-extrabold capitalize">
      <a href="{{ $user->url }}" class="text-sky-500 font-bold">{{ $user->name }}</a>
    </h3>
    <h5 class="text-xs">{{ $createdDate }}</h5>
  </div>
</div>