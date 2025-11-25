<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
   // app/Http/Middleware/RoleMiddleware.php

public function handle($request, Closure $next, ...$roles)
{
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $userRole     = strtolower(Auth::user()->role);
    $allowedRoles = array_map('strtolower', $roles);

    if (! in_array($userRole, $allowedRoles)) {
        abort(403, 'Akses ditolak');
    }

    return $next($request);
}

}
