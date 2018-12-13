<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function __construct() {
        //primenjujemo ovaj middleware na svim metodama sem na login
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(Request $request) {
        $credentials = $request->only([ 'email', 'password' ]); //hocemo u $credentials da smestimo samo email i password kao $request koji user salje
        $token = auth()->attempt($credentials); //generisi mi $token za ovaj email i password koji si dobio
                //ovo radimo i za registraciju isto
                //samo kroz payload saljemo vise stvari kad registrujemo korisnika
        
        //ako nema tokena
        if(!$token) {
            //vrati message
            //dobijamo json objekat
            return response()->json([
                'message' => 'You are not authorized!'
            ], 401); //drugi argument je 401 status(not authorized)
        }

        return response()->json([
            'token' => $token,
            'type' => 'bearer', //tip tokena koji smo kreirali
            'expires_in' => auth()->factory()->getTTL() * 60, //kad nam token istice za autentifikovanog korisnika
            'user' => auth()->user(), //vracamo usera sa njegovim podacima, da ne bi morali da pravimo novi request da vratimo ulogovanog korisnika
        ]);
    }

}
