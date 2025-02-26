<?php require('partials/head.php') ?>
<nav class="bg-gray-800 p-4">
    <div class="container mx-auto flex justify-between items-center">
        <a href="/">
            <div class="text-white text-2xl font-bold">
                UMS
            </div>
        </a>
        <div x-data="{ isOpen: false, openedWithKeyboard: false }" class="relative w-fit" x-on:keydown.esc.window="isOpen = false, openedWithKeyboard = false">
            <!-- Toggle Button -->
            <button type="button" x-on:click="isOpen = ! isOpen" class="inline-flex items-center gap-2 whitespace-nowrap rounded-xl border border-neutral-300 bg-neutral-200 px-4 py-2 text-sm font-medium tracking-wide transition hover:opacity-75 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-neutral-800 dark:border-neutral-700 dark:bg-neutral-900 dark:focus-visible:outline-neutral-300" aria-haspopup="true" x-on:keydown.space.prevent="openedWithKeyboard = true" x-on:keydown.enter.prevent="openedWithKeyboard = true" x-on:keydown.down.prevent="openedWithKeyboard = true" x-bind:class="isOpen || openedWithKeyboard ? 'text-black dark:text-neutral-100' : 'text-neutral-800 dark:text-neutral-300'" x-bind:aria-expanded="isOpen || openedWithKeyboard">
                <svg aria-hidden="true" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4 rotate-0">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
            </button>
            <!-- Dropdown Menu -->
            <div x-cloak x-show="isOpen || openedWithKeyboard" x-transition x-trap="openedWithKeyboard" x-on:click.outside="isOpen = false, openedWithKeyboard = false" x-on:keydown.down.prevent="$focus.wrap().next()" x-on:keydown.up.prevent="$focus.wrap().previous()" class="absolute top-11 left-0 flex w-fit min-w-48 flex-col overflow-hidden rounded-xl border border-neutral-300 bg-neutral-200 py-1.5 dark:border-neutral-700 dark:bg-neutral-900" role="menu">
                <form method="POST" action="/session" class="bg-neutral-200 px-4 py-2 text-sm text-neutral-800 hover:bg-neutral-900/5 hover:text-black focus-visible:bg-neutral-900/10 focus-visible:text-black focus-visible:outline-hidden dark:bg-neutral-900 dark:text-neutral-300 dark:hover:bg-neutral-200/5 dark:hover:text-neutral-100 dark:focus-visible:bg-neutral-200/10 dark:focus-visible:text-neutral-100">
                    <input type="hidden" name="_method" value="DELETE" />
                    <button class="text-white cursor-pointer">Log Out</button>
                </form>
            </div>
        </div>

    </div>
</nav>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">

        <div class="grid grid-cols-6 gap-4 mt-8 place-items-center max-w-6xl mx-auto">
            <!-- Row 1 -->
            <a href="/users" class="flex flex-col items-center p-4 bg-gray-800 rounded-lg hover:bg-gray-700">
                <svg class="w-8 h-8 text-blue-500 mb-2" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                </svg>
                <span class="text-blue-500">User & Role</span>
            </a>
            <!-- Add more menu items following the same pattern -->
            <a href="/products" class="flex flex-col items-center p-4 bg-gray-800 rounded-lg hover:bg-gray-700">
                <svg class="w-8 h-8 text-blue-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18v18H3V3zm3 3v12h12V6H6z" />
                </svg>
                <span class="text-blue-500">Products</span>
            </a>
            <!-- Continue adding more items as needed -->
        </div>
    </div>
</main>

<?php require('partials/footer.php') ?>