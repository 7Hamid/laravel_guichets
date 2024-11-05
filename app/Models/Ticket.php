<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'adresse', 'localisation', 'categorie', 'prix', 'prix_vip','phone', 'devise', 'image', 'event_date', 'event_time'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'categorie'); // Specify the foreign key if it's not 'category_id'
    }
}
