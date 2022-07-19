@props(['answer' , 'question'])

{{-- Answer --}}
<div class="p-4">
  {{-- Answer - Content --}}
  <p>
    {!! $answer->content_html !!}
  </p>
  {{-- Answer - User / Actions --}}
  <div class="flex justify-between items-end mt-4">
    {{-- User Creator --}}
    <x-answer.user :answer="$answer" />
    {{--Actions Btn --}}
    <x-answer.actions-btn :answer="$answer" :question="$question" />
  </div>
</div>