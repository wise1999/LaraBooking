@extends('admin.main')

@section('title', 'Edit Current Facility')

@section('content')
@push('stylesheets')
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css"
        rel="stylesheet">
@endpush

<a href="{{ route('facilities.index') }}"
    class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded ml-auto my-2 table">Go Back</a>

@if(session('message'))
    <div class="bg-sidebar text-gray-200 m-2 p-2 rounded-md">{{ session('message') }}</div>
@endif

@if($errors->any())
    @foreach($errors->all() as $error)
        <div class="bg-red-700 text-gray-200 m-2 p-2 rounded-md">{{ $error }}</div>
    @endforeach
@endif

<form action="{{ route('facilities.update', $facility->slug) }}" method="POST"
    class="p-10 bg-white rounded shadow-xl" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <p class="text-lg text-gray-800 font-medium pb-4">Edit Facility</p>
    <div class="mb-4">
        <label class="block text-sm text-gray-600 mb-2" for="name">Name</label>
        <input class="w-full px-2 py-1 text-gray-700 bg-gray-200 rounded" id="name" name="name" type="text"
            placeholder="Facility Name" value="{{ $facility->name }}" aria-label="name">
    </div>
    <div class="mb-4">
        <label class="block text-sm text-gray-600 mb-2" for="category">Select Category</label>
        <select name="category" id="category" class="w-full px-2 py-1 text-gray-700 bg-gray-200 rounded">
            @foreach($categories as $category)
                <option name="category" value="{{ $category->id }}"
                    {{ $facility->category && $facility->category->id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-4">
        <label class="block text-sm text-gray-600 mb-2" for="price">Price Per Day</label>
        <input class="w-full px-2 py-1 text-gray-700 bg-gray-200 rounded" id="price" name="price" type="text"
            value="{{ $facility->formattedPrice }}" placeholder="{{ $facility->formattedPrice }}"
            aria-label="price">
    </div>
    <div class="mb-4">
        <label class="block text-sm text-gray-600 mb-2" for="content">Content</label>
        <textarea class="w-full px-2 py-1 text-gray-700 bg-gray-200 rounded" id="content" name="content"
            placeholder="Your Content Goes Here..." aria-label="price">{{ $facility->content }}</textarea>
    </div>
    @livewire(
        'delete-facility-images',
        [
        'facility' => $facility,
        'images' => $images
        ])

        <div class="mt-6">
            <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded"
                type="submit">Update</button>
        </div>
</form>

@push('scripts')
    <script src="{{ asset('js/tinymce/js/tinymce/tinymce.min.js') }}"></script>
    <script>
        tinymce.init({
            selector: '#content',
            height: 300,
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table paste",
            ],
            toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
        });

    </script>
    <script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>
    <script>
        FilePond.setOptions({
            server: {
                process: "{{ config('filepond.server.process') }}",
                revert: "{{ config('filepond.server.revert') }}",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                }
            }
        });

        document.addEventListener('DOMContentLoaded', function () {
            FilePond.registerPlugin(
                FilePondPluginImagePreview,
            );

            const inputElement = document.querySelector('input[type="file"]');
            const pond = FilePond.create(inputElement);
        });

    </script>
@endpush

@endsection
