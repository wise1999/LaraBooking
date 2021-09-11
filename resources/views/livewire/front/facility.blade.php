<div class="py-12">
    <div class="container mx-auto sm:px-6 lg:px-8 flex">
        <div class="w-2/12 bg-white overflow-hidden shadow-sm sm:rounded-lg ">
            <div class="p-6 bg-white border-b border-gray-200">
                <h3 class="font-semibold text-lg text-gray-800 leading-tight">
                    Categories
                </h3>
            </div>
            <div class="mt-2 p-6 pt-4">
                @if(count($categories) > 0 && $filterCategory)
                    <button wire:click="clearFilter()"
                        class="text-decoration-none block ml-auto mb-3"><span>Clear</span></button>
                @endif

                @foreach($categories as $category)
                    <div>
                        <label class="inline-flex items-center">
                            <input type="radio" class="form-radio" name="category" id="category-{{ $category->id }}"
                                wire:model="filterCategory" value="{{ $category->id }}">
                            <span class="ml-2">{{ $category->name }}
                                ({{ $category->facilities()->count() }})</span>
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="w-9/12 bg-white overflow-hidden shadow-sm sm:rounded-lg ml-auto">
            <div class="p-6 bg-white border-b border-gray-200">
                <h3 class="font-semibold text-lg text-gray-800 leading-tight">
                    Facilities
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
                                        class="inline-block px-2 py-1 leading-none bg-orange-200 text-orange-800 rounded-full font-semibold uppercase tracking-wide text-xs">{{ $facility->category ? $facility->category->name : '' }}</span>
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
                                        <span class="font-bold text-xl">{{ $facility->formattedPrice }}</span>&nbsp;
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
                    <div class="w-full px-4 mt-3">
                        {{ $facilities->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
