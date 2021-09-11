@push('stylesheets')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/css/splide.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>
    <script>
        new Splide('.splide', {
            type: 'fade',
            rewind: true,
        }).mount();

    </script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="{{ asset('js/currency/currency.min.js') }}"></script>
    <?php
        echo "<script>
            flatpickr('#date', {
                mode: 'range',
                minDate: 'today',
                dateFormat: 'Y-m-d',
                disable: [";
                foreach ($bookings as $book) {
                        if(str_contains($book, 'to')) {
                            $book = explode(" to ", $book);
                            $from = $book[0];
                            $to = $book[1];
                            echo "
                            {
                            from: '".$from."',
                            to: '".$to."'
                            },";
                        } else {
                            echo "'$book',";
                        }
                        }
                echo "],
                onChange: function(selectedDates, dateStr, instance) {
                    let daysInRange = document.getElementsByClassName('inRange');
                    let daysLengthTotal = daysInRange.length + 1;
                    let facilityPrice = document.getElementById('facility_price').value;
                    let bookingTotal = document.getElementById('price');
                    let calculation = facilityPrice * daysLengthTotal
                    bookingTotal.value = currency(calculation, { fromCents: true }).format();
                }
            });
        </script>"; ?>
@endpush

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Facilities') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="container mx-auto sm:px-6 lg:px-8 flex flex-wrap">
            @if(session('message'))
                <div class="bg-green-700 text-gray-200 m-2 p-2 rounded-md mb-4 w-full">
                    {{ session('message') }}
                </div>
            @endif
            <div class="w-7/12 bg-white overflow-hidden shadow-sm sm:rounded-lg mr-auto">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="font-semibold text-lg text-gray-800 leading-tight mb-6">
                        {{ $facility->name }}
                    </h3>
                    <div class="flex flex-wrap w-full">
                        <div class="splide h-96 w-full mb-8">
                            <div class="splide__track">
                                <ul class="splide__list">
                                    @foreach($facility->images as $image)
                                        <li class="splide__slide">
                                            <img src="{{ asset('storage/facilities') . '/' . $image->path }}"
                                                class="h-96 w-full">
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <h2 class="font-semibold text-right text-xl text-gray-800 leading-tight mb-1">
                        {{ $facility->formattedPrice }} / day
                    </h2>
                    <h3 class="font-semibold text-lg text-gray-800 leading-tight mb-6">
                        About
                    </h3>
                    <p>
                        {!! $facility->content !!}
                    </p>
                </div>
            </div>
            <div class="w-4/12 bg-white overflow-hidden shadow-sm sm:rounded-lg  border-b border-gray-200">
                <div class="p-6 bg-white">
                    @if($errors->any())
                        @foreach($errors->all() as $error)
                            <div class="bg-red-700 text-gray-200 m-2 p-2 rounded-md mb-4">{{ $error }}</div>
                        @endforeach
                    @endif
                    <h3 class="font-semibold text-lg text-gray-800 leading-tight">
                        Book This Facility
                    </h3>
                    <form method="POST" action="{{ route('facility.store') }}"
                        class="p-10 bg-white rounded shadow-xl">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="facility_id" value="{{ $facility->id }}">
                        <div class="mb-4">
                            <label class="block text-sm text-gray-600 mb-2" for="price">Total Cost</label>
                            <input type="hidden" name="facility_price" id="facility_price"
                                value="{{ $facility->price->amount() }}" readonly />
                            <div class="w-full px-2 py-1 text-gray-700 bg-gray-200 rounded">
                                {{ $facility->formattedPrice }}
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm text-gray-600 mb-2" for="date">Booking Arrival /
                                Departure</label>
                            <input type="text" name="date" value=""
                                class="flatpickr js-flatpickr-datetime w-full px-2 py-1 text-gray-700 bg-gray-200 rounded"
                                id="date" required />
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm text-gray-600 mb-2" for="price">Total Cost</label>
                            <input type="text" name="price" value=""
                                class="w-full px-2 py-1 text-gray-700 bg-gray-200 rounded" id="price" readonly
                                required />
                        </div>
                        <div class="mt-6">
                            <button
                                class="px-4 py-3 text-white tracking-wider font-semibold text-lg bg-gray-900 rounded block w-full text-center"
                                type="submit">
                                Book this Facility
                            </button>
                        </div>
                    </form>
                    @guest
                        <p class="mt-3 text-center">Don't you have an account? <a class="font-bold"
                                href="{{ route('register') }}">Create one</a> or <a class="font-bold"
                                href="{{ route('login') }}">sign up</a></p>
                    @endguest
                </div>
            </div>
            <div class="w-full mt-12 bg-white overflow-hidden shadow-sm sm:rounded">
                <div class="p-6">
                    <h3 class="font-semibold text-lg text-gray-800 leading-tight mb-6">
                        Other Facilities
                    </h3>
                    <div class="flex flex-wrap -mx-4">
                        @foreach($facilities as $facility)
                            <div class="w-full sm:w-1/2 md:w-1/2 xl:w-1/3 p-4">
                                <div
                                    class="c-card h-full block bg-white shadow-md hover:shadow-xl rounded-lg overflow-hidden">
                                    <a href="{{ route('facility.show', ['slug' => $facility->slug]) }}"
                                        class="relative pb-48 block">
                                        <img class="absolute inset-0 h-full w-full object-cover"
                                            src="{{ asset('storage/facilities') . '/' . $facility->images[0]->path }}"
                                            alt="">
                                    </a>
                                    <div class="p-4">
                                        <span
                                            class="inline-block px-2 py-1 leading-none bg-orange-200 text-orange-800 rounded-full font-semibold uppercase tracking-wide text-xs">{{ $facility->category->name }}</span>
                                        <h2 class="mt-2 mb-2 font-bold">
                                            <a
                                                href="{{ route('facility.show', ['slug' => $facility->slug]) }}">
                                                {{ $facility['name'] }}
                                            </a>
                                        </h2>
                                        <p class="text-sm">
                                            {{ mb_strimwidth(strip_tags($facility->content), 0, 150, "...") }}
                                        </p>
                                        <div class="mt-3 flex items-center">
                                            <span
                                                class="font-bold text-xl">{{ $facility->formattedPrice }}</span>&nbsp;
                                            <span class="text-sm font-semibold">/ per day</span>
                                        </div>
                                    </div>
                                    <div class="p-4 flex items-center text-sm text-gray-600">
                                        <a href="{{ route('facility.show', ['slug' => $facility->slug]) }}"
                                            class="px-4 py-3 text-white tracking-wider font-semibold text-lg bg-gray-900 rounded block w-full text-center">Book
                                            this facility</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
