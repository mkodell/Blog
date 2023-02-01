<x-form.section>
    <x-form.label name="category" />

    <select name="category_id" id="category_id">
        @foreach (\App\Models\Category::all() as $category)
            <option
                value="{{ $category->id }}"
                {{ old('category_id') == $category->id ? 'selected' : '' }}
            >{{ $category->name }}</option>
        @endforeach
    </select>

    <x-form.error name="category" />
</x-form.section>
