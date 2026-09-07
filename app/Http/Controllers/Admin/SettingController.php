<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $keys = [
            'site_name' => 'general',
            'site_tagline' => 'general',
            'whatsapp_number' => 'contact',
            'whatsapp_default_message' => 'contact',
            'phone' => 'contact',
            'email' => 'contact',
            'address' => 'contact',
            'business_hours' => 'contact',
            'google_maps_embed' => 'contact',
            'instagram' => 'social',
            'facebook' => 'social',
            'youtube' => 'social',
            'linkedin' => 'social',
            'seo_meta_title' => 'seo',
            'seo_meta_description' => 'seo',
        ];

        foreach ($keys as $key => $group) {
            if ($request->has($key)) {
                Setting::set($key, $request->input($key), $group);
            }
        }

        return back()->with('success', 'Configurações atualizadas com sucesso!');
    }
}
