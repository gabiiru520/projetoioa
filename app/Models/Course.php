<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'modality',
        'summary',
        'description',
        'duration_workload',
        'schedule_info',
        'target_audience',
        'syllabus',
        'investment',
        'coordinator',
        'image',
        'is_featured',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    protected static function booted()
    {
        static::creating(function ($course) {
            if (empty($course->slug)) {
                $course->slug = Str::slug($course->title);
            }
        });
    }

    public function turmas(): HasMany
    {
        return $this->hasMany(Turma::class);
    }

    public function activeTurmas(): HasMany
    {
        return $this->hasMany(Turma::class)->where('status', '!=', 'Encerrada');
    }

    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            if (Str::startsWith($this->image, ['http://', 'https://'])) {
                return $this->image;
            }
            return asset($this->image);
        }
        return asset('images/course-default.jpg');
    }
}
