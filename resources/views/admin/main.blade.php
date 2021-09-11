<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - LaraBooking</title>
    <meta name="author" content="David Grzyb">
    <meta name="description" content="">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .font-family-karla {
            font-family: karla;
        }

        .bg-sidebar {
            background: #3d68ff;
        }

        .cta-btn {
            color: #3d68ff;
        }

        .upgrade-btn {
            background: #111827;
        }

        .upgrade-btn:hover {
            background: #0038fd;
        }

        .active-nav-link {
            background: #111827;
        }

        .nav-item:hover {
            background: #111827;
        }

        .account-link:hover {
            background: #3d68ff;
        }

    </style>
    @stack('stylesheets')
    @livewireStyles
</head>

<body class="bg-gray-100 font-family-karla flex">
    @include('admin.partials.sidebar')
    <div class="relative w-full flex flex-col h-screen overflow-y-hidden">
        @include('admin.partials.header')
        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                @yield('content')
            </main>
            @include('admin.partials.footer')
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"
        integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
    @stack('scripts')
    @livewireScripts
</body>

</html>
