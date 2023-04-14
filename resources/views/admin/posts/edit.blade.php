<x-account-layout>
    <section class="py-8 max-w-4xl mx-auto">
        <h1 class="text-xl font-bold mb-8 pb-2 border-b">Edit Post: {{ $post->title }}</h1>

        <div class="flex">
            <aside class="w-48 flex-shrink-0">
                <h4 class="font-semibold mb-4">Links</h4>
                <ul>
                    <li>
                        <a href="/admin/posts" class="{{ request()->is('admin/posts') ? 'text-blue-500' : ''}} ">All Posts</a>
                    </li>
                    <li>
                        <a href="/admin/categories" class="{{ request()->is('admin/categories') ? 'text-blue-500' : ''}} ">All Categories</a>
                    </li>
                    <li>
                        <a href="/admin/posts/create" class="{{ request()->is('admin/posts/create') ? 'text-blue-500' : ''}} ">New Post</a>
                    </li>
                    <li>
                        <a href="/admin/categories/create" class="{{ request()->is('admin/categories/create') ? 'text-blue-500' : ''}} ">New Category</a>
                    </li>
                </ul>
            </aside>

            <main class="flex-1">
                <x-panel>
                    <form method="POST" action="/admin/posts/{{ $post->id }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <x-form.input name="title" :value="old('title', $post->title)"/>
                        <div class="flex mt-6">
                            <div class="flex-1">
                                <x-form.input name="thumbnail" type="file" :value="old('thumbnail', $post->thumbnail)"/>
                            </div>

                            <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="thumbnail" class="rounded-xl ml-6" width="100">
                        </div>
                        <x-form.textarea name="excerpt">{{ old('excerpt', $post->excerpt) }}</x-form.textarea>
                        <x-form.textarea name="body">{{ old('body', $post->body) }}</x-form.textarea>

                        <x-form.category-dropdown />

                        <x-form.section>
                            <x-form.label name="status" />

                            <select name="status" id="status">
                                <option
                                    value="draft"
                                    {{ old('status', $post->status) == 'draft' ? 'selected' : '' }}
                                >
                                    Draft
                                </option>
                                <option
                                    value="published"
                                    {{ old('status', $post->status) == 'published' ? 'selected' : '' }}
                                >
                                    Published
                                </option>
                            </select>

                            <x-form.error name="status" />
                        </x-form.section>

                        <x-form.button>Save</x-form.button>

                        {{-- TODO: message pops up if info has been changed, but hasn't been saved and user wants to leave the screen --}}

                    </form>
                </x-panel>
            </main>
        </div>
    </section>
</x-account-layout>
