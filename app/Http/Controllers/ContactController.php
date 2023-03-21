<?php

namespace App\Http\Controllers;

use App\Mail\MessageReceptionConfirmation;
use App\Mail\SendMessage;
use App\Mail\sendUserMail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function contact(Request $request)
    {
        if ($request->filled(["name", "email","subject", "message"])) {
            try {
                Mail::to($request->email)->send(new MessageReceptionConfirmation($request->name, $request->subject));
                Mail::to("adilboussaleem@gmail.com")->send(new SendMessage($request->name, $request->email,$request->subject, $request->message));
                return response()->json(["success" => "Message envoyé avec succès!"]);
            } catch (Exception $e) {
                return response()->json(["error" => "Une erreur est survenue ! " . $e->getMessage()], 500);
            }
        } else {
            return response()->json(["error" => "Les champs sont obligatoires"], 400);
        }
    }
    public function contactUser(Request $request)
    {
        if ($request->filled(["name", "email", "message"])) {
            try {
                Mail::to($request->userEmail)->send(new sendUserMail($request->name, $request->email, 'Information sur votre annonce', $request->message,$request->userEmail));
                return response()->json(["success" => "Message envoyé avec succès!"]);
            } catch (Exception $e) {
                return response()->json(["error" => "Une erreur est survenue ! " . $e->getMessage()], 500);
            }
        } else {
            return response()->json(["error" => "Les champs sont obligatoires"], 400);
        }
    }
}
