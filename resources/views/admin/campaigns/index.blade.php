<x-account-layout>
    <x-setting heading="Manage Campaigns">
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($campaigns as $campaign)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $campaign->settings->title }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $campaign->settings->reply_to }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($campaign->status == 'save' || $campaign->status == 'schedule')
                                            <span class="px-2 inline-fex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Draft
                                            </span>
                                        @elseif ($campaign->status == 'paused')
                                            <span class="px-2 inline-fex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Paused
                                            </span>
                                        @else
                                            <span class="px-2 inline-fex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                @if ($campaign->status == 'sending') Sending
                                                @else Sent
                                                @endif
                                            </span>
                                        @endif
                                    </td>
                                    @if ($campaign->status == 'save' || $campaign->status == 'paused')
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-xs font-medium">
                                            <a href="/admin/campaigns/{{ $campaign->id }}" class="text-blue-500 hover:text-blue-600">Edit</a>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <form method="POST" action="/admin/campaigns/{{ $campaign->id }}">
                                                @csrf

                                                <button class="text-xs text-blue-400">Send</button>
                                            </form>
                                        </td>
                                    @endif
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <form method="POST" action="/admin/campaigns/{{ $campaign->id }}">
                                            @csrf
                                            @method('DELETE')

                                            <button class="text-xs text-red-400">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </x-setting>
</x-account-layout>
