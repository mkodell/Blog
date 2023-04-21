<x-account-layout>
    <x-setting heading="Add Campaign Content">
        <form method="POST" action="/admin/campaigns/{{ $campaign }}/content" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <x-form.textarea name="content" required/>

            <x-form.button>Save</x-form.button>
        </form>
    </x-setting>
</x-account-layout>
