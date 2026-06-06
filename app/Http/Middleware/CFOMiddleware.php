<?php
namespace App\Http\Middleware;

use Auth;
use Closure;

class CFOMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        
        $userType = Auth::user()->type;
        // Admin (0) or CFO (2) can access
        if (!in_array($userType, [0, 2])) {
            abort(403, 'CFO access required');
        }
        
        return $next($request);
    }
}