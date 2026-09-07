<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class MediaController extends Controller
{
    /**
     * Fallback file server for Locaweb Hospedagem I environments
     * where symlink() might be disabled.
     */
    public function serve(string $path)
    {
        $cleanPath = ltrim($path, '/');
        
        if (Storage::disk('public')->exists($cleanPath)) {
            $fullPath = Storage::disk('public')->path($cleanPath);
            $mimeType = Storage::disk('public')->mimeType($cleanPath) ?: 'application/octet-stream';

            return response()->file($fullPath, [
                'Content-Type' => $mimeType,
                'Cache-Control' => 'public, max-age=86400',
            ]);
        }

        abort(404, 'Arquivo não encontrado.');
    }
}
