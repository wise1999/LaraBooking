<aside class="relative bg-gray-800 h-screen w-64 hidden sm:block shadow-xl">
    <div class="p-6">
        <a href="index.html" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">LaraBooking</a>
    </div>
    <nav class="text-white text-base font-semibold pt-3">
        <a href="{{ route('admin.dashboard') }}"
            class="{{ request()->routeIs('admin.dashboard') ? 'bg-gray-900' : 'opacity-75 hover:opacity-100' }}  flex items-center text-white py-4 pl-6 nav-item">
            <i class="fas fa-tachometer-alt mr-3"></i>
            Dashboard
        </a>
        <a href="{{ route('bookings.index') }}"
            class="{{ request()->routeIs('bookings.index') ? 'bg-gray-900' : 'opacity-75 hover:opacity-100' }}  flex items-center text-white py-4 pl-6 nav-item">
            <i class="fas fa-book mr-3"></i>
            Bookings
        </a>
        <div
            class="{{ request()->routeIs('facilities.index') ? 'bg-gray-900' : 'opacity-75 hover:opacity-100' }} flex items-center text-white nav-item flex-col">
            <a class="py-4 pl-6 block w-full" href="{{ route('facilities.index') }}">
                <i class="fas fa-building mr-3"></i>
                Facilities
            </a>
            <a class="{{ request()->routeIs('facilities.index') ? 'block' : 'hidden' }} w-full py-4 pl-6 text-sm"
                href="{{ route('categories.index') }}">
                Categories
            </a>
        </div>
        <a href="{{ route('users.index') }}"
            class="{{ request()->routeIs('users.index') ? 'bg-gray-900' : 'opacity-75 hover:opacity-100' }}  flex items-center text-white py-4 pl-6 nav-item">
            <i class="fas fa-users mr-3"></i>
            Users
        </a>
    </nav>
</aside>
