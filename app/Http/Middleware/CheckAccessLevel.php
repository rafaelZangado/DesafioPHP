<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAccessLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $actions)
    {
        $user = $request->user();

        $allowedActions = explode(',', $actions);

        if (!$user) {
            return response()->json(['error' => 'Acesso não autorizado'], 403);
        }

        if (in_array('register', $allowedActions) && in_array($user->nivel, [1, 2])) {
            return $next($request);
        }

        if (in_array('listar', $allowedActions) && in_array($user->nivel, [1, 2, 3])) {
            return $next($request);
        }

        if (in_array('editar', $allowedActions) && in_array($user->nivel, [1, 2])) {
            return $next($request);
        }

        if (in_array('deletar', $allowedActions) && in_array($user->nivel, [1, 2])) {
            return $next($request);
        }

        return response()->json(['error' => 'Acesso não autorizado'], 403);
    }
}
