<x-layout>
    <x-setting heading="Create New Category">
        <form method="POST" action="/admin/categories" enctype="application/x-www-form-urlencoded">
            @csrf

            <x-form.input name="name"/>
            <x-form.input name="slug"/>

            <x-form.button>Create</x-form.button>
        </form>
    </x-setting>
</x-layout>
