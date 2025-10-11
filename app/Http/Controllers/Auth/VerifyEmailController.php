<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session; // <-- PASTI ADA

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
     public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        $successUrl = '/email/verified'; 

        if ($request->user()->hasVerifiedEmail()) {
            // Karena sudah terverifikasi, kita tetap arahkan ke sukses,
            return redirect()->to($successUrl); 
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
            
            Session::flash('verification_success_token', true); 
        }
        
        Session::forget('url.intended');

        return redirect()->to($successUrl);
    }
}