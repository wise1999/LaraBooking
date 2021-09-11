<?php

namespace App\Http\Livewire;

use App\Models\Booking;
use App\Models\BookingsStatus;
use App\Models\Facility;
use App\Models\User;
use Livewire\Component;

class BookingCreate extends Component
{
    public $selectedFacility = null;
    public $bookings = null;
    public $facilityPrice = null;

    public function render()
    {
        return view('livewire.booking-create', [
            'facilities' => Facility::all(),
            'users' => User::whereHas("roles", function($q){ $q->where("name", "user"); })->get(),
            'statuses' => BookingsStatus::get(),
        ]);
    }

    public function updatedSelectedFacility($id) {
        $this->facilityPrice = Facility::findOrFail($id);
        $this->bookings = Booking::where('facility_id', $id)->pluck('date');
    }
}
