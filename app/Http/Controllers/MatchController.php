<?php

namespace App\Http\Controllers;

use App\Models\MatchModel;
use App\Models\User;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    /**
     * Show all matches for logged-in user
     */
    public function index()
    {
        $userId = auth()->id();

        $matches = MatchModel::where('user1_id', $userId)
                    ->orWhere('user2_id', $userId)
                    ->with(['user1.profile', 'user2.profile'])
                    ->latest()
                    ->get();

        return view('matches.index', compact('matches', 'userId'));
    }

    /**
     * Show match detail page
     */
    public function view($matchId)
    {
        $userId = auth()->id();

        $match = MatchModel::where('id', $matchId)
                ->where(function ($q) use ($userId) {
                    $q->where('user1_id', $userId)
                      ->orWhere('user2_id', $userId);
                })
                ->with(['user1.profile', 'user2.profile'])
                ->firstOrFail();

        // Get other user info
        $partner = $match->otherUser($userId);

        return view('matches.view', compact('partner', 'match'));
    }
}
