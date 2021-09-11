<!-- Desktop Header -->
<header class="w-full items-center bg-white py-2 px-6 hidden sm:flex">
    <div class="w-1/2"></div>
    <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
        <button @click="isOpen = !isOpen" class="realtive z-10 overflow-hidden focus:outline-none h-12">
            <span>{{ auth()->user()->name }}</span>
        </button>
        <button x-show="isOpen" @click="isOpen = false" class="h-full w-full fixed inset-0 cursor-default"></button>
        <div x-show="isOpen" class="absolute w-32 bg-white rounded-lg shadow-lg py-2 mt-16">
            <a href="{{ route('dashboard') }}"
                class="block px-4 py-2 account-link hover:text-white">Dashboard</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="route('logout')" onclick="event.preventDefault();
                                            this.closest('form').submit();"
                    class="block px-4 py-2 account-link hover:text-white">
                    {{ __('Log Out') }}
                </a>
            </form>
        </div>
    </div>
</header>
