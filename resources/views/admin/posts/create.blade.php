<x-account-layout>
    <x-setting heading="Publish New Post">
        <form method="POST" action="/admin/posts" enctype="multipart/form-data">
            @csrf

            <x-form.input name="title" required/>
            <x-form.input name="thumbnail" type="file" required/>
            <x-form.textarea name="excerpt"/>
            <x-form.textarea name="body"/>

            <x-form.category-dropdown />

            <x-form.section>
                <x-form.label name="status" />

                <select name="status" id="status">
                    <option value="draft">
                        Draft
                    </option>
                    <option value="published">
                        Published
                    </option>
                </select>

                <x-form.error name="status" />
            </x-form.section>

            <x-form.button>Save</x-form.button>

        </form>
    </x-setting>
</x-account-layout>
