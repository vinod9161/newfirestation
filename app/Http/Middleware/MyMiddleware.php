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
        $response = $next($request);
        
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        
        // Remove version disclosure
        $response->headers->remove('X-Powered-By');
        
        // HSTS (only for HTTPS - add when you enable SSL)
        // if ($request->secure()) {
        //     $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        // }
        
        // ============ END SECURITY HEADERS ============
        
        if (!Auth::check()) {
            return redirect('/login');
        }
        
        $user = Auth::user();        
        $userType = $user->type;        
        $path = $request->path();

        if ($request->is('home-dashboard*') || $path === 'home-dashboard' || $path === 'home-dashboard-two') {
            $allowedDashboardTypes = [0, 1, 2, 3];  // Admin, Deputy, CFO, FSO
            if (!in_array($userType, $allowedDashboardTypes)) {
                abort(403, 'Unauthorized - Dashboard access requires Admin, Deputy, CFO, or FSO role. Your role: ' . $this->getRoleName($userType));
            }
        }
        
        $adminOnlyPaths = [
            'admin/district*',            // District management
            'admin/tehsil*',              // Tehsil management
            'admin/block*',               // Block management
            'admin/panchayat*',           // Panchayat management
            'admin/category*',            // Category management
            'admin/subcategory*',         // Subcategory management
            'admin/projects*',            // Project management
            'admin/type*',                // Type management
            'admin/pricing-rules*',       // Pricing rules
            'admin/services*',            // Services
            'admin/report-fee-master*',   // Report fee master
            'personnel-expense*',         // Personnel expense
            'admin/leadership-section*',  // Leadership section
            'admin/about/*',              // CMS About section
            'admin/activities/*',         // CMS Activities
            'admin/achivements/*',        // CMS Achievements
            'admin/services/*',           // Services management
            'admin/staffstrength*',       // Staff strength
            'admin/vehicletypes*',        // Vehicle types
            'admin/achievement*',         // Achievement management
            'admin/getserviceorder*',     // Service order
            'admin/getpublicarticle*',    // Public article
            'admin/getrecruitment*',      // Recruitment
            'admin/gethistory*',          // History
            'admin/getroutemap*',         // Route map
            'admin/getistitutionalstructure*', // Institutional structure
            'admin/getresult*',           // Result
            'admin/gettrainingschedule*', // Training schedule
            'admin/getcourse*',           // Course
            'admin/getnocdocrequire*',    // NOC required documents
            'admin/getchecklist*',        // Checklist
            'admin/getbannerslider*',     // Banner slider
            'admin/getwelfareamenity*',   // Welfare amenity
        ];
        
        // Check admin-only paths
        foreach ($adminOnlyPaths as $pattern) {
            if ($request->is($pattern)) {
                if ($userType != 0) {
                    abort(403, 'Unauthorized - Admin access required. Your role: ' . $this->getRoleName($userType));
                }
                break;
            }
        }
        
        if ($request->is('cfo/*') || str_contains($path, 'cfo')) {
            if (!in_array($userType, [0, 1, 2])) {
                abort(403, 'Unauthorized - CFO access required. Your role: ' . $this->getRoleName($userType));
            }
        }
        
        if ($request->is('fso/*') || str_contains($path, 'fso')) {
            if (!in_array($userType, [0, 1, 2, 3])) {
                abort(403, 'Unauthorized - FSO access required. Your role: ' . $this->getRoleName($userType));
            }
        }
        
        if ($request->is('deputy/*') || str_contains($path, 'deputy')) {
            if (!in_array($userType, [0, 1])) {
                abort(403, 'Unauthorized - Deputy Director access required. Your role: ' . $this->getRoleName($userType));
            }
        }
        
        return $next($request);
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