<x-account-layout>
    <section class="py-8 max-w-2xl mx-auto">
        <div class="mb-8 pb-2 border-b flex justify-between">
            <div class="text-xl font-bold text-gray-900">
                <h1 class="text-xl font-bold">User Account</h1>
            </div>
            <div class="text-lg font-medium text-gray-900 mr-12">
                <a href="/account/{{ $user->username }}/edit" class="text-blue-500 hover:text-blue-600 text-lg">Edit</a>
            </div>
        </div>

        <div class="py-2 inline-block">
            <div class="shadow overflow-hidden border-gray-200 sm:rounded-lg">
                <div class="shadow overflow-hidden border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="text-sm font-medium text-gray-900">
                                        <h4>Name: </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    {{ $user->name }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="text-sm font-medium text-gray-900">
                                        <h4>Username: </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    {{ $user->username }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="text-sm font-medium text-gray-900">
                                        <h4>Email: </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    {{ $user->email }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="text-sm font-medium text-gray-900">
                                        <h4>Password: </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    **Hidden for security reasons**
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="text-sm font-medium text-gray-900">
                                        <h4>Avatar: </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <img
                                        src="{{ asset('storage/' . $user->avatar) }}"
                                        width="60"
                                        height="60"
                                        class="rounded-full ml-6"
                                        alt="Author avatar"
                                    />
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="text-sm font-medium text-gray-900">
                                        <h4>Subscription Status:</h4>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium capitalize">
                                    {{ $status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <form method="POST" action="/account/newsletter/unsubscribe">
                                    @csrf
                                    @method('PATCH')

                                    <button class="text-sm text-red-400">Unsubscribe</button>
                                </form>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <form method="POST" action={{ $status == 'none' ? "/account/newsletter" : "/account/newsletter/resubscribe"}}>
                                    @csrf

                                    <button class="text-sm text-blue-400">Subscribe</button>
                                </form>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</x-account-layout>
