<?php

namespace App\Http\Controllers;

use App\Models\District;
use Exception;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function addDistrict(Request $request)
    {
        if ($request->isMethod("post")) {
            if ($request->filled(["name","sectorId"])) {
                $district = new District();
                $district->name = $request->name;
                $district->sectorId = $request->sectorId;
                try {
                    $district->save();
                    return $district;
                } catch (Exception $e) {
                    return response()->json(["error" => "An error occurred " . $e->getMessage()], 404);
                }
            } else {
                return response()->json(["error" => "Les champs sont obligatoires"], 400);
            }
        }
    }
    public function getDistricts()
    {
        $districts = District::all();
        return response()->json(['districts', $districts]);
    }
}
