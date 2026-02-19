<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsApproved
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            // Admin doesn't need approval check
            if (Auth::user()->role === 'admin') {
                return $next($request);
            }

            // Check if user is approved
            if (!Auth::user()->is_approved) {
                Auth::logout();
                return redirect()->route('login')
                    ->with('error', 'Your account is pending approval. Please contact the administrator.');
            }
        }

        return $next($request);
    }
}