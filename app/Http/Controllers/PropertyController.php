<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function addProperty(Request $request)
    {
        if ($request->isMethod("post")) {
            if ($request->filled(["title", "description", "address", "phone", "dahsb", "dahsb", "dahsb", "dahsb", "dahsb", "dahsb", "dahsb", "dahsb", "dahsb"])) {
                $property = new Property;
                $property->title = $request->title;
                $property->description = $request->description;
                $property->address = $request->address;
                $property->type = $request->type;
                $property->price = $request->price;
                $property->bedroom = $request->bedroom;
                $property->bathroom = $request->bathroom;
                $property->living_room = $request->living_room;
                $property->floor = $request->floor;
                $property->area = $request->area;
                $property->building_date = $request->building_date;
                $property->dahsb = $request->dahsb;
                $property->dahsb = $request->dahsb;
                $property->dahsb = $request->dahsb;
                $property->dahsb = $request->dahsb;
                $property->dahsb = $request->dahsb;
                $property->dahsb = $request->dahsb;
                $property->dahsb = $request->dahsb;
                $property->dahsb = $request->dahsb;
                $property->created_at = Carbon::now();
                $property->updated_at = Carbon::now();
                $property->role = 'customer';
                if ($request->hasFile('picture') && $request->file('picture')->isValid()) {
                    $property->picture = 'storage/' . $request->picture->store('property/images');
                }
                try {
                    $property->save();

                    return $property;
                } catch (Exception $e) {
                    return response()->json(["error" => "An error occurred " . $e->getMessage()], 404);
                }
            } else {
                return response()->json(["error" => "Les champs sont obligatoires"], 400);
            }
        }
    }
    public function getProductsPerPage($page)
    {
        $property = Property::orderBy("created_at", "desc")->offset(5 * ($page - 1))->limit(5)->get();
        return response()->json(['property' => $property]);
    }
}
