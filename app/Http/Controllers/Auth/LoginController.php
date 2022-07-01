<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;
use App\AddUser;
use Illuminate\Support\Facades\Hash;
use Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;


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

    protected $homeUrl = RouteServiceProvider::HOME;
    protected $backendDashboardUrl = RouteServiceProvider::BACKEND_DASHBOARD;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectTo()
    {
        session()->flash('successAlert', 'Logged in successfully !!');
        return Auth::user()->hasAnyRole(['super-admin', 'admin'])
            ? $this->backendDashboardUrl
            : $this->homeUrl;
    }

    protected function validateLogin(Request $request)
    {
        $request->validateWithBag('login', [
            $this->username() => 'required|string',
            'password' => 'required|string',
            // 'g-recaptcha-response' => 'recaptcha',
        ]);
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');
        $credentials['status'] = 1;

        return $credentials;
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        $socialUser = Socialite::driver($provider)->user();

        $user = User::where(['email' => $socialUser->getEmail()])->first();

        if (!$user) {
            DB::beginTransaction();
            try {
                $user = User::create([
                    'name'          => $socialUser->getName(),
                    'email'         => $socialUser->getEmail(),
                    'email_verified_at' => now(),
                    'avatar'         => $socialUser->getAvatar(),
                    'provider_id'   => $socialUser->getId(),
                    'provider'      => $provider,
                ]);

                DB::commit();
                event(new Registered($user));
            } catch (\Throwable $th) {
                DB::rollBack();
                report($th);
                return redirect()->route('login')->with('unknown', 'An error occured while registering user');
            }
        }

        Auth::login($user, true);

        return $this->sendLoginResponse(request());
    }

    // Solve the redirection issue
    // Redirect user to /login after unsuccessful login
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
          
            ])->redirectTo('/login');
        }
    //     if (Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
    //         $request->session()->regenerateToken();
    //         return redirect("/dashboard");
        
    //     }
    //     return back()->withErrors(['failed'=>"invalid username and psw"]);
    // }
        


        // $attempts = session()->get('login.attempts', 0); // get attempts, default: 0
        // session()->put('login.attempts', $attempts + 1); // increase attempts
    
    // }
    // protected function authenticated(Request $request, $user)
    // {
    //     session()->forget('login.attempts'); // clear attempts
    // }
}

