<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController
{
    public function settings()
    {
        $settings = Setting::first();
        return view('admin.settings.manage-settings', compact('settings'));
    }

    public function updateGeneralSettings(Request $request)
    {
        if (csrf_token() !== $request->input('_token')) {
            return back()->with('error', 'Invalid request, please try again.');
        }
        $settings = Setting::first();
        $settings->update([
            'name' => $request->name,
            'title' => $request->title,
            'url' => $request->url,
        ]);
        return back()->with('success', 'Settings updated successfully');
    }

    public function updateBasicSettings(Request $request)
    {
        if (csrf_token() !== $request->input('_token')) {
            return back()->with('error', 'Invalid request, please try again.');
        }
        $settings = Setting::first();
        $settings->update([
            'about' => $request->about,
            'keywords' => $request->keywords,
            'description' => $request->description,
        ]);
        return back()->with('success', 'Settings updated successfully');
    }

    public function updateSocialMediaSettings(Request $request)
    {
        if (csrf_token() !== $request->input('_token')) {
            return back()->with('error', 'Invalid request, please try again.');
        }
        $settings = Setting::first();
        $settings->update([
            'fbPage' => $request->facebook,
            'tgChannel' => $request->telegram,
            'ytChannel' => $request->youtube,
            'wpGroup' => $request->wpGroup,
        ]);
        return back()->with('success', 'Settings updated successfully');
    }

    public function updateImageSettings(Request $request)
    {
        if (csrf_token() !== $request->input('_token')) {
            return back()->with('error', 'Invalid request, please try again.');
        }

        //Image Upload
        $settings = Setting::first();
        if ($request->hasFile('logo')) {
            $file_name = bin2hex(random_bytes(8)) . '.' . $request->file('logo')->getClientOriginalExtension();
            $settings->logo = $request->file('logo')->storeAs('images', $file_name, 'public');
        }
        if ($request->hasFile('favicon')) {
            $file_name = bin2hex(random_bytes(8)) . '.' . $request->file('favicon')->getClientOriginalExtension();
            $settings->favicon = $request->file('favicon')->storeAs('images', $file_name, 'public');
        }
        if ($request->hasFile('main_image')) {
            $file_name = bin2hex(random_bytes(8)) . '.' . $request->file('main_image')->getClientOriginalExtension();
            $settings->image = $request->file('main_image')->storeAs('images', $file_name, 'public');
        }
        $settings->save();
        return back()->with('success', 'Settings updated successfully');
    }
}
