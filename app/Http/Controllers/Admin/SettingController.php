<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::first();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = Setting::first();

        if (!$settings) {
            $settings = new Setting();
        }

        $settings->fill($request->except(['logo', 'favicon']));

        if ($request->hasFile('logo')) {
            $settings->logo = $request->file('logo')->store('settings', 'public');
        }

        if ($request->hasFile('favicon')) {
            $settings->favicon = $request->file('favicon')->store('settings', 'public');
        }

        $settings->save();

        return back()->with('success', 'Settings updated successfully.');
    }
}
