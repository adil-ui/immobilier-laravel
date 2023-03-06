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
        'property_Num',
        'category_id',
        'type',
        'price',
        'bedroom',
        'bathroom',
        'living_room',
        'floor',
        'area',
        'building_date',
        'zip_code',
        'longitude',
        'latitude',
        'city_id',
        'sector_id',
        'district_id',
        'user_id',
        'created_at',
        'updated_at'
    ];
}



