@extends('admin.main')

@section('title', 'Users List')

@section('content')

<a href="{{ route('users.create') }}"
    class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded ml-auto my-2 table">Add
    New</a>

@if(session('message'))
    <div class="bg-sidebar text-gray-200 m-2 p-2 rounded-md">{{ session('message') }}</div>
@endif

<table class="min-w-full leading-normal">
    <thead>
        <tr>
            <th
                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Name
            </th>
            <th
                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                E-mail
            </th>
            <th
                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Created at
            </th>
            <th
                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Actions
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 w-10 h-10">
                            <img class="w-full h-full rounded-full"
                                src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.2&w=160&h=160&q=80"
                                alt="" />
                        </div>
                        <div class="ml-3">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ $user->name }}
                            </p>
                        </div>
                    </div>
                </td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    <p class="text-gray-900 whitespace-no-wrap">
                        {{ $user->email }}
                    </p>
                </td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    <p class="text-gray-900 whitespace-no-wrap">
                        {{ $user->created_at->diffForHumans() }}
                    </p>
                </td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    <a href="{{ route('users.edit', $user->id) }}"
                        class="inline-block px-6 py-4 font-semibold text-green-900 leading-tight inset-0 bg-green-400 opacity-75 rounded-xl hover:opacity-100">
                        Edit</a>
                    <span class="inline-block">
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
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
