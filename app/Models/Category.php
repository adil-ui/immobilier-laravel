<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'picture',
        'created_at',
        'updated_at'
    ];
    public function Property()
    {
        return $this->hasMany(Property::class);
    }
}
