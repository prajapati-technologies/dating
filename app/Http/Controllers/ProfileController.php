<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;

class ProfileController extends Controller
{
    /**
     * Show the dating profile form
     */
    public function edit()
{
    $profile = auth()->user()->profile;

    if (!$profile) {
        $profile = \App\Models\Profile::create([
            'user_id' => auth()->id()
        ]);
    }

    return view('profile.edit', compact('profile'));
}

public function update(Request $request)
{
    $profile = auth()->user()->profile;

    $data = $request->all();

    if ($request->hasFile('profile_photo')) {
        $path = $request->file('profile_photo')->store('profile_photos', 'public');
        $data['profile_photo'] = $path;
    }

    $profile->update($data);

    return back()->with('success', 'Profile updated successfully!');
}


}
