<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgrammableTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'adresse', 'localisation', 'categorie', 'phone',
        'prix', 'prix_vip', 'devise', 'event_date', 'event_time',
        'scheduled_date', 'scheduled_time', 'image'
    ];

    public function isPublished()
    {
        $scheduledDateTime = $this->scheduled_date . ' ' . $this->scheduled_time;
        return now()->gte($scheduledDateTime);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'categorie');
    }
}
