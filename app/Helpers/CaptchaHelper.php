<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Session;

class CaptchaHelper
{
    /**
     * Generate a random CAPTCHA code
     */
    public static function generateCode($length = 6)
    {
        // Removed confusing characters: 0,1,I,O,o,l
        $characters = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
        $code = '';
        
        for ($i = 0; $i < $length; $i++) {
            $code .= $characters[rand(0, strlen($characters) - 1)];
        }
        
        return $code;
    }
    
    /**
     * Create CAPTCHA image from code
     */
    public static function createImage($code)
    {
        // Image dimensions
        $width = 150;
        $height = 50;
        
        // Create image
        $image = imagecreatetruecolor($width, $height);
        
        // Colors
        $bgColor = imagecolorallocate($image, 237, 231, 246);
        $textColor = imagecolorallocate($image, 29, 29, 29);
        $lineColor = imagecolorallocate($image, 150, 150, 150);
        
        imagefill($image, 0, 0, $bgColor);
        imagerectangle($image, 0, 0, $width - 1, $height - 1, $lineColor);
        
        // Add random lines
        for ($i = 0; $i < 5; $i++) {
            $randColor = imagecolorallocate($image, rand(100, 200), rand(100, 200), rand(100, 200));
            imageline($image, rand(0, $width), rand(0, $height), rand(0, $width), rand(0, $height), $randColor);
        }
        
        // Add random dots
        for ($i = 0; $i < 300; $i++) {
            $randColor = imagecolorallocate($image, rand(100, 200), rand(100, 200), rand(100, 200));
            imagesetpixel($image, rand(0, $width), rand(0, $height), $randColor);
        }
        
        // Add text
        $fontPath = public_path('fonts/arial.ttf');
        
        if (file_exists($fontPath)) {
            for ($i = 0; $i < strlen($code); $i++) {
                $angle = rand(-5, 5);
                $x = 15 + ($i * 20);
                $y = 35;
                imagettftext($image, 20, $angle, $x, $y, $textColor, $fontPath, $code[$i]);
            }
        } else {
            imagestring($image, 5, 35, 17, $code, $textColor);
        }
        
        return $image;
    }
    
    /**
     * Generate and store CAPTCHA in session, return image
     */
    public static function generateAndStore()
    {
        $code = self::generateCode(6);
        
        Session::put('captcha', [
            'code' => $code,
            'created_at' => time(),
            'expires_at' => time() + 300
        ]);
        
        $image = self::createImage($code);
        
        ob_start();
        imagepng($image);
        $imageData = ob_get_clean();
        imagedestroy($image);
        
        return $imageData;
    }
    
    /**
     * Validate user input against stored CAPTCHA (WITH clearing)
     * Use this for FINAL form submission
     */
    public static function validate($userInput)
    {
        $captchaData = Session::get('captcha');
        
        if (!$captchaData) {
            return false;
        }
        
        if (time() > $captchaData['expires_at']) {
            Session::forget('captcha');
            return false;
        }
        
        $isValid = strtoupper(trim($userInput)) === $captchaData['code'];
        
        // Clear CAPTCHA after successful validation (for final submission)
        if ($isValid) {
            Session::forget('captcha');
        }
        
        return $isValid;
    }
    
    /**
     * NEW METHOD: Check if CAPTCHA is valid WITHOUT clearing
     * Use this for REAL-TIME validation only
     */
    public static function check($userInput)
    {
        $captchaData = Session::get('captcha');
        
        if (!$captchaData) {
            return false;
        }
        
        if (time() > $captchaData['expires_at']) {
            return false;
        }
        
        return strtoupper(trim($userInput)) === $captchaData['code'];
    }
    
    /**
     * Refresh CAPTCHA
     */
    public static function refresh()
    {
        Session::forget('captcha');
        return self::generateAndStore();
    }
    
    /**
     * Check if CAPTCHA is expired
     */
    public static function isExpired()
    {
        $captchaData = Session::get('captcha');
        
        if (!$captchaData) {
            return true;
        }
        
        return time() > $captchaData['expires_at'];
    }
    
    /**
     * Get remaining time
     */
    public static function getRemainingTime()
    {
        $captchaData = Session::get('captcha');
        
        if (!$captchaData) {
            return 0;
        }
        
        $remaining = $captchaData['expires_at'] - time();
        return $remaining > 0 ? $remaining : 0;
    }
}