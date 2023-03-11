<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function addCategory(Request $request)
    {
        if ($request->filled("name")) {
            $category = new Category;
            $category->name = $request->name;
            if ($request->hasFile('picture') && $request->file('picture')->isValid()) {
                $category->picture = 'storage/' . $request->picture->store('category/images');
            }
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
    public function getCategories()
    {
        $categories = Category::all();
        return response()->json(['categories' => $categories]);
    }
    public function deleteCatgory($id)
    {
        Category::find($id)->delete();
        return response()->json(['success' => 'Spprimer avec succès']);
    }
}
