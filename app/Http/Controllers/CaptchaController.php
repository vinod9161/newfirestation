<?php
namespace App\Http\Controllers;

use App\Helpers\CaptchaHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CaptchaController extends Controller
{
    /**
     * Generate and display CAPTCHA image
     */
    public function generate()
    {
        // ============ ADD RATE LIMITING ============
        $ip = request()->ip();
        $key = 'captcha_generation_' . $ip;
        $generations = Cache::get($key, 0);
        
        // Allow 20 CAPTCHA generations per hour per IP
        if ($generations >= 20) {
            abort(429, 'Too many CAPTCHA requests. Please try again later.');
        }
        
        Cache::put($key, $generations + 1, now()->addHours(1));
        // ===========================================
        
        $imageData = CaptchaHelper::generateAndStore();
        
        return response($imageData)
            ->header('Content-Type', 'image/png')
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }
    
    /**
     * Refresh CAPTCHA
     */
    public function refresh()
    {
        // ============ ADD RATE LIMITING ============
        $ip = request()->ip();
        $key = 'captcha_refresh_' . $ip;
        $refreshes = Cache::get($key, 0);
        
        // Allow 30 refreshes per hour per IP
        if ($refreshes >= 30) {
            return response()->json([
                'success' => false,
                'error' => 'Too many refresh attempts. Please try again later.'
            ], 429);
        }
        
        Cache::put($key, $refreshes + 1, now()->addHours(1));
        // ===========================================
        
        $imageData = CaptchaHelper::refresh();
        
        $base64 = base64_encode($imageData);
        
        return response()->json([
            'success' => true,
            'image' => 'data:image/png;base64,' . $base64,
            'timestamp' => time(),
        ]);
    }
    
    /**
     * Validate CAPTCHA for REAL-TIME (does NOT clear session)
     */
    public function validate(Request $request)
    {
        // ============ ADD RATE LIMITING ============
        $ip = request()->ip();
        $key = 'captcha_validation_' . $ip;
        $validations = Cache::get($key, 0);
        
        // Allow 50 validations per hour per IP
        if ($validations >= 50) {
            return response()->json([
                'valid' => false,
                'error' => 'Too many validation attempts. Please try again later.'
            ], 429);
        }
        
        Cache::put($key, $validations + 1, now()->addHours(1));
        // ===========================================
        
        $request->validate([
            'captcha' => 'required|string'
        ]);
        
        $isValid = CaptchaHelper::check($request->captcha);
        
        return response()->json([
            'valid' => $isValid,
            'message' => $isValid ? 'CAPTCHA is valid' : 'Invalid CAPTCHA'
        ]);
    }
}