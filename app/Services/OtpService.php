<?php

namespace App\Services;

use App\Models\Yashodarshi;
use App\Models\YashodarshiOtp;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class OtpService
{
    /**
     * Send OTP to yashodarshi's email
     *
     * @param string $email
     * @return array
     */
    public function sendOtp($email)
    {
        try {
            // Find yashodarshi by email
            $yashodarshi = Yashodarshi::where('email', $email)
                ->where('status', 'active')
                ->first();

            if (!$yashodarshi) {
                return [
                    'success' => false,
                    'message' => 'Yashodarshi not found or inactive'
                ];
            }

            // Invalidate any existing unused OTPs
            YashodarshiOtp::where('yashodarshi_id', $yashodarshi->id)
                ->where('is_used', false)
                ->update(['is_used' => true]);

            // Create new OTP
            $otpRecord = YashodarshiOtp::createForYashodarshi($yashodarshi->id, 10);

            // Send OTP via email
            $this->sendOtpEmail($yashodarshi, $otpRecord->otp);

            // For testing: Log the OTP instead of sending email
            Log::info('OTP Generated for Yashodarshi', [
                'email' => $yashodarshi->email,
                'name' => $yashodarshi->name,
                'otp' => $otpRecord->otp,
                'expires_at' => $otpRecord->expires_at
            ]);

            return [
                'success' => true,
                'message' => 'OTP sent successfully to your email',
                'yashodarshi_id' => $yashodarshi->id
            ];
        } catch (\Exception $e) {
            Log::error('OTP Send Error: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Failed to send OTP. Please try again.'
            ];
        }
    }

    /**
     * Verify OTP for yashodarshi
     *
     * @param int $yashodarshiId
     * @param string $otp
     * @return array
     */
    public function verifyOtp($yashodarshiId, $otp)
    {
        try {
            $otpRecord = YashodarshiOtp::where('yashodarshi_id', $yashodarshiId)
                ->where('otp', $otp)
                ->where('is_used', false)
                ->first();

            if (!$otpRecord) {
                return [
                    'success' => false,
                    'message' => 'Invalid OTP'
                ];
            }

            if ($otpRecord->isExpired()) {
                return [
                    'success' => false,
                    'message' => 'OTP has expired'
                ];
            }

            // Mark OTP as used
            $otpRecord->markAsUsed();

            // Get yashodarshi details
            $yashodarshi = Yashodarshi::find($yashodarshiId);

            return [
                'success' => true,
                'message' => 'OTP verified successfully',
                'yashodarshi' => $yashodarshi
            ];
        } catch (\Exception $e) {
            Log::error('OTP Verify Error: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Failed to verify OTP. Please try again.'
            ];
        }
    }

    /**
     * Send OTP email to yashodarshi
     *
     * @param Yashodarshi $yashodarshi
     * @param string $otp
     * @return void
     */
    private function sendOtpEmail($yashodarshi, $otp)
    {
        $data = [
            'name' => $yashodarshi->name,
            'otp' => $otp,
            'expires_in' => '10 minutes'
        ];

        Mail::send('emails.yashodarshi-otp', $data, function ($message) use ($yashodarshi) {
            $message->to($yashodarshi->email, $yashodarshi->name)
                ->subject('Your Yashodarshi Login OTP - IrisePro');
        });
    }

    /**
     * Clean up expired OTPs
     *
     * @return int Number of cleaned records
     */
    public function cleanupExpiredOtps()
    {
        return YashodarshiOtp::where('expires_at', '<', now())
            ->orWhere('is_used', true)
            ->delete();
    }
}
