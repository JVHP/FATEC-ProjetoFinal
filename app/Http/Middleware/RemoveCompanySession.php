<?php

namespace App\Http\Middleware;

use App\Models\Empresa;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RemoveCompanySession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        /* if (Auth::check() && Auth::user()->isCliente()) {
            if ($next == '/login') {

                    $empresa = Empresa::firstWhere('cnpj', '=', Auth::user()->getCnpjCadastro());

                    echo '<script>console.log("'.$empresa.'")</script>';

                    if ($empresa != null) {
                        session(['empresa'=>$empresa]);
                        return redirect('/loja/'.$empresa->url_customizada);

                    } else {
                        session(['empresa' => null]);
                        session()->invalidate();
                    }

            } else if (!$request->is('loja/*')) {
                session(['empresa' => null]);
                session()->invalidate();

                return redirect('/');
            }

        } */

            /* if ($next == '/login' || $next == '') {
                if (Auth::check() && Auth::user()->isCliente()) {
                    $empresa = Empresa::firstWhere('cnpj', '=', Auth::user()->getCnpjCadastro());

                    if ($empresa != null) {
                        session(['empresa'=>$empresa]);

                        return redirect('/loja/'.$empresa->url_customizada);

                    } else {
                        session(['empresa' => null]);
                        session()->invalidate();

                        return redirect('/');
                    }
                }
            } */
            /* else if ($next == '/logout') {
                
                    $empresa = Empresa::firstWhere('cnpj', '=', Auth::user()->getCnpjCadastro());

                    if ($empresa != null) {
                        session(['empresa'=>$empresa]);
                        session()->invalidate();

                        return redirect('/loja/'.$empresa->url_customizada);
                    } else {
                        session(['empresa' => null]);
                        session()->invalidate();

                        return redirect('/');
                    }
                
            } else if (!$request->is('/loja/*') && $next != '/logout' && $next != '/login') {
                if (Auth::check() && Auth::user()->isCliente()) {
                    session(['empresa' => null]);
                    session()->invalidate();

                    return redirect('/');
                }
            } */
            
            if (Auth::check() && Auth::user()->isCliente()) {
                $empresa = Empresa::firstWhere('cnpj', '=', Auth::user()->getCnpjCadastro());
                
                if (session('empresa') == null) {
                    if ($empresa != null) {
                        session(['empresa'=>$empresa]);

                        return redirect('/loja/'.$empresa->url_customizada);
                    } else {
                        session()->invalidate();
                    }
                
                } else if (session('empresa') != null) {
                    if ($request->is('') || $request->is('/') || $next == '/' || $next == '') {
                        return redirect('/loja/'.session('empresa')->url_customizada);
                    } else {
                        if ($empresa->id != session('empresa')->id) {
                            $empresaTemp = session('empresa');
    
                            session()->invalidate();
    
                            session(['empresa'=>$empresaTemp]);
    
                            return redirect('/loja/'.session('empresa')->url_customizada);
                        }
                    }
                }                
            } else {
                if (!$request->is('/loja/*')) {
                    session(['empresa'=>null]);
                }
            }

        return $next($request);
    }
}
