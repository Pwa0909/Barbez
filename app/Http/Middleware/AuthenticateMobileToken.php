<?php

namespace App\Http\Middleware;

use App\Models\Cliente;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateMobileToken
{
    public function handle(Request $request, Closure $next): Response
    {
        $authorization = $request->bearerToken();
        if (! $authorization) {
            return response()->json(['erro' => 'Entre na sua conta novamente.'], 401);
        }

        $registro = DB::table('mobile_api_tokens')
            ->where('token_hash', hash('sha256', $authorization))
            ->where(function ($query): void {
                $query->whereNull('expires_at')->orWhere('expires_at', '>', now());
            })
            ->first();

        if (! $registro) {
            return response()->json(['erro' => 'Entre na sua conta novamente.'], 401);
        }

        $usuario = match ($registro->tipo) {
            'cliente' => Cliente::find($registro->usuario_id),
            'admin' => User::find($registro->usuario_id),
            default => null,
        };

        if (! $usuario) {
            DB::table('mobile_api_tokens')->where('id', $registro->id)->delete();

            return response()->json(['erro' => 'Entre na sua conta novamente.'], 401);
        }

        $request->attributes->set('mobile_user', $usuario);
        $request->attributes->set('mobile_user_type', $registro->tipo);
        $request->attributes->set('mobile_token_id', $registro->id);

        return $next($request);
    }
}