<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateStoreRoute
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
        
        
        if (url()->previous() == '/loja/*' && $request->is('/login')) {
            return redirect('/loja/'.session('empresa')->url_customizada);
        }

        return $next($request);
    }
}
