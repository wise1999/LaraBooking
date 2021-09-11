<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;

class UserController extends Controller
{
    public function index() {
        $users = User::whereHas("roles", function($q){ $q->where("name", "user"); })->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    public function create() {
        return view('admin.users.create');
    }

    public function store(StoreUserRequest $request) {

        $validated = $request->validated();

        User::create([
            'name' => $validated['name']
        ]);

        return redirect()->route('users.index')->with('message', 'User added.');
    }

    public function edit(User $user) {
        return view('admin.users.edit', compact('user'));
    }

    public function update(StoreUserRequest $request, User $user) {
        $validated = $request->validated();

        $user->update([
            'name' => $validated['name']
        ]);

        return redirect()->route('users.index')->with('message', 'User updated.');
    }

    public function destroy(User $user) {
        $user->delete();

        return redirect()->back()->with('message', 'User Has Been Deleted.');
    }
}
