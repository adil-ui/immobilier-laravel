<?php

namespace App\Http\Controllers;

use App\Models\City;
use Exception;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function addCity(Request $request)
    {
        if ($request->isMethod("post")) {
            if ($request->filled("name")) {
                $city = new City();
                $city->name = $request->name;
                try {
                    $city->save();
                    return $city;
                } catch (Exception $e) {
                    return response()->json(["error" => "An error occurred " . $e->getMessage()], 404);
                }
            } else {
                return response()->json(["error" => "Les champs sont obligatoires"], 400);
            }
        }
    }
    public function getCities()
    {
        $cities = City::all();
        return response()->json(['cities', $cities]);

    }
}
