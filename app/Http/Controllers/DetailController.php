<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Property;
use App\Models\PropertyPictures;
use Illuminate\Http\Request;

class DetailController extends Controller
{

    public function getProperty($id)
    {
        $categories = Category::all();
        $property = Property::where('id', $id)->with(['category', 'city','sector','district','user'])->get();
        $PropertyPictures = PropertyPictures::where('property_id', $id)->get();
        return response()->json(['property' => $property, "categories" => $categories, 'PropertyPictures'=> $PropertyPictures]);
    }
}
