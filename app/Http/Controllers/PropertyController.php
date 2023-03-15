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
            if ($request->filled(["title", "description", "propertyNum", "categoryId", "type", "price", "bedroom", "bathroom", "floor", "area", "zipCode", "longitude", "latitude"])) {
                if ($request->hasFile('picture') && $request->file('picture')->isValid()) {
                    try {
                        $propertyPicture = 'storage/' . $request->picture->store('property/images');

                        $myCity = City::find($request->cityName);
                        if ($myCity && $myCity->name === $request->cityName) {
                            $city = City::find($request->cityName);
                        } else {
                            $city = City::create([
                                "name" => $request->cityName
                            ]);
                        }
                        $mySector = Sector::find($request->sectorName);
                        if ($mySector && $mySector->name === $request->sectorName) {
                            $sector = Sector::find($request->sectorName);
                        } else {
                            $sector = Sector::create([
                                "name" => $request->sectorName,
                                "city_id" => $city->id,
                            ]);
                        }
                        $myDistrict = District::find($request->districtName);
                        if ($myDistrict && $myDistrict->name === $request->districtName) {
                            $district = District::find($request->districtName);
                        } else {
                            $district = District::create([
                                "name" => $request->districtName,
                                "sector_id" => $sector->id,
                            ]);
                        }


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
        $properties = Property::orderBy("created_at", "desc")->with(['category', 'city', 'sector', 'district', 'user'])->get();
        return response()->json(['properties' => $properties]);
    }
    public function getAllPropertyPerPage($page)
    {
        $properties = Property::orderBy("created_at", "desc")->with(['category', 'city', 'sector', 'district', 'user'])->offset(5 * ($page - 1))->limit(5)->get();
        return response()->json(['properties' => $properties]);
    }
    public function getHomeProperties()
    {
        $properties = Property::orderBy("created_at", "desc")->with(['category', 'city', 'sector', 'district', 'user'])->limit(6)->get();
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

    public function filter(Request $request)
    {
        $query = Property::query();
        if ($request->filled('city')) {
            $query->where("city_id", $request->city);
        }

        if ($request->filled('category')) {
            $query->where("category_id", $request->category);
        }

        if ($request->filled('type')) {
            $query->where("type", $request->type);
        }

        if ($request->filled('living_room')) {
            $query->where("living_room", $request->livingRoom);
        }

        if ($request->filled('bedroom')) {
            $query->where("bedroom", $request->bedroom);
        }

        if ($request->filled('bathroom')) {
            $query->where("bathroom", $request->bathroom);
        }

        if ($request->filled('floor')) {
            $query->where("floor", $request->floor);
        }

        if ($request->filled(['areaMin', 'areaMax'])) {
            $query->where([["area", '>=', $request->areaMin], ["area", '<=', $request->areaMax]]);
        }

        if ($request->filled(['priceMin', 'priceMax'])) {
            $query->where(["price", '>=', $request->priceMin], ["price", '<=', $request->priceMax]);
        }
        $properties = $query->orderBy('created_at', 'desc')->with('category')->get();

        return response()->json(['properties' => $properties]);
    }
}
