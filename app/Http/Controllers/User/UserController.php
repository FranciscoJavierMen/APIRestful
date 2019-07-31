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

        return $this->showAll($users);
    }


    /**
     * Store a newly created resource in storagclse.
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
        //Validación de las reglas y request
        $this->validate($request, $rules);

        $campos = $request->all();//Todos los campos
        $campos['password'] = bcrypt($request->password); //Encriptado
        $campos['verified'] = User::USUARIO_NO_VERIFICADO; //verificar usuario
        $campos['verification_token'] = User::generarVerificationToken();//generar token
        $campos['admin'] = User::USUARIO_REGULAR;

        $user = User::create($campos); //Creación del usuario

        return $this->showOne($user, 201); //Muestra el usuario recién creado
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $this->showOne($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //$user = User::findOrFail($id);
        //Reglas...
        $rules = [
            'email' => 'email|unique:users,email,' . $user->id,
            'password' => 'min:6|confirmed',
            'admin'=> 'in:' . User::USUARIO_ADMINISTRADOR .  ',' . User::USUARIO_REGULAR,
        ];

        $this->validate($request, $rules);//Vakidación de las reglas

        //Actualiza el nombre
        if ($request->has('name')) {
            $user->name = $request->name;
        }
        //Actualiza el imail si este es diferente al existente
        if ($request->has('email') && $user->email != $request->email) {
            $user->verified = User::USUARIO_NO_VERIFICADO;
            $user->verification_token = User::generarVerificationToken();
            $user->email = $request->email;
        }
        //Actualiza la contraseña
        if ($request->has('password')) {
            $user->password = bcrypt($request->passwowrd);
        }
        //Actualiza el estado del usuario
        if ($request->has('admin')) {
            if (!$user->esVerificado()) {
                return $this->errorResponse('Unicamante los usuarios verificados pueden cambiar su valor de administrador', 422);
            }

            $user->admin = $request->admin;
        }
        //Si no sse especifican datos se muestra un error
        if (!$user->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 409);
        }

        $user->save();

        return $this->showOne($user);
    }

    //Funcion para eliminar usuarios
    public function destroy(User $user)
    {
        //Encuentra el id del suario
        //$user = User::findOrFail($id);
        //Elimina el usuario
        $user->delete();
        //Retorna el usuario eliminado
        return $this->showOne($user);
    }
}
