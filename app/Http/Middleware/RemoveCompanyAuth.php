<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RemoveCompanyAuth
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
        /* if (session('empresa') && $request->is('loja/'.session('empresa')->url_customizada.'/*') && !$request->is('/login')) {
            $request->session()->invalidate();
        } */

        /* if (Auth::check() && Auth::user()->isCliente() && ($request->is('/') || $request->is(''))) {
            $request->session()->invalidate();
        } */
        return $next($request);
    }

}
