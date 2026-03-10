<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);

        return view('admin.user.index', compact('users'));
    }

    public function edit(Request $request, User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->validate([
            'status' => ['required'], ['in:admin,user'],
            'is_active' => ['required'], ['boolean'],
        ]));

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
    }
}
