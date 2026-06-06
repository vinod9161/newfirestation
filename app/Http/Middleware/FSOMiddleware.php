<?php
namespace App\Http\Middleware;

use Auth;
use Closure;

class FSOMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        
        $userType = Auth::user()->type;
        // Admin (0), CFO (2), or FSO (3) can access
        if (!in_array($userType, [0, 2, 3])) {
            abort(403, 'FSO access required');
        }
        
        return $next($request);
    }
}