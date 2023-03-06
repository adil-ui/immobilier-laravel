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

class PropertyController extends Controller
{
    public function addProperty(Request $request)
    {
        if ($request->isMethod("post")) {
            if ($request->filled(["title", "description", "propertyNum","categoryId", "type", "price", "bedroom", "bathroom", "floor", "area", "zipCode", "longitude", "latitude", "longitude", "longitude", "longitude"])) {
                $property = new Property;
                $property->title = $request->title;
                $property->description = $request->description;
                $property->property_Num = $request->propertyNum;
                $property->type = $request->type;
                $property->price = $request->price;
                $property->bedroom = $request->bedroom;
                $property->bathroom = $request->bathroom;
                $property->living_room = $request->livingRoom;
                $property->floor = $request->floor;
                $property->area = $request->area;
                $property->building_date = $request->buildingDate;
                $property->zip_code = $request->zipCode;
                $property->longitude = $request->longitude;
                $property->latitude = $request->latitude;
                $property->category_id = $request->categoryId;
                $property->city_id = $request->cityId;
                $property->sector_id = $request->sectorId;
                $property->district_id = $request->districtId;
                $property->user_id = $request->userId;
                $property->created_at = Carbon::now();
                $property->updated_at = Carbon::now();
                $city = new City;
                $city->name = $request->cityName;

                $sector = new  Sector;
                $sector->name = $request->SectorName;
                $sector->city_id = $request->cityId;

                $district = new  District;
                $district->name = $request->districtName;
                $district->sector_id = $request->sectorId;

                if ($request->hasFile('picture') && $request->file('picture')->isValid()) {
                    $property->picture = 'storage/' . $request->picture->store('property/images');
                }
                try {
                    $property->save();
                    $sector->save();
                    $district->save();
                    return response()->json(["success" => "Logement ajouter avec succès" ]);
                } catch (Exception $e) {
                    return response()->json(["error" => "An error occurred" . $e->getMessage()], 404);
                }


            } else {
                return response()->json(["error" => "Les champs sont obligatoires"], 400);
            }

        }
    }
    public function getPropertyPerPage($page)
    {
        $property = Property::orderBy("created_at", "desc")->offset(5 * ($page - 1))->limit(5)->get();
        return response()->json(['property' => $property]);
    }
}
