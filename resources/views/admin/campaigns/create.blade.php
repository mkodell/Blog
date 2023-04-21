<x-account-layout>
    <x-setting heading="Create A New Campaign">
        <form method="POST" action="/admin/campaigns" enctype="multipart/form-data">
        @csrf

            <x-form.section>
                <x-form.label name="type" />
                <select name="type" id="type">
                    <option
                        value="plaintext"
                    >Plain Text</option>
                </select>
                <x-form.error name="type" />
            </x-form.section>

            <x-form.textarea name="title" required/>
            <x-form.textarea name="subject" required/>

            <x-form.button>Save</x-form.button>

        </form>
    </x-setting>
</x-account-layout>
