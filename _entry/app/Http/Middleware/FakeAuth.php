<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\GenericUser;
use Illuminate\Support\Facades\Auth;
class FakeAuth
{
    public function handle($request, Closure $next)
    {
        $user = new GenericUser([
            'id' => '00000000-0000-0000-0000-000000000001',
            'name' => 'Demo User',
            'email' => 'demo@example.com',
        ]);

        Auth::setUser($user);

        return $next($request);
    }
}
