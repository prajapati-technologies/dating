<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Setting; // if you have a Setting model

class PageController extends Controller
{
    public function home()
    {
        $featured = Profile::with('user')->latest()->take(6)->get();
        $settings = Setting::first(); // can be null
        return view('pages.home', compact('featured','settings'));
    }

    public function about(){ return view('pages.about'); }
    public function features(){ return view('pages.features'); }
    public function pricing(){ return view('pages.pricing'); }
    public function faq(){ return view('pages.faq'); }
    public function terms(){ return view('pages.terms'); }
    public function privacy(){ return view('pages.privacy'); }

    public function browse(Request $request)
    {
        $q = Profile::with('user');

        if ($request->city) $q->where('city', $request->city);
        if ($request->gender) $q->where('gender', $request->gender);
        if ($request->min_age) $q->where('age', '>=', $request->min_age);
        if ($request->max_age) $q->where('age', '<=', $request->max_age);

        $profiles = $q->paginate(12);
        return view('pages.browse', compact('profiles'));
    }
}
