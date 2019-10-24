<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('JWTMiddleware',['except'=>['signup','signin']]);
    }

    public function getallusers(){
        // JWTAuth::parseToken()->authenticate();
        $users= User::all();
        return response()->json($users,200);
    }
    public function signup(Request $request){
        $reglas = [
            "name" => "required",
            "email" => "required|email|unique:users,email",
            "password" => "required"
        ];
        // $this->validate($request,$reglas); hay una forma mejor
        $validador = Validator::make($request->all(),$reglas);
        if ($validador->fails()){
            return response()->json($validador->errors(),401);
        }
        $usuarioobjeto = [
            "name" => $request->input('name'),
            "email" => $request->input('email'),
            "email" => $request->input('email'),
            "password" => bcrypt($request->input('password'))
        ];
        $user = new User($usuarioobjeto);
        $user->save();
        return response()->json([
            "msg"=>"Usuario creado con exito!"
        ],201);
    }

    public function signin(Request $request){
        $reglas = [
            "name" => "required",
            "email" => "required|email",
            "password" => "required"
        ];
        // $this->validate($request,$reglas);
        $validator= Validator::make($request->all(),$reglas);
        if ($validator->fails()){
            return response()->json($validator->errors(), 404);
        }
        $credentials = $request->only('email','password');
        try{
            if (!$token = JWTAuth::attempt($credentials)){
                return response()->json(["error"=>"credenciales invalidas"], 401);
            }
            $data = ["token"=>$token];
            return response()->json($data, 200);
        }catch (JWTException $e){
            $data = ["error"=>"no se pudo crear el token error del servidor"];
            return response()->json($data, 500);
        }

    }
}
