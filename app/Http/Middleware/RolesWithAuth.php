<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RolesWithAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (auth()->user() and !auth()->user()->roles()->first()->slug) {
            Auth::logout();
            return redirect('/login')->withErrors([
                'messages' => 'Sizga bu tizimga kirish ruxsati yo‘q.'
            ]);
        }
        $userRoles  = auth()->user()->roles->pluck('slug')->toArray();
        if (array_intersect($roles, $userRoles)) {
            return $next($request);
        }
//        foreach ($roles as $role) {
//            if (array_intersect($role, $userRoles)){
//                return $next($request);
//            }
//        }
        return redirect()->back()->withErrors(['messages' => 'Bunday sahifa mavjud emas']);
    }
}
