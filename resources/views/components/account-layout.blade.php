<!doctype html>

<title>Laravel From Scratch Blog</title>
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

<style>
    html {
        scroll-behavior: smooth;
    }
</style>

<body style="font-family: Open Sans, sans-serif">
<section class="px-6 py-8">
    <nav class="md:flex md:justify-between md:items-center">
        <div>
            <a href="/">
                <img src="/images/logo.svg" alt="Laracasts Logo" width="165" height="16">
            </a>
        </div>

        <div class="mt-8 md:mt-0 flex items-center">
            @guest
                <a href="/register" class="text-xs font-bold uppercase">Register</a>
                <a href="/login" class="text-xs font-bold uppercase ml-6">Sign In</a>
            @else
                <x-dropdown>
                    <x-slot name="trigger">
                        <button class="text-xs font-bold uppercase">Welcome Back, {{ auth()->user()->username }}!</button>
                    </x-slot>

                    <x-dropdown-item href="/" :active="request()->routeIs('home')">Home</x-dropdown-item>
                    <x-dropdown-item href="/account/{{ auth()->user()->username }}" :active="request()->is('account/*')">Account</x-dropdown-item>

                    @admin
                    <x-dropdown-item href="/admin/posts" :active="request()->is('admin/posts')">Dashboard</x-dropdown-item>
                    <x-dropdown-item href="/admin/posts/create" :active="request()->is('admin/posts/create')">New Post</x-dropdown-item>
                    <x-dropdown-item href="/admin/categories/create" :active="request()->is('admin/categories/create')">New Category</x-dropdown-item>
                    @endadmin

                    <x-dropdown-item href="#" active="" x-data="{}" @click.prevent="document.querySelector('#logout-form').submit()" >Log Out</x-dropdown-item>

                    <form id="logout-form" method="POST" action="/logout" class="text-xs font-semibold text-blue-500 ml-6">
                        @csrf
                    </form>
                </x-dropdown>
            @endguest

            <a href="/account/{{ auth()->user()->username }}" class="bg-blue-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5">
                Subscribe for Updates
            </a>
        </div>
    </nav>

    {{ $slot }}

</section>
<x-flash />
</body>
