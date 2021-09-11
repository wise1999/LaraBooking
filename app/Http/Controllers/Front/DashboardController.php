<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $user = auth()->user()->id;
        $bookings = Booking::where('user_id', $user)->get();

        return view('dashboard', compact('bookings'));
    }
}
