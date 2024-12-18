<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyEarlyAccess
{
    public function handle(Request $request, Closure $next)
    {
        // 1. Verifică mai întâi dacă există token în URL
        $token = $request->route('token');
        
        // 2. Dacă nu există token și nu avem deja acces în sesiune, redirecționează
        if (!$token && !session()->has('has_early_access')) {
            return redirect('/');
        }

        // 3. Dacă există token, verifică dacă e corect
        if ($token && $token !== config('early-access.token')) {
            return redirect('/');
        }
        
        // 4. Dacă token-ul e corect, setează sesiunea
        if ($token === config('early-access.token')) {
            session(['has_early_access' => true]);
        }

        return $next($request);
    }
}