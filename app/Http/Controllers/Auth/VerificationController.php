<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Verification;
use App\Models\Users;
use Illuminate\Foundation\Auth\VerifiesEmails;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function verifyEmail($token, User $user)
    {
        $verification = Verification::where('token', $token)->first();

        if ($verification) {
            // Mark the user's email as verified
            $user = User::where('email', $verification->email)->first();
            $user->email_verified_at = now();
            $user->save();

            // Delete the verification record
            $verification->delete();

            return redirect('/login')->with('success', 'Your email has been verified successfully.');
        }

        return redirect('/login')->with('error', 'Invalid verification token.');
    }
}
