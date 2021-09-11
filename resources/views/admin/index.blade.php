@extends('admin.main')

@section('title', 'Dashboard')

@section('content')

<h1 class="text-3xl text-black pb-6">Dashboard</h1>

<div class="w-full mt-6">
    <p class="text-xl pb-3 flex items-center">
        <i class="fas fa-list mr-3"></i> Latest Reservations
    </p>
    <div class="bg-white overflow-auto">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Facility</th>
                    <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">User</th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Total</th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Booked Date</td>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Arrival / Departure</td>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Status</td>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach($bookings as $booking)
                    <tr>
                        <td class="w-1/3 text-left py-3 px-4">{{ $booking->facility->name }}</td>
                        <td class="w-1/3 text-left py-3 px-4">{{ $booking->user->name }}
                            ({{ $booking->user->email }})</td>
                        <td class="text-left py-3 px-4">
                            {{ $booking->formattedPrice }}
                        </td>
                        <td class="text-left py-3 px-4">
                            {{ $booking->created_at->diffForHumans() }}
                        </td>
                        <td class="text-left py-3 px-4">
                            {{ $booking->date }}
                        </td>
                        <td class="text-left py-3 px-4">
                            {{ $booking->status->name }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="w-full mt-12">
    <p class="text-xl pb-3 flex items-center">
        <i class="fas fa-list mr-3"></i> Latest Users
    </p>
    <div class="bg-white overflow-auto">
        <table class="text-left w-full border-collapse">
            <thead>
                <tr>
                    <th
                        class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                        ID</th>
                    <th
                        class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                        Full Name</th>
                    <th
                        class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                        Email</th>
                    <th
                        class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                        Registration Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="hover:bg-grey-lighter">
                        <td class="py-4 px-6 border-b border-grey-light">{{ $user->id }}</td>
                        <td class="py-4 px-6 border-b border-grey-light">{{ $user->name }}</td>
                        <td class="py-4 px-6 border-b border-grey-light">{{ $user->email }}</td>
                        <td class="py-4 px-6 border-b border-grey-light">{{ $user->created_at->diffForHumans() }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
