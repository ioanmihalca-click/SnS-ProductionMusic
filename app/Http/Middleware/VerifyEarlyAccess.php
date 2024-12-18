<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyEarlyAccess
{
    public function handle(Request $request, Closure $next)
    {
        // Verifică dacă userul are deja acces în sesiune
        if (session()->has('has_early_access')) {
            return $next($request);
        }

        // Verifică token-ul din URL
        $token = $request->route('token');
        
        if (!$token || $token !== config('early-access.token')) {
            return redirect('/');
        }
        
        // Setează sesiunea pentru acces
        session(['has_early_access' => true]);
        
        return $next($request);
    }
}