<div>
    <label class="block text-sm text-gray-600 mb-2" for="content">Images</label>
    <div class="flex gap-x-4 mb-4">
        @foreach($images as $image)
            <div class="single-image w-24 h-24 relative" wire:key="{{ $loop->index }}">
                <img src="{{ asset('storage/facilities') . '/' . $image['path'] }}"
                    class="object-cover w-full h-full">
                <button onclick="event.preventDefault()" wire:click="removeImage({{ $loop->index }})" type="submit"
                    class="absolute -top-1 -right-1 text-white px-2 py-1 font-semibold leading-tight bg-red-400 opacity-75 rounded-xl hover:opacity-100"><i
                        class="fas fa-trash-alt"></i></button>
            </div>
        @endforeach
    </div>
    <div class="mb-4">
        <label class="block text-sm text-gray-600 mb-2" for="content">Upload new images (max. {{ $count }})</label>
        <input type="file" class="filepond" id="filepond-input" name="file[]" multiple data-max-files="{{ $count }}" />
    </div>
</div>
