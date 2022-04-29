{{-- TODO: investigate making this integrate with the post page --}}

<x-layout>
    <div class="mt-12 mx-60">
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
                        cols="30"
                        rows="5"
                        required
                    >
                        {{ $comment->body }}
                    </textarea>

                    <x-form.error name="body" />
                </div>

                <div class="flex justify-end mt-6 pt-6 border-t border-gray-100">
                    <x-form.button>Update</x-form.button>
                </div>
            </form>
        </x-panel>
    </div>
</x-layout>
