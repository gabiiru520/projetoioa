<?php

use App\Helpers\MediaHelper;
use App\Models\Setting;

if (!function_exists('asset_media')) {
    function asset_media(?string $path, string $default = ''): string
    {
        return MediaHelper::url($path, $default);
    }
}

if (!function_exists('setting')) {
    function setting(string $key, $default = null)
    {
        return Setting::get($key, $default);
    }
}

if (!function_exists('whatsapp_link')) {
    function whatsapp_link(?string $message = null): string
    {
        $phone = setting('whatsapp_number', '5584998765432');
        $cleanPhone = preg_replace('/[^0-9]/', '', $phone);
        $text = $message ?: setting('whatsapp_default_message', 'Olá! Gostaria de informações sobre os cursos do IOA Natal.');
        return "https://wa.me/{$cleanPhone}?text=" . urlencode($text);
    }
}
