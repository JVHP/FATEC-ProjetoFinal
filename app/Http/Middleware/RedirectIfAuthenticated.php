<?php

namespace App\Http\Middleware;

use App\Models\Empresa;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if ($request->has('cd_empresa')) {
                    $empresa = Empresa::where('url_customizada', '=', $request->cd_empresa)->first();
                    session(['empresa' => $empresa]);
                    
                    if(Auth::user()->cnpj_empresa_cadastrada){
                        
                        return redirect('/loja/'.session('empresa')->url_customizada);
                    } else {
                        return ('/login');
                    }
                }

                return redirect('/');
            }
        }

        return $next($request);
    }
}
