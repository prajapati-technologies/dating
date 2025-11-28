<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Swipe;
use Illuminate\Http\Request;

class SwipeController extends Controller
{
    public function index()
    {
        $profile = auth()->user()->profile;

        if (!$profile || !$profile->profile_photo) {
            return redirect()->route('profile.edit')
                ->with('error', 'Please complete your profile with a photo to start swiping.');
        }

        return view('swipe.index');
    }


    public function next()
{
    $authId = auth()->id();

    $user = User::with('profile')
        ->where('id', '!=', $authId)
        ->whereHas('profile')
        ->whereDoesntHave('swipesFrom', function ($q) use ($authId) {
            $q->where('user_id', $authId); // only correct column
        })
        ->inRandomOrder()
        ->first();

    return response()->json(['user' => $user]);
}




    public function swipe(Request $request)
{
    $request->validate([
        'target_id' => 'required|exists:users,id',
        'type' => 'required|in:like,dislike'
    ]);

    $swiper = auth()->id();
    $target = $request->target_id;

    // Save swipe (YOUR TABLE USES user_id)
    Swipe::updateOrCreate(
        ['user_id' => $swiper, 'target_id' => $target], 
        ['type' => $request->type]
    );

    // Check match
    $match = Swipe::where('user_id', $target)
                  ->where('target_id', $swiper)
                  ->where('type', 'like')
                  ->exists();

    return response()->json([
        'success' => true,
        'match' => $match
    ]);
}



}
