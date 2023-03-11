<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyPictures extends Model
{
    use HasFactory;
    protected $fillable = [
        'picture',
        'property_id',
        'created_at',
        'updated_at'
    ];
    public function Property()
    {
        return $this->belongsTo(Property::class);
    }
}
