<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        if ($request->isMethod("post")) {
            if ($request->filled(["name", "email", "address", "phone", "password"])) {
                $user = new User;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->name = $request->name;
                $user->adress = $request->address;
                $user->phone = $request->phone;
                $user->created_at = Carbon::now();
                $user->updated_at = Carbon::now();
                $user->role = 'customer';
                if ($request->hasFile('picture') && $request->file('picture')->isValid()) {
                    $user->picture = 'storage/' . $request->picture->store('user/images');
                }
                try {
                    $user->save();

                    return $user;
                } catch (Exception $e) {
                    return response()->json(["error" => "An error occurred " . $e->getMessage()], 404);
                }
            } else {
                return response()->json(["error" => "Les champs sont obligatoires"], 400);
            }
        }
    }

    public function updateUser(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $user = User::find($id);
            $picture = $user->picture;
            if ($request->hasFile('picture') && $request->file('picture')->isValid()) {
                $picture = "storage/" . $request->picture->store('user/images');
            }
            User::where("id", $id)->update([
                "name" => $request->name,
                "email" => $request->email,
                "address" => $request->address,
                "phone" => $request->phone,
                "password" => $user->password != $request->password ? Hash::make($request->password) : $user->password,
                "picture" => $picture,
            ]);
            $user = User::find($id);
            return response()->json(['success' => 'Modifier avec success', "user" => $user]);
        }
    }
}
