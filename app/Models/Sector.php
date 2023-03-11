<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'city_id',
        'created_at',
        'updated_at'
    ];
    public function City()
    {
        return $this->belongsTo(City::class);
    }
    public function District()
    {
        return $this->hasMany(District::class);
    }
}
