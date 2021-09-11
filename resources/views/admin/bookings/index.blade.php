@extends('admin.main')

@section('title', 'Bookings List')

@section('content')

<a href="{{ route('bookings.create') }}"
    class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded ml-auto my-2 table">Add
    New Booking Manually</a>

@if(session('message'))
    <div class="bg-sidebar text-gray-200 m-2 p-2 rounded-md">{{ session('message') }}</div>
@endif

<table class="min-w-full leading-normal">
    <thead>
        <tr>
            <th
                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Facility
            </th>
            <th
                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                User
            </th>
            <th
                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Total
            </th>
            <th
                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Booked Date
            </th>
            <th
                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Arrival / Departure
            </th>
            <th
                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Status
            </th>
            <th
                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Actions
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($bookings as $booking)
            <tr>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    <div class="flex items-center">
                        <div>
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ $booking->facility->name }}
                            </p>
                        </div>
                    </div>
                </td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    <p class="text-gray-900 whitespace-no-wrap">
                        {{ $booking->user->name }} ({{ $booking->user->email }})
                    </p>
                </td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    <p class="text-gray-900 whitespace-no-wrap">
                        {{ $booking->formattedPrice }}
                    </p>
                </td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    <p class="text-gray-900 whitespace-no-wrap">
                        {{ $booking->created_at->diffForHumans() }}
                    </p>
                </td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    <p class="text-gray-900 whitespace-no-wrap">
                        {{ $booking->date }}
                    </p>
                </td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    <p class="text-gray-900 whitespace-no-wrap">
                        {{ $booking->status->name }}
                    </p>
                </td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    <a href="{{ route('bookings.edit', $booking->id) }}"
                        class="inline-block px-6 py-4 font-semibold text-green-900 leading-tight inset-0 bg-green-400 opacity-75 rounded-xl hover:opacity-100">
                        Edit</a>
                    <span class="inline-block">
                        <form action="{{ route('bookings.destroy', $booking->id) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="text-white px-6 py-4 font-semibold leading-tight inset-0 bg-red-400 opacity-75 rounded-xl hover:opacity-100"><i
                                    class="fas fa-trash-alt"></i></button>
                        </form>
                    </span>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
