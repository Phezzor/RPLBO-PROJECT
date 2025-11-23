<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class WebAuthMiddleware
{
    /**
     * Handle an incoming request for web routes
     * Check JWT token from cookie and redirect to login if not authenticated
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            // Get token from cookie
            $token = $request->cookie('jwt_token');

            if (!$token) {
                return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
            }

            // Set token to JWTAuth
            JWTAuth::setToken($token);

            // Authenticate user
            $user = JWTAuth::authenticate();
            
            if (!$user) {
                return redirect()->route('login')->with('error', 'Sesi Anda telah berakhir');
            }

            // Check if user is active
            if ($user->status === 'inactive') {
                return redirect()->route('login')->with('error', 'Akun Anda tidak aktif');
            }

            // Set authenticated user to request
            auth()->setUser($user);
            $request->merge(['auth_user' => $user]);

        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return redirect()->route('login')->with('error', 'Token tidak valid');
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return redirect()->route('login')->with('error', 'Sesi Anda telah berakhir');
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Terjadi kesalahan autentikasi');
        }

        return $next($request);
    }
}

