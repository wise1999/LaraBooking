@extends('admin.main')

@section('title', 'Add New User')

@section('content')

<a href="{{ route('users.index') }}"
    class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded ml-auto my-2 table">Go Back</a>

@if(session('message'))
    <div class="bg-sidebar text-gray-200 m-2 p-2 rounded-md">{{ session('message') }}</div>
@endif

@if($errors->any())
    @foreach($errors->all() as $error)
        <div class="bg-red-700 text-gray-200 m-2 p-2 rounded-md">{{ $error }}</div>
    @endforeach
@endif

<form action="{{ route('users.store') }}" method="POST" class="p-10 bg-white rounded shadow-xl">
    @csrf
    <p class="text-lg text-gray-800 font-medium pb-4">New User</p>
    <div class="mb-4">
        <label class="block text-sm text-gray-600 mb-2" for="name">Name</label>
        <input class="w-full px-2 py-1 text-gray-700 bg-gray-200 rounded" id="name" name="name" type="text"
            placeholder="User Name" aria-label="name">
    </div>
    {{--  <div class="mb-4">
        <label class="text-sm block text-gray-600 mb-2" for="cus_email">City</label>
        <input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="cus_email" name="cus_email" type="text"
            required="" placeholder="City" aria-label="Email">
    </div>  --}}
    <div class="mt-6">
        <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded" type="submit">Add
            User</button>
    </div>
</form>

@endsection
