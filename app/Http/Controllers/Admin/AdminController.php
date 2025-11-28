<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Profile;
use Carbon\Carbon;
use DB;

class AdminController extends Controller
{
    public function index()
    {
        // -------- BASIC COUNTS --------
        $totalUsers     = User::count();
        $blockedUsers   = User::where('is_blocked', 1)->count();
        $profiles       = Profile::count();
        $male           = Profile::where('gender', 'Male')->count();
        $female         = Profile::where('gender', 'Female')->count();
        $other          = Profile::where('gender', 'Other')->count();

        // -------- MONTHLY USER REGISTRATIONS --------
        $monthlyUsers = User::select(
            DB::raw('COUNT(*) as count'),
            DB::raw('MONTH(created_at) as month')
        )
        ->groupBy('month')
        ->pluck('count', 'month');

        // -------- MONTHLY PROFILE CREATION --------
        $monthlyProfiles = Profile::select(
            DB::raw('COUNT(*) as count'),
            DB::raw('MONTH(created_at) as month')
        )
        ->groupBy('month')
        ->pluck('count', 'month');

        // -------- TOP CITIES COUNT --------
        $topCities = Profile::select('city', DB::raw('COUNT(*) as count'))
            ->groupBy('city')
            ->orderBy('count', 'DESC')
            ->limit(5)
            ->get();

        // -------- RECENT USERS WIDGET --------
        $recentUsers = User::latest()->take(10)->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'blockedUsers',
            'profiles',
            'male',
            'female',
            'other',
            'monthlyUsers',
            'monthlyProfiles',
            'topCities',
            'recentUsers'
        ));
    }
}
