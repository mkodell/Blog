@auth
    <x-panel>
        <form method="POST" action="/posts/{{ $post->title }}/comments">
            @csrf

            <header class="flex items-center">
                <img
                    src="{{ asset('storage/' . auth()->user()->avatar) }}"
                    alt="User avatar"
                    width="40"
                    height="40"
                    class="rounded-full"
                >

                <h2 class="ml-4">Want to participate?</h2>
            </header>

            <div class="mt-6">
                <textarea
                    name="body"
                    class="w-full text-sm"
                    cols="30"
                    rows="5"
                    placeholder="Quick, think of something to say!"
                    required></textarea>

                <x-form.error name="body" />
            </div>

            <div class="flex justify-end mt-6 pt-6 border-t border-gray-100">
                <x-form.button>Post</x-form.button>
            </div>

        </form>
    </x-panel>

@else
    <p class="font-semibold">
        <a href="/register" class="hover:underline">Register</a> or <a href="login" class="hover:underline">Log in</a> to participate in this discussion.</a>
    </p>
@endauth
