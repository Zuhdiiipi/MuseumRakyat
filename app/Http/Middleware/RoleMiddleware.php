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

    // NORMALISASI: buang spasi + jadikan lowercase
    $userRole = strtolower(trim(Auth::user()->role));

    $allowedRoles = array_map(function ($role) {
        return strtolower(trim($role));
    }, $roles);

    if (! in_array($userRole, $allowedRoles, true)) {
        abort(403, 'Akses ditolak');
    }

    return $next($request);
}

}
