<div>
    <form method="POST" class="p-10 bg-white rounded shadow-xl"
        action="{{ route('bookings.update', [$booking->id]) }}">
        @csrf
        @method('PUT')

        <p class="text-lg text-gray-800 font-medium pb-4">Edit Booking</p>
        <div class="mb-4">
            <label class="block text-sm text-gray-600 mb-2" for="name">Facility</label>
            <select class="w-full px-2 py-1 text-gray-700 bg-gray-200 rounded" wire:model="selectedFacility"
                id="selectedFacility" name="facility_id" type="text" aria-label="name">
                <option disabled selected>Select Facility</option>
                @foreach($facilities as $facility)
                    <option value="{{ $facility->id }}">
                        {{ $facility->name }} </option>
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
                    <option value="{{ $user->id }}"
                        {{ $booking->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-sm text-gray-600 mb-2" for="name">Status</label>
            <select class="w-full px-2 py-1 text-gray-700 bg-gray-200 rounded" id="status_id" name="status_id"
                type="text" aria-label="name">
                <option disabled selected>Select Status</option>
                @foreach($statuses as $status)
                    <option value="{{ $status->id }}"
                        {{ $booking->status_id == $status->id ? 'selected' : '' }}>
                        {{ $status->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-sm text-gray-600 mb-2" for="date">Booking Arrival / Departure</label>
            <x-inputs.edit-booking-date id="date" wire:model="dates" />
        </div>

        <div class="mb-4">
            <label class="block text-sm text-gray-600 mb-2" for="price">Total Cost</label>
            <input type="text" name="price" class="w-full px-2 py-1 text-gray-700 bg-gray-200 rounded" id="price"
                readonly value="{{ $booking->formattedPrice }}" />
        </div>

        <div class="mt-6">
            <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded"
                type="submit">Update</button>
        </div>
    </form>


</div>
