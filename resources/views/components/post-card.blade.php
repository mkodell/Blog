@props(['post'])

<article
    {{ $attributes->merge(['class' => "transition-colors duration-300 hover:bg-gray-100 border border-black border-opacity-0 hover:border-opacity-5 rounded-xl"]) }}>
    <div class="py-6 px-5">
        <div>
            <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="Blog Post illustration" class="rounded-xl">
        </div>

        <div class="mt-8 flex flex-col justify-between">
            <header>
                <div class="space-x-2">
                    <x-category-tag :category="$post->category" />
                </div>

                <div class="mt-4">
                    <h1 class="text-3xl">
                        <a href="/posts/{{ $post->title }}">
                            {{ $post->title }}
                        </a>
                    </h1>

                    @if ($post->updated == NULL)
                        <span class="mt-2 block text-gray-400 text-xs">
                            Published <time>{{ $post->published_at->diffForHumans() }}</time>
                        </span>
                    @else
                        <span class="mt-2 block text-gray-400 text-xs">
                            Updated <time>{{ $post->updated->diffForHumans() }}</time>
                        </span>
                    @endif

                    <span class="block text-gray-400 text-xs">
                        {{ $post->comments->count() }} comments
                    </span>

                </div>
            </header>

            <div class="text-sm mt-4 space-y-4">
                    {!! $post->excerpt !!}
            </div>

            <footer class="flex justify-between items-center mt-8">
                <div class="flex items-center text-sm">
                    <img src="{{ asset('storage/' . $post->author->avatar) }}"
                         width="60"
                         height="60"
                         class="rounded-full"
                         alt="Author avatar"
                    >
                    <div class="ml-3">
                        <h5 class="font-bold">
                            <a href="/?author={{ $post->author->username }}">{{ $post->author->username }}</a>
                        </h5>
                    </div>
                </div>

                <div>
                    <a href="/posts/{{ $post->title }}"
                       class="transition-colors duration-300 text-xs font-semibold bg-gray-200 hover:bg-gray-300 rounded-full py-2 px-8"
                    >Read More</a>
                </div>
            </footer>
        </div>
    </div>
</article>
