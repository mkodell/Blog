@props(['heading'])

<section class="py-8 max-w-4xl mx-auto">
    <h1 class="text-xl font-bold mb-8 pb-2 border-b">{{ $heading }}</h1>

    <div class="flex">
        @admin
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
                    <a href="/newsletter/listCampaigns" class="{{ request()->is('newsletter/listCampaigns') ? 'text-blue-500' : ''}} ">All Campaigns</a>
                </li>
                <li>
                    <a href="/admin/posts/create" class="{{ request()->is('admin/posts/create') ? 'text-blue-500' : ''}} ">New Post</a>
                </li>
                <li>
                    <a href="/admin/categories/create" class="{{ request()->is('admin/categories/create') ? 'text-blue-500' : ''}} ">New Category</a>
                </li>
                <li>
                    <a href="/newsletter/createCampaign" class="{{ request()->is('newsletter/createCampaign') ? 'text-blue-500' : ''}} ">New Campaign</a>
                </li>
            </ul>
        </aside>
        @endadmin

        <main class="flex-1">
            <x-panel>
                {{ $slot }}
            </x-panel>
        </main>
    </div>
</section>
