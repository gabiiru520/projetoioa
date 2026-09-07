<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'page',
        'section',
        'title',
        'subtitle',
        'content',
        'extra_data',
    ];

    protected $casts = [
        'extra_data' => 'array',
    ];

    public static function getSection(string $page, string $section): ?self
    {
        return static::where('page', $page)->where('section', $section)->first();
    }
}
