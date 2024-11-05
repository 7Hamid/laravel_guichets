<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'categorie'); // Specify the foreign key if it's not 'category_id'
    }
}
