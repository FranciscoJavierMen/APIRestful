<?php

namespace App\Http\Controllers\User;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\APIController;

class UserController extends APIController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return  response()->json([
            'data' => $users
        ], 200);
        
        
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //Reglas
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ];

        $this->validate($request, $rules);

        $campos = $request->all();//Todos los campos
        $campos['password'] = bcrypt($request->password); //Encriptado
        $campos['verified'] = User::USUARIO_NO_VERIFICADO; //verificar usuario
        $campos['verification_token'] = User::generarVerificationToken();//generar token
        $campos['admin'] = User::USUARIO_REGULAR;

        $user = User::create($campos); 

        return response()->json([
            'data' => $user
        ], 201); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = User::findOrFail($id);

        return response()->json([
            'data'=>$users
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        //Reglas...
        $rules = [
            'email' => 'email|unique:users,email,' . $user->id,
            'password' => 'min:6|confirmed',
            'admin'=> 'in:' . User::USUARIO_ADMINISTRADOR .  ',' . User::USUARIO_REGULAR,
        ];

        $this->validate($request, $rules);

        if ($request->has('name')) {
            $user->name = $request->name;
        }

        if ($request->has('email') && $user->email != $request->email) {
            $user->verified = User::USUARIO_NO_VERIFICADO;
            $user->verification_token = User::generarVerificationToken();
            $user->email = $request->email;
        }

        if ($request->has('password')) {
            $user->password = bcrypt($request->passwowrd);
        }

        if ($request->has('admin')) {
            if (!$user->esVerificado()) {
                return response()->json([
                    'error' => 'Unicamante los usuarios verificados pueden cambiar su valor de administrador', 'code' => 422
                ], 422);
            }

            $user->admin = $request->admin;
        }

        if (!$user->isDirty()) {
            return response()->json([
                    'error' => 'Se debe especificar al menos un valor diferente para actualizar', 'code' => 409
                ], 409);
        }

        $user->save();

        return response()->json([
            'data' => $user
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return response()->json([
            'data' => $user 
        ],200);
    }
}
