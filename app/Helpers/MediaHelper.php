<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaHelper
{
    /**
     * Return the accessible URL for a media file, handling both direct public paths,
     * external URLs, storage paths, and the Locaweb symlink fallback streaming route.
     */
    public static function url(?string $path, string $default = ''): string
    {
        if (empty($path)) {
            return $default ? asset($default) : '';
        }

        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        // If file is directly in public/ (e.g. images/logo.svg)
        if (file_exists(public_path($path))) {
            return asset($path);
        }

        // If storage symlink works and file exists in public/storage
        if (file_exists(public_path('storage/' . ltrim($path, '/')))) {
            return asset('storage/' . ltrim($path, '/'));
        }

        // Locaweb fallback: check if file exists in storage/app/public/ and serve through /media route
        $cleanPath = str_replace(['storage/', 'public/'], '', ltrim($path, '/'));
        if (Storage::disk('public')->exists($cleanPath)) {
            return route('media.serve', ['path' => $cleanPath]);
        }

        return asset($path);
    }
}
