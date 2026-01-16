<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Realm extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'ruler', 'alignment', 'region_id'];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function heroes()
    {
        return $this->hasMany(Hero::class);
    }

    // Artefactos cuyo origen es este reino
    public function artifacts()
    {
        return $this->hasMany(Artifact::class, 'origin_realm_id');
    }
}
