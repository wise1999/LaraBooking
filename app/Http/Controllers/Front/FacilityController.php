<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Category;
use App\Models\Facility;
use Illuminate\Http\Request;
use Money\Parser\IntlMoneyParser;
use Money\Currencies\ISOCurrencies;

class FacilityController extends Controller
{
    public function index() {
        return view('facilities');
    }

    public function show($slug) {

        $facility = Facility::where('slug', $slug)->first();
        $facilities = Facility::whereNotIn('id', [$facility->id])->limit(3)->get();
        $bookings = Booking::where('facility_id', $facility->id)->pluck('date');

        return view('single-facility', compact('facility', 'bookings', 'facilities'));
    }

    public function store(Request $request) {

        $validated = $request->validate([
            'facility_id' => 'required',
            'date' => 'required',
            'price' => 'required',
        ]);

        $currencies = new ISOCurrencies();
        $numberFormatter = new \NumberFormatter('en_US', \NumberFormatter::CURRENCY);
        $moneyParser = new IntlMoneyParser($numberFormatter, $currencies);
        $money = $moneyParser->parse($validated['price']);

        Booking::create([
            'facility_id' => $validated['facility_id'],
            'user_id' => auth()->user()->id,
            'date' => $validated['date'],
            'price' => $money->getAmount(),
        ]);

        return back()->with('message', 'Facility has been booked successfully.');
    }
}
