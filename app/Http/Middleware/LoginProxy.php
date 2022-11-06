<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LoginProxy
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return JsonResponse|Request|mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $clientName = env('APP_CLIENT_NAME');

        $client = DB::table('oauth_clients')
            ->where([
                ['name', $clientName],
                ['password_client', true],
            ])
            ->first();

        if (!$client) {
            Log::error("Could not find OAuth client $clientName");

            return response()->json([
                'success' => false,
                'message' => 'Could not authenticate',
            ], 500);
        }

        $refreshToken = $request->input('refresh_token');

        $request->merge([
            'grant_type'    => $refreshToken ? 'refresh_token' : 'password',
            'client_id'     => $client->id,
            'client_secret' => $client->secret,
            'scope'         => '',
        ]);

        if ($refreshToken) {
            return $this->authRefreshToken($request, $next);
        }

        return $next($request);
    }

    /**
     * Refresh Token.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    protected function authRefreshToken(Request $request, Closure $next)
    {
        return $next($request);
    }
}
