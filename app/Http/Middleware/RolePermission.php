<?php

namespace App\Http\Middleware;

use Route;
use Session;
use Auth;
use App\Models\User;
use App\Models\UserRole;
use Closure;
use Illuminate\Http\Request;

class RolePermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if ($user) {
            $checkRole = UserRole::where('user_id', $user->id)->with('role')->get();
            if (sizeof($checkRole) == 1) {
                $role = $checkRole[0]->role;
                $request->attributes->add(['role' => $role]);
                
                if ($role->id != 1 && !in_array(Route::currentRouteName(), User::baseAccess())) {
                    abort(404);
                }
                return $next($request);
            } else {
                Session::flash('error', 'Akun anda tidak memiliki role permission, harap hubungi admin');
                $request->attributes->add(['role' => null]);
                return $next($request);
            }
        }
    }
}
