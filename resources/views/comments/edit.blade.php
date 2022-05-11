{{-- TODO: investigate making this integrate with the post page --}}

<x-layout>
    <div class="mt-12 mx-60">

        <div class="hidden lg:flex justify-between mb-6">
            <a href="/"
               class="transition-colors duration-300 relative inline-flex items-center text-lg hover:text-blue-500">
                <svg width="22" height="22" viewBox="0 0 22 22" class="mr-2">
                    <g fill="none" fill-rule="evenodd">
                        <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z">
                        </path>
                        <path class="fill-current"
                              d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z">
                        </path>
                    </g>
                </svg>

                Back to Posts
            </a>
        </div>

        <x-panel>
            <form method="POST" action="/comments/{{ $comment->id }}">
                @csrf
                @method('PATCH')

                <header class="flex items-center">
                    <img
                        src="{{ asset('storage/' . auth()->user()->avatar) }}"
                        alt="User avatar"
                        width="40"
                        height="40"
                        class="rounded-full"
                    >
                    <h3 class="font-bold ml-4">{{ $comment->author->username }}</h3>
                </header>

                <div class="mt-6">
                    <textarea
                        name="body"
                        class="w-full text-sm"
                        rows="5"
                    >{{ $comment->body }}</textarea>

                    <x-form.error name="body" />
                </div>

                <div class="flex justify-end mt-6 pt-6 border-t border-gray-100">
                    <x-form.button>Update</x-form.button>
                </div>
            </form>
        </x-panel>
    </div>
</x-layout>
