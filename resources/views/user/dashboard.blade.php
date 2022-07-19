<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <a href="{{ route('questions.create') }}"
            class="text-white bg-cyan-500 hover:bg-cyan-600 transition-colors py-2 px-4 rounded">{{ __('Ask') }}</a>
    </x-slot>

    <div class="max-w-3xl mx-auto pt-6 pb-10 px-2 sm:px-0">
        <div class="space-y-8">
            @forelse ($questions as $question)
            {{-- Question --}}
            <x-question.single :question="$question" />
            @empty
            {{ __('No question') }}
            @endforelse

            {{ $questions->links() }}
        </div>
    </div>
</x-app-layout>