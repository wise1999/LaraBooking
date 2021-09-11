<div>
    <form action="{{ route('bookings.store') }}" method="POST"
        class="p-10 bg-white rounded shadow-xl">
        @csrf
        <p class="text-lg text-gray-800 font-medium pb-4">New Booking</p>

        <div class="mb-4">
            <label class="block text-sm text-gray-600 mb-2" for="name">Facility</label>
            <select x-data="{ placeholderDisabled: true }" class="w-full px-2 py-1 text-gray-700 bg-gray-200 rounded"
                id="facility_id" name="facility_id" type="text" aria-label="name" wire:model="selectedFacility">
                <option x-bind:disabled="placeholderDisabled">
                    Select Facility</option>
                @foreach($facilities as $facility)
                    <option value="{{ $facility->id }}">
                        {{ $facility->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-sm text-gray-600 mb-2">Facility Cost Per Day</label>
            <span class="w-full px-2 py-1 text-gray-700 bg-gray-200 rounded block h-8">
                {{ $facilityPrice ? $facilityPrice->formattedPrice : null }}
            </span>
            <input type="hidden" name="facility_price" id="facility_price"
                value="{{ $facilityPrice ? $facilityPrice->price->amount() : null }}" readonly />
        </div>
        <div class="mb-4">
            <label class="block text-sm text-gray-600 mb-2" for="name">User</label>
            <select class="w-full px-2 py-1 text-gray-700 bg-gray-200 rounded" id="user_id" name="user_id" type="text"
                aria-label="name">
                <option disabled selected>Select User</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-sm text-gray-600 mb-2" for="name">Status</label>
            <select class="w-full px-2 py-1 text-gray-700 bg-gray-200 rounded" id="status_id" name="status_id"
                type="text" aria-label="name">
                <option disabled selected>Select Status</option>
                @foreach($statuses as $status)
                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-sm text-gray-600 mb-2" for="date">Booking Arrival / Departure</label>
            <x-inputs.date id="date" wire:model="bookings" />
        </div>

        <div class="mb-4">
            <label class="block text-sm text-gray-600 mb-2" for="price">Total Cost</label>
            <input type="text" name="price" class="w-full px-2 py-1 text-gray-700 bg-gray-200 rounded" id="price"
                readonly />
        </div>

        <div class="mt-6">
            <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded"
                type="submit">Add</button>
        </div>
    </form>
</div>
