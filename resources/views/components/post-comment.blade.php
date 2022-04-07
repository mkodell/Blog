@props(['comment'])

<x-panel class="bg-gray-50">
    <article class="flex space-x-4">
        <div class="flex-shrink-0 ">
            <img
                src="{{ asset('storage/' . $comment->author->avatar) }}"
                width="40"
                height="40"
                class="rounded-full"
                alt="Author avatar"
            >
        </div>

        <div>
            <header class="mb-4">
                <h3 class="font-bold">{{ $comment->author->username }}</h3>
                <p class="text-xs">
                    Posted
                    <time>{{ $comment->created_at->format("F j, Y, g:i") }}</time>
                </p>
            </header>

            <p>
                {{ $comment->body }}
            </p>
        </div>
    </article>
</x-panel>
