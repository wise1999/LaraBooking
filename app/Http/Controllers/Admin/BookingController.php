<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookingRequest;
use App\Models\Booking;
use App\Models\BookingsStatus;
use App\Models\Facility;
use App\Models\User;
use Money\Parser\IntlMoneyParser;
use Money\Currencies\ISOCurrencies;


class BookingController extends Controller
{
    public function index() {
        $bookings = Booking::with('user', 'facility', 'status')->paginate(10);

        return view('admin.bookings.index', compact('bookings'));
    }

    public function create() {
        $facilities = Facility::get();
        $users = User::whereHas("roles", function($q){ $q->where("name", "user"); })->get();
        $statuses = BookingsStatus::get();
        $bookings = Booking::pluck('date');


        return view('admin.bookings.create', compact('facilities', 'users', 'statuses', 'bookings'));
    }

    public function store(StoreBookingRequest $request) {
        $validated = $request->validated();
        $currencies = new ISOCurrencies();
        $numberFormatter = new \NumberFormatter('en_US', \NumberFormatter::CURRENCY);
        $moneyParser = new IntlMoneyParser($numberFormatter, $currencies);
        $money = $moneyParser->parse($validated['price']);

        Booking::create([
            'facility_id' => $validated['facility_id'],
            'user_id' => $validated['user_id'],
            'status_id' => $validated['status_id'],
            'price' =>  $money->getAmount(),
            'date' => $validated['date'],
        ]);

        return redirect()->route('bookings.index')->with('message', 'Booking added.');
    }

    public function edit(Booking $booking) {
        $users = User::whereHas("roles", function($q){ $q->where("name", "user"); })->get();
        $statuses = BookingsStatus::get();
        $bookings = Booking::pluck('date');
        $selectedFacility = Facility::where('id', $booking->id)->get();

        return view('admin.bookings.edit', compact('booking', 'users', 'statuses', 'bookings', 'selectedFacility'));
    }

    public function update(StoreBookingRequest $request, Booking $booking) {
        $validated = $request->validated();

        $currencies = new ISOCurrencies();
        $numberFormatter = new \NumberFormatter('en_US', \NumberFormatter::CURRENCY);
        $moneyParser = new IntlMoneyParser($numberFormatter, $currencies);
        $money = $moneyParser->parse($validated['price']);

        $booking->update([
            'facility_id' => $validated['facility_id'],
            'user_id' => $validated['user_id'],
            'status_id' => $validated['status_id'],
            'price' =>  $money->getAmount(),
            'date' => $validated['date'],
        ]);

        return redirect()->route('bookings.index')->with('message', 'Booking updated.');
    }

    public function destroy(Booking $booking) {
        $booking->delete();

        return redirect()->back()->with('message', 'Booking Has Been Deleted.');
    }
}
