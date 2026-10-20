<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */

    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && !Auth::user()->status) {
            // Para a API, devolve erro HTTP 403 em vez de redirecionar.
            if ($request->is('api/*') || $request->expectsJson()) {
                return response()->json([
                    'message' => 'Sua conta está desativada.',
                ], 403);
            }

            // Para o sistema web, encerra a sessão.
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->withErrors([
                'email' => 'Sua conta está desativada. Entre em contato com o suporte.',
            ]);
        }

        return $next($request);
    }

}