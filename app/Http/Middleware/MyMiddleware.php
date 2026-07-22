<?php
namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MyMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // ============ 1. APPLY SECURITY HEADERS FIRST (BEFORE ANY RETURN) ============
        $response = $next($request);
        
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        $response->headers->remove('X-Powered-By');
        $response->headers->remove('Server');
        $response->headers->set('Server', 'Web Server');

        if ($request->secure() || env('APP_ENV') === 'production') {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');
        }

        // ============ 2. AUTHENTICATION & AUTHORIZATION CHECKS ============
        if (!Auth::check()) {
            return $response;  // Return the response with headers already set
        }

        $user = Auth::user();
        $userType = $user->type;
        $path = $request->path();

        if ($request->is('home-dashboard*') || $path === 'home-dashboard' || $path === 'home-dashboard-two') {
            $allowedDashboardTypes = [0, 1, 2, 3];
            if (!in_array($userType, $allowedDashboardTypes)) {
                abort(403, 'Unauthorized - Dashboard access requires Admin, Deputy, CFO, or FSO role. Your role: ' . $this->getRoleName($userType));
            }
        }

        $adminOnlyPaths = [
            'admin/district*', 'admin/tehsil*', 'admin/block*', 'admin/panchayat*',
            'admin/category*', 'admin/subcategory*', 'admin/projects*', 'admin/type*',
            'admin/pricing-rules*', 'admin/services*', 'admin/report-fee-master*',
            'personnel-expense*', 'admin/leadership-section*', 'admin/about/*',
            'admin/activities/*', 'admin/achivements/*', 'admin/services/*',
            'admin/staffstrength*', 'admin/vehicletypes*', 'admin/achievement*',
            'admin/getserviceorder*', 'admin/getpublicarticle*', 'admin/getrecruitment*',
            'admin/gethistory*', 'admin/getroutemap*', 'admin/getistitutionalstructure*',
            'admin/getresult*', 'admin/gettrainingschedule*', 'admin/getcourse*',
            'admin/getnocdocrequire*', 'admin/getchecklist*', 'admin/getbannerslider*',
            'admin/getwelfareamenity*',
        ];

        foreach ($adminOnlyPaths as $pattern) {
            if ($request->is($pattern) && $userType != 0) {
                abort(403, 'Unauthorized - Admin access required. Your role: ' . $this->getRoleName($userType));
            }
        }

        if ($request->is('cfo/*') || str_contains($path, 'cfo')) {
            if (!in_array($userType, [0, 1, 2])) {
                abort(403, 'Unauthorized - CFO access required.');
            }
        }

        if ($request->is('fso/*') || str_contains($path, 'fso')) {
            if (!in_array($userType, [0, 1, 2, 3])) {
                abort(403, 'Unauthorized - FSO access required.');
            }
        }

        if ($request->is('deputy/*') || str_contains($path, 'deputy')) {
            if (!in_array($userType, [0, 1])) {
                abort(403, 'Unauthorized - Deputy Director access required.');
            }
        }

        return $response;
    }

    private function getRoleName($type)
    {
        $roles = [
            0 => 'Admin',
            1 => 'Deputy Director',
            2 => 'CFO',
            3 => 'FSO',
            4 => 'Citizen',
            5 => 'Deputy Manager',
            6 => 'Agency',
            7 => 'Auditor'
        ];
        return $roles[$type] ?? 'Unknown';
    }
}
