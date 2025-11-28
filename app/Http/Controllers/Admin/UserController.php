<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Show all users
     */
    public function index()
    {
        $users = User::with('profile')->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show only blocked users
     */
    public function blocked()
    {
        $users = User::where('is_blocked', 1)->with('profile')->get();
        return view('admin.users.blocked', compact('users'));
    }

    /**
     * Block a user
     */
    public function block($id)
    {
        $user = User::findOrFail($id);
        $user->is_blocked = 1;
        $user->save();

        return back()->with('success', 'User blocked successfully.');
    }

    /**
     * Unblock a user
     */
    public function unblock($id)
    {
        $user = User::findOrFail($id);
        $user->is_blocked = 0;
        $user->save();

        return back()->with('success', 'User unblocked successfully.');
    }

    /**
     * Delete user
     */
    public function delete($id)
    {
        User::findOrFail($id)->delete();
        return back()->with('success', 'User deleted successfully.');
    }

    /**
     * View user full profile
     */
    public function view($id)
    {
        $user = User::with('profile')->findOrFail($id);
        return view('admin.users.view', compact('user'));
    }

    /**
     * Edit user profile
     */
    public function edit($id)
    {
        $user = User::with('profile')->findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }
    /**
     * Update user profile
     */
    public function update(Request $request, $id)
    {
        $user = User::with('profile')->findOrFail($id);
        $data = $request->all();
        $user->update($data);
        if ($user->profile) {
            $user->profile->update($data);
        }
        return back()->with('success', 'User updated successfully.');
    }
}
