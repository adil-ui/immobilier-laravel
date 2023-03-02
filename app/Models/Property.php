<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'picture',
        'description',
        'address',
        'category_id',
        'type',
        'price',
        'bedroom',
        'bathroom',
        'living_room',
        'floor',
        'area',
        'building_date',
        'city_id',
        'sector_id',
        'district_id',
        'zip_code',
        'longitude',
        'latitude',
        'user_id',
        'created_at',
        'updated_at'
    ];
}



