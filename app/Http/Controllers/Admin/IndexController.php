<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index(User $user) {
        $users = User::whereHas("roles", function($q){ $q->where("name", "user"); })->get();
        $bookings = Booking::all();

        return view('admin.index', compact('users', 'bookings'));
    }
}
