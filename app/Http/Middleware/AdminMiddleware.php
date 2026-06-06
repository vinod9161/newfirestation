<?php
namespace App\Http\Middleware;

use Auth;
use Closure;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        
        if (Auth::user()->type != 0) {
            abort(403, 'Admin access required. Your role: ' . $this->getRoleName(Auth::user()->type));
        }
        
        return $next($request);
    }
    
    private function getRoleName($type)
    {
        $roles = [0 => 'Admin', 1 => 'Deputy', 2 => 'CFO', 3 => 'FSO', 4 => 'Citizen'];
        return $roles[$type] ?? 'User';
    }
}