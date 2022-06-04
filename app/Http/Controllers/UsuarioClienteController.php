<?php

namespace App\Http\Controllers;

use App\Enums\TipoCadastro;
use App\Models\User;
use App\Models\Carro;

use App\Http\Requests\UsuarioRequest;
use App\Http\Requests\UsuarioEditRequest;
use App\Models\Empresa;
use App\Models\Marca;
use DateTime;
use Detalhes_Carro_Usuario;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use Illuminate\Auth\Events\Registered;
use phpDocumentor\Reflection\Types\Object_;

class UsuarioClienteController extends Controller
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
    public function create($cd_empresa)
    {

        $empresa = Empresa::where('url_customizada', '=', $cd_empresa)->first();
        
        if ($empresa == null) {
            return redirect()->back();
        }
        
        session(['empresa' => $empresa]);

        $carros = Carro::orderBy('ano', 'DESC')->orderBy('nm_carro', 'ASC')->get();

        $carrosGroup = $carros->groupBy('ano');

        $marcas = Marca::whereIn('ck_categoria_marca', ['C', 'A'])->get();

        return view('auth.register-user-client')->with('carros', $carrosGroup)->with('marcas', $marcas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($cd_empresa, UsuarioRequest $request)
    {
        try {
            DB::beginTransaction();

            $senha = Hash::make($request->cd_password);

            $request->request->add(['password'=>$senha]);
            
            $empresa = Empresa::where('url_customizada', '=', $cd_empresa)->first();

            $request->request->add(['ck_tipo_cadastro'=>TipoCadastro::Cliente]);

            $request->request->add(['cnpj_empresa_cadastrada'=>$empresa->cnpj]);

            $usuario = User::create($request->all());            

            if ($request->has('carros')) {
                $carros = $request->carros;
                            
                foreach($carros as $carro_id){
                    $insert = Carro::find($carro_id['id'])->usuarios()->save($usuario);

                    $carro_usuario = DB::table('carro_usuarios')->where(['id_usuario'=>$insert->id, 'id_carro' => $carro_id['id']])->first();

                    DB::table('detalhes_carro_usuario')->insert([
                        [
                         'qt_kilometragem' => $carro_id['qt_kilometragem'],
                         'qt_media_kilometragem' => $carro_id['qt_media_kilometragem'],
                         'dt_ultima_troca_oleo' => new DateTime($carro_id['dt_ultima_troca_oleo']),
                         'id_carro_usuarios' => $carro_usuario->id
                        ]
                    ]);
                
                } 

            }
                
            event(new Registered($usuario));

            DB::commit();
            
            return redirect('/loja/'.session('empresa')->url_customizada);

        } catch (Exception $ex) {
            DB::rollBack();
            return $ex;

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show($cd_empresa, User $usuario)
    {
        return view('usuarios.show')->with('usuario', $usuario);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit($cd_empresa, User $usuario)
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
    public function update($cd_empresa, UsuarioEditRequest $request, User $usuario)
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
    public function destroy($cd_empresa, User $usuario)
    {
        $usuario->delete();
        return redirect('/usuarios');
    }
}
