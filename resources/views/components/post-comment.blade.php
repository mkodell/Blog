@props(['comment'])

<x-panel class="bg-gray-50">
    <article class="flex space-x-4">
        <div class="flex-shrink-0">
            <img
                src="{{ asset('storage/' . $comment->author->avatar) }}"
                width="40"
                height="40"
                class="rounded-full"
                alt="Author avatar"
            >
        </div>

        <div>
            <div class="md:flex md:justify-between md:items-center">
                <header class="mb-4">
                    <h3 class="font-bold">{{ $comment->author->username }}</h3>
                    {{-- TODO: same as published vs updated for posts--}}
                    <p class="text-xs">
                        Posted <time>{{ $comment->created_at->format("F j, Y, g:i") }}</time>
                    </p>
                </header>

                @if ($comment->author->id == auth()->user()->id)
                    <a href="/comments/{{ $comment->id }}/edit" class="text-xs text-blue-600 mb-4">Edit</a>

                    <form method="POST" action="/comments/{{ $comment->id }}">
                        @csrf
                        @method('DELETE')

                        <button class="text-xs text-red-400 mb-4">Delete</button>
                    </form>
                @endif
            </div>

            <p>
                {{ $comment->body }}
            </p>
        </div>
    </article>
</x-panel>
