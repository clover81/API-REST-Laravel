<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hero extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'race', 'rank', 'realm_id', 'alive'];

    protected $casts = [
        'alive' => 'boolean',
    ];

    public function realm()
    {
        return $this->belongsTo(Realm::class);
    }

    public function artifacts()
    {
        return $this->belongsToMany(Artifact::class, 'artifact_hero')
            ->withTimestamps();
    }
}
