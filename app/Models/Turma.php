<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Turma extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'start_date',
        'schedule',
        'modality',
        'spots',
        'status',
        'whatsapp_message',
        'is_featured',
    ];

    protected $casts = [
        'start_date' => 'date',
        'is_featured' => 'boolean',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status) {
            'Inscrições abertas' => 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20',
            'Últimas vagas' => 'bg-amber-500/10 text-amber-400 border border-amber-500/20',
            'Em andamento' => 'bg-blue-500/10 text-blue-400 border border-blue-500/20',
            default => 'bg-slate-500/10 text-slate-400 border border-slate-500/20',
        };
    }

    public function getWhatsappUrlAttribute(): string
    {
        $phone = Setting::get('whatsapp_number', '5584999999999');
        $cleanPhone = preg_replace('/[^0-9]/', '', $phone);
        $text = $this->whatsapp_message;
        if (empty($text)) {
            $courseTitle = $this->course ? $this->course->title : 'Cursos';
            $text = "Olá! Gostaria de mais informações sobre a {$this->title} do curso {$courseTitle} no IOA Natal.";
        }
        return "https://wa.me/{$cleanPhone}?text=" . urlencode($text);
    }
}
