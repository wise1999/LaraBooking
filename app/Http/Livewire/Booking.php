<?php

namespace App\Http\Livewire;

use App\Models\Booking as ModelBooking;
use App\Models\BookingsStatus;
use App\Models\Facility;
use App\Models\User;
use Livewire\Component;

class Booking extends Component
{

    public $selectedFacility = null;
    public $bookings = null;
    public $facilityPrice = null;
    public $booking;
    public $dates = null;

    public function mount() {
        $this->facilityPrice = Facility::where('id', $this->selectedFacility)->first();
        $this->bookings = ModelBooking::where('facility_id', $this->selectedFacility)
                                        ->where('date', '<>', $this->booking['date'])
                                        ->pluck('date');

        $this->dates = json_encode(array(
            'selected' => $this->booking['date'],
            'disable' => $this->bookings,
        ));
    }

    public function render()
    {
        return view('livewire.booking-edit', [
            'facilities' => Facility::all(),
            'users' => User::whereHas("roles", function($q){ $q->where("name", "user"); })->get(),
            'statuses' => BookingsStatus::get(),
        ]);
    }

    public function updatedSelectedFacility($id) {
        $this->facilityPrice = Facility::findOrFail($id);
        $this->bookings = ModelBooking::where('facility_id',  $id)
                                        ->where('date', '<>', $this->booking['date'])
                                        ->pluck('date');

        $this->dates = json_encode(array(
            'selected' =>  $this->booking['facility_id'] == $this->selectedFacility ? $this->booking['date'] : '',
            'disable' => $this->bookings,
        ));
    }

}
