<?php
namespace App\Http\Controllers;

use App\Helpers\CaptchaHelper;
use Illuminate\Http\Request;

class CaptchaController extends Controller
{
    /**
     * Generate and display CAPTCHA image
     */
    public function generate()
    {
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
     * This uses check() instead of validate()
     */
    public function validate(Request $request)
    {
        $request->validate([
            'captcha' => 'required|string'
        ]);
        
        // Use check() - does NOT clear the CAPTCHA from session
        $isValid = CaptchaHelper::check($request->captcha);
        
        return response()->json([
            'valid' => $isValid,
            'message' => $isValid ? 'CAPTCHA is valid' : 'Invalid CAPTCHA'
        ]);
    }
}

