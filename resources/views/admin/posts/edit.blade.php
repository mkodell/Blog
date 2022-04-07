<x-layout>
     <x-setting heading="{{'Edit Post: ' . $post->title}}">
        <form method="POST" action="/admin/posts/{{ $post->id }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <x-form.input name="title" :value="old('title', $post->title)"/>
            <x-form.input name="slug" :value="old('slug', $post->slug)"/>
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

            </div>
        </form>
    </x-setting>
</x-layout>
