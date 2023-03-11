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
        'property_num',
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
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function Propertypicture()
    {
        return $this->hasMany(PropertyPictures::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }
    public function district()
    {
        return $this->belongsTo(District::class);
    }
}



