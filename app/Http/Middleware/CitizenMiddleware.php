<?php
namespace App\Http\Middleware;

use Auth;
use Closure;

class CitizenMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        
        $userType = Auth::user()->type;
        if (!in_array($userType, [0, 4])) {
            abort(403, 'Citizen access required');
        }
        
        return $next($request);
    }
}