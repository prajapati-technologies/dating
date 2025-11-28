<?php

namespace App\Http\Controllers;

use App\Models\Swipe;
use App\Models\User;
use Illuminate\Http\Request;

class SwipeController extends Controller
{
    /**
     * Fetch Next User Card With Filters
     */
    public function next(Request $request)
    {
        $currentUser = auth()->id();

        // Get filters
        $gender = $request->gender ?? null;
        $minAge = $request->min_age ?? null;
        $maxAge = $request->max_age ?? null;
        $city   = $request->city ?? null;

        // Get already swiped users
        $swiped = Swipe::where('user_id', $currentUser)->pluck('target_id')->toArray();

        // Start query
        $query = User::whereNotIn('id', array_merge($swiped, [$currentUser]))
                     ->with('profile');

        // Gender filter
        if ($gender) {
            $query->whereHas('profile', function ($q) use ($gender) {
                $q->where('gender', $gender);
            });
        }

        // Age filter
        if ($minAge) {
            $query->whereHas('profile', function ($q) use ($minAge) {
                $q->where('age', '>=', $minAge);
            });
        }
        if ($maxAge) {
            $query->whereHas('profile', function ($q) use ($maxAge) {
                $q->where('age', '<=', $maxAge);
            });
        }

        // City filter
        if ($city) {
            $query->whereHas('profile', function ($q) use ($city) {
                $q->where('city', 'LIKE', "%$city%");
            });
        }

        // Fetch one user
        $user = $query->first();

        return response()->json([
            'user' => $user
        ]);
    }

    /**
     * Handle Like/Dislike Swipe Action
     */
    public function swipe(Request $request)
    {
        $request->validate([
            'target_id' => 'required|integer',
            'type'      => 'required|in:like,dislike'
        ]);

        $user_id   = auth()->id();
        $target_id = $request->target_id;
        $type      = $request->type;

        // Save or update swipe
        Swipe::updateOrCreate(
            ['user_id' => $user_id, 'target_id' => $target_id],
            ['type' => $type]
        );

        // Check match
        $matched = false;

        if ($type === 'like') {
            $matchBack = Swipe::where('user_id', $target_id)
                              ->where('target_id', $user_id)
                              ->where('type', 'like')
                              ->exists();

            if ($matchBack) {
                $matched = true;
                \DB::table('matches')->insertOrIgnore([
                    'user1_id' => min($user_id, $target_id),
                    'user2_id' => max($user_id, $target_id),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        return response()->json([
            'status' => 'success',
            'match'  => $matched
        ]);
    }
}
