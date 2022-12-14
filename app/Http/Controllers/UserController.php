<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'role_id'   => 'required',
            'firstname' => 'required',
            'lastname'  => 'required',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:8|confirmed',
            'status'    => 'required|boolean',
            'ip_create' => 'required|string|max:15',
        ]);

        $user = new User();
        $user->role_id      = $request->role_id;
        $user->firstname    = $request->firstname;
        $user->lastname     = $request->lastname;
        $user->email        = $request->email;
        $user->password     = Hash::make($request->password);
        $user->status       = $request->status;
        $user->ip_create    = $request->ip_create;

        $user->save();

        return response()->json([
            "status" => 1,
            "msg" => "¡Registro de usuario exitoso!",
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $user = User::find($request->id);
        return response()->json($user,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateUser(Request $request)
    {
        $request->validate([
            'role_id'   => 'required|numeric',
            'firstname' => 'required',
            'lastname'  => 'required',
            'email'     => 'required|email|unique:users',
            'status'    => 'required|boolean',
            'ip_update' => 'required|string|max:15',
        ]);

        $user = User::findOrFail($request->id);
        $user->role_id      = $request->role_id;
        $user->firstname    = $request->firstname;
        $user->lastname     = $request->lastname;
        $user->email        = $request->email;
        $user->status       = $request->status;
        $user->ip_create    = $request->ip_create;

        $user->save();

        return response()->json([
            'message'   => '¡Usuario modificado exitosamente!',
            'user'      => $user
        ], 200);
    }

    public function login(Request $request){
        $request->validate([
            'email'  => 'required|string|min:6|max:15',
            'password'  => 'required|min:8',
        ]);
        
        $user = User::where("email", "=", $request->email)->first();

        if( isset($user->id) ){
            if(Hash::check($request->password, $user->password)){
                $token = $user->createToken("auth_token")->plainTextToken;

                return response()->json([
                    "status"        => 1,
                    "msg"           => "¡Iniciaste sesión correctamente!",
                    "access_token"  => $token,
                ], 201);
            } else {
                return response()->json([
                    "status"    => 0,
                    "msg"       => "¡Datos ingresados erróneos, no puede iniciar sesión!",
                ], 401);
            }
        } else {
            return response()->json([
                "status"    => 0,
                "msg"       => "¡Usuario no existe!",
            ], 404);
        }
    }

    public function logout(Request $request){
        $request->user()->tokens()->delete();

        return response()->json([
            "status"    => 1,
            "msg"       => "¡Cierre de sesión!"
        ], 200);
    }
}
