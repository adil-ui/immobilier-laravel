<?php

namespace App\Http\Controllers;

use App\Mail\ResetPassword;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $token = Auth::user()->createToken(Auth::user()->name);
            return response()->json(['token' => $token->plainTextToken, "user" => Auth::user()]);

        }
        return response()->json(["error" => "User not found"], 404);
    }

    public function revokeTokens(Request $request)
    {
        $user = User::find($request->id);
        $user->tokens()->delete();
        return response()->json(["success" => "Logout successfull"]);
    }

    public function forgotPassword(Request $request)
    {
        $queryResults = User::where("email", $request->email)->getQuery();
        if ($queryResults->exists()) {
            $user = $queryResults->first();
            $token = md5($request->email);
            DB::table('password_resets')->insert([
                "email" => $request->email,
                "token" => $token,
                "created_at" => Carbon::now()
            ]);
            try {
                Mail::to($user->email)->send(new ResetPassword($user, $token));
                return response()->json(["success" => "Email Successfully Sent"]);
            } catch (Exception $e) {
                return response()->json(["error" => "An Error Has Occurred " . $e->getMessage()], 500);
            }
        } else {
            return response()->json(["error" => "Email Not Found"], 400);
        }
    }

    public function resetPassword(Request $request, $token)
    {
        if ($request->isMethod('post')) {
            $query = DB::table('password_resets')->where("token", $token);
            if ($query->count() == 1) {
                $passwordResets = $query->first();
                $user = User::where("email", $passwordResets->email)->first();
                try {
                    User::where("id", $user->id)->update(["password" => Hash::make($request->password)]);
                    return response()->json(["success" => "Password Successfully Changed"]);
                } catch (Exception $e) {
                    return response()->json(["error" => "An Error Has Occurred" . $e->getMessage()], 500);
                }
            }
        }

    }


}
