<x-layout>
    <section class="py-8 max-w-2xl mx-auto">
        <h1 class="text-xl font-bold text-xl font-bold mb-8 pb-2 border-b">User Account</h1>

        <x-panel>
            <form method="POST" action="/account/{{ $user->username }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <x-form.input name="name" :value="old('name', $user->name)"/>
                <x-form.input name="username" :value="old('username', $user->username)"/>
                <x-form.input name="email" :value="old('email', $user->email)"/>
                <div class="flex mt-6">
                    <div class="flex-1">
                        <x-form.input name="avatar" type="file" :value="old('avatar', $user->avatar)"/>
                    </div>

                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="avatar" class="rounded-xl ml-6" width="100">
                </div>

                <x-form.button>Save</x-form.button>

                </div>
            </form>
        </x-panel>
    </section>
</x-layout>
