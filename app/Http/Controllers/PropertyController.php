<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\District;
use App\Models\Property;
use App\Models\PropertyPictures;
use App\Models\Sector;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PropertyController extends Controller
{
    public function addProperty(Request $request)
    {
        if ($request->isMethod("post")) {
            if ($request->filled(["title", "description", "propertyNum", "categoryId", "type", "price", "bedroom", "bathroom", "floor", "area", "zipCode", "longitude", "latitude", "longitude", "longitude", "longitude"])) {
                if ($request->hasFile('picture') && $request->file('picture')->isValid()) {
                    try {
                        $propertyPicture = 'storage/' . $request->picture->store('property/images');
                        $city = City::create([
                            "name" => $request->cityName
                        ]);

                        $sector = Sector::create([
                            "name" => $request->sectorName,
                            "city_id" => $city->id,
                        ]);

                        $district = District::create([
                            "name" => $request->districtName,
                            "sector_id" => $sector->id,
                        ]);

                        $property = Property::create([
                            "title" => $request->title,
                            "description" => $request->description,
                            "picture" => $propertyPicture,
                            "property_num" => $request->propertyNum,
                            "type" => $request->type,
                            "price" => $request->price,
                            "bedroom" => $request->bedroom,
                            "bathroom" => $request->bathroom,
                            "living_room" => $request->livingRoom,
                            "floor" => $request->floor,
                            "area" => $request->area,
                            "building_date" => $request->buildingDate,
                            "zip_code" => $request->zipCode,
                            "longitude" => $request->longitude,
                            "latitude" => $request->latitude,
                            "category_id" => $request->categoryId,
                            "city_id" => $city->id,
                            "sector_id" => $sector->id,
                            "district_id" => $district->id,
                            "user_id" => $request->userId,
                            "created_at" => Carbon::now(),
                            "updated_at" => Carbon::now(),
                        ]);

                        if ($request->has("number_pictures")) {
                            for ($number = 1; $number <= $request->number_pictures; $number++) {
                                if ($request->hasFile("picture_$number") && $request->file("picture_$number")->isValid()) {
                                    $picture = 'storage/' . $request->file("picture_$number")->store('property/images');
                                    PropertyPictures::create([
                                        'picture' => $picture,
                                        'property_id' => $property->id,
                                        "created_at" => Carbon::now(),
                                        "updated_at" => Carbon::now()
                                    ]);
                                }
                            }
                            return response()->json(["success" => "Propriété ajouter avec succès"]);
                        } else {
                            return response()->json(["error" => "Les champs sont obligatoires"], 400);
                        }
                    } catch (Exception $e) {
                        return response()->json(["error" => "An error occurred" . $e->getMessage()], 500);
                    }

                } else {
                    return response()->json(["error" => "Les champs sont obligatoires"], 400);
                }

            } else {
                return response()->json(["error" => "Les champs sont obligatoires"], 400);
            }

        }
    }
    public function getProperties()
    {
        $properties = Property::orderBy("created_at", "desc")->with(['category', 'city','sector','district','user'])->get();
        return response()->json(['properties' => $properties]);
    }
    public function getAllPropertyPerPage($page)
    {
        $properties = Property::orderBy("created_at", "desc")->with(['category', 'city','sector','district','user'])->offset(5 * ($page - 1))->limit(5)->get();
        return response()->json(['properties' => $properties]);
    }
    public function getHomeProperties()
    {
        $properties = Property::orderBy("created_at", "desc")->with(['category', 'city','sector','district','user'])->limit(6)->get();
        return response()->json(['properties' => $properties]);
    }

    public function getAllProperties()
    {
        $properties = Property::orderBy("created_at", "desc")->with(['category', 'user'])->get();
        return response()->json(['properties' => $properties]);
    }
    public function getPropertyPerPage($page)
    {
        $properties = Property::orderBy("created_at", "desc")->with(['category', 'user'])->offset(5 * ($page - 1))->limit(5)->get();
        return response()->json(['properties' => $properties]);
    }


    public function getMyProperties($id)
    {
        $properties = Property::where('user_id', $id)->orderBy('created_at', 'desc')->with('category')->get();
        return response()->json(['properties' => $properties]);
    }
    public function getMyPropertyPerPage($id, $page)
    {
        $properties = Property::where('user_id', $id)->orderBy('created_at', 'desc')->with('category')->offset(5 * ($page - 1))->limit(5)->get();
        return response()->json(['properties' => $properties]);
    }
}
