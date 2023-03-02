<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function addCategorie(Request $request)
    {
        if ($request->isMethod("post")) {
            if ($request->filled("name")) {
                $category = new Category();
                $category->name = $request->name;
                $category->picture = $request->picture;
                try {
                    $category->save();
                    return $category;
                } catch (Exception $e) {
                    return response()->json(["error" => "An error occurred " . $e->getMessage()], 404);
                }
            } else {
                return response()->json(["error" => "Les champs sont obligatoires"], 400);
            }
        }
    }
    public function getCategories()
    {
        $categories = Category::all();
        return response()->json(['categories', $categories]);
    }
}
