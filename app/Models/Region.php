<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Region extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function realms()
    {
        return $this->hasMany(Realm::class);
    }

    public function creatures()
    {
        return $this->hasMany(Creature::class);
    }
}
