<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use Exception;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    public function addSector(Request $request)
    {
        if ($request->isMethod("post")) {
            if ($request->filled(["name",["cityId"]])) {
                $sector = new Sector();
                $sector->name = $request->name;
                $sector->cityId = $request->cityId;
                try {
                    $sector->save();
                    return $sector;
                } catch (Exception $e) {
                    return response()->json(["error" => "An error occurred " . $e->getMessage()], 404);
                }
            } else {
                return response()->json(["error" => "Les champs sont obligatoires"], 400);
            }
        }
    }
    public function getsectors()
    {
        $sectors = Sector::all();
        return response()->json(['sectors', $sectors]);
    }
}
