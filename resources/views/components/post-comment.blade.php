@props(['comment'])

<x-panel class="bg-gray-50">
    <div class="flex justify-between">
        <div>
            <div class="flex flex-row">
                <div class="flex-shrink-0">
                    <img
                        src="{{ asset('storage/' . $comment->author->avatar) }}"
                        width="40"
                        height="40"
                        class="rounded-full"
                        alt="Author avatar"
                    >
                </div>

                <div class="ml-4">
                    <header class="mb-4">
                        <h3 class="font-bold">{{ $comment->author->username }}</h3>

                        @if ($comment->updated == NULL)
                            <p class="text-xs">
                                Posted <time>{{ $comment->posted->format("F j, Y, g:i") }}</time>
                            </p>
                        @else
                            <p class="text-xs">
                                Updated <time>{{ $comment->updated->format("F j, Y, g:i") }}</time>
                            </p>
                        @endif
                    </header>
                </div>
            </div>
        </div>

        @auth
            @if ($comment->author->id == auth()->user()->id)
                <div class="grow text-sm font-medium pt-2 mr-10">
                    <form method="POST" action="/comments/{{ $comment->id }}">
                        @csrf
                        @method('DELETE')

                        <button class="text-red-400">Delete</button>
                    </form>
                </div>
            @endif
        @endauth
    </div>

    <div>
        @auth
            @if ($comment->author->id == auth()->user()->id)
                <form method="POST" action="/comments/{{ $comment->id }}">
                    @csrf
                    @method('PATCH')

                    <textarea
                        name="body"
                        class="w-full text-sm px-3 py-2"
                        rows="4"
                    >{{ $comment->body }}</textarea>

                    <x-form.error name="body" />

                    <div class="flex justify-end pt-6">
                        <button
                            type="submit"
                            class="bg-blue-500 text-white uppercase font-semibold text-sm py-2 px-10 rounded-2xl hover:bg-blue-600"
                        >
                            Edit
                        </button>
                    </div>
                </form>
            @else
                <p>
                    {{ $comment->body }}
                </p>
            @endif

        @else
            <p>
                {{ $comment->body }}
            </p>
        @endauth
    </div>
</x-panel>
