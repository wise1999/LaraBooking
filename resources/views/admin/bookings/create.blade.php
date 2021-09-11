@extends('admin.main')

@section('title', 'Add New Booking Manually')

@section('content')

@push('stylesheets')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

<a href="{{ route('bookings.index') }}"
    class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded ml-auto my-2 table">Go Back</a>

@if(session('message'))
    <div class="bg-sidebar text-gray-200 m-2 p-2 rounded-md">{{ session('message') }}</div>
@endif

@if($errors->any())
    @foreach($errors->all() as $error)
        <div class="bg-red-700 text-gray-200 m-2 p-2 rounded-md">{{ $error }}</div>
    @endforeach
@endif
<div>
    @livewire('booking-create')
</div>
@endsection
