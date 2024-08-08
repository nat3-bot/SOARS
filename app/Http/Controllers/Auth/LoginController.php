<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    protected function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Check for reCAPTCHA if login attempts are greater than or equal to 3
        $loginAttempts = session('login_attempts', 0);
        if ($loginAttempts >= 3) {
            $validator = Validator::make($request->all(), [
                'g-recaptcha-response' => 'required|captcha'
            ]);

            if ($validator->fails()) {
                return redirect('/error?credential=404')
                    ->withErrors(['g-recaptcha-response' => 'Incorrect reCAPTCHA response. Please try again.'])
                    ->withInput();
            }
        }

        // Attempt to authenticate user
        if (Auth::attempt($credentials, $request->has('remember'))) {
            $user = Auth::user();

            // Check if the user's email is verified
            if ($user->email_verified_at !== null) {
                session(['login_attempts' => 0]);

                // Redirect based on user role
                switch ($user->role) {
                    case 1:
                        return redirect('/admin');
                    case 2:
                        return redirect('/osaemp');
                    case 3:
                        return redirect('/student');
                    default:
                        Auth::logout();
                        return redirect('/error?credential=404')->with('error', 'Something went wrong. Try again.');
                }
            } else {
                session(['login_attempts' => 0]);
                return redirect('/verifying_email');
            }
        } else {
            // Increment login attempts if authentication fails
            session(['login_attempts' => $loginAttempts + 1]);
            return redirect('/error?credential=404')->with('error', 'Incorrect email or password.');
        }

        
    }



    public function create() {
        return view('create_user');
    }
    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'g-recaptcha-response' => 'required|captcha',
        ]);
        User::create($request->all());
        return "Successfully created!";
    }

    public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
}

}
