<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UsuarioRequest;
use App\Http\Requests\UsuarioEditRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('user.manipulation', ['except' => ['store', 'create']]);
    }
    public function index()
    {
        $usuarios = User::orderBy('id', 'ASC')->paginate(20);
        return view('usuarios.index')->with('usuarios', $usuarios);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function create()
    {
        return view('auth.register-user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsuarioRequest $request)
    {

        /* echo "Hallo";
        if ($request->has('emailC')) {
            $email = $request->emailC;

            $request->request->add(['email' => $email]);
        } */

        $senha = Hash::make($request->cd_password);

        $request->request->add(['password'=>$senha]);
        User::create($request->all());
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(User $usuario)
    {
        return view('usuarios.show')->with('usuario', $usuario);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit(User $usuario)
    {   
        return view('usuarios.edit')->with('usuario', $usuario);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(UsuarioEditRequest $request, User $usuario)
    {
        
        Validator::make($request->rules(), [
            'email' => [
                'required',
                Rule::unique('users')->ignore($usuario->id),
            ],
        ]);

        $usuario->update($request->all());
        return redirect('/usuarios');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $usuario)
    {
        $usuario->delete();
        return redirect('/usuarios');
    }
}
