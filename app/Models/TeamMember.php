<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TeamMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'role',
        'cro',
        'bio',
        'photo',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];

    public function getPhotoUrlAttribute(): string
    {
        if ($this->photo) {
            if (Str::startsWith($this->photo, ['http://', 'https://'])) {
                return $this->photo;
            }
            return asset($this->photo);
        }
        return asset('images/team-default.jpg');
    }
}
