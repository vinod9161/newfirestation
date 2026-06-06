<?php
namespace App\Http\Middleware;

use Auth;
use Closure;

class StaffMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        
        $userType = Auth::user()->type;
        
        // Allow Admin(0), CFO(2), FSO(3), Deputy(1) to access
        $allowedTypes = [0, 1, 2, 3];
        
        if (!in_array($userType, $allowedTypes)) {
            abort(403, 'Access denied. Staff only.');
        }
        
        return $next($request);
    }
}