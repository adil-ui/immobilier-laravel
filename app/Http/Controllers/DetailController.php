<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Property;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function getPropert($id)
    {
        $property = Property::find($id);
        $categories = Category::all();
        return response()->json(['property' => $property, "categories" => $categories]);
    }
}
