<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'sector_id',
        'created_at',
        'updated_at'
    ];
    public function Property()
    {
        return $this->belongsTo(Sector::class);
    }
    
}
