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
        <div>
            @auth
                @if ($comment->author->id == auth()->user()->id)
                    <div class="md:flex md:justify-start md:items-center ml-32">
                        <table class="min-w-full divide-y bg-gray-50">
                            <tbody class="divide-y bg-gray-50">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="text-sm font-medium">
                                            <a href="/comments/{{ $comment->id }}/edit" class="text-blue-600">Edit</a>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="text-sm font-medium">
                                            <form method="POST" action="/comments/{{ $comment->id }}">
                                                @csrf
                                                @method('DELETE')

                                                <button class="text-red-400">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                @endif
            @endauth
        </div>
    </article>

        <div>
            <p>
                {{ $comment->body }}
            </p>
        </div>
</x-panel>
