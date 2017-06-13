<?php
    
    namespace App\Http\Controllers\Auth;
    
    use App\Http\Controllers\Controller;
    use App\User;
    use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
    use Illuminate\Foundation\Auth\AuthenticatesUsers;
    use Illuminate\Http\Request;
    
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
        protected $redirectTo='/';
        
        /**
         * Create a new controller instance.
         *
         * @return void
         */
        public function __construct()
        {
            $this->middleware('guest')->except('logout');
        }
        
        /**
         * Show the application's login form.
         *
         * @return \Illuminate\Http\RedirectResponse
         */
        public function showLoginForm()
        {
            if (Sentinel::check() instanceof User) {
                return redirect("/");
            }
            
            return view('auth.login');
        }
        
        /**
         * Handle a login request to the application.
         *
         * @param  \Illuminate\Http\Request $request
         *
         * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
         */
        public function login(Request $request)
        {
            $this->validateLogin($request);
            $tryLogin=$this->attemptLogin($request);
            if ($tryLogin INSTANCEOF User) {
                return $this->sendLoginResponse($request);
            }
            
            // If the login attempt was unsuccessful we will increment the number of attempts
            // to login and redirect the user back to the login form. Of course, when this
            // user surpasses their maximum number of attempts they will get locked out.
//            $this->incrementLoginAttempts($request);
            
            return $this->sendFailedLoginResponse($request);
        }
        
        /**
         * Get the failed login response instance.
         *
         * @param  \Illuminate\Http\Request $request
         *
         * @return \Illuminate\Http\RedirectResponse
         */
        protected function sendFailedLoginResponse(Request $request)
        {
            $errors=[$this->username()=>trans('auth.failed')];
            
            if ($request->expectsJson()) {
                return response()->json($errors, 422);
            }
            
            return redirect()->back()
                             ->withInput($request->only($this->username(), 'remember'))
                             ->withErrors($errors);
        }
        
        /**
         * Validate the user login request.
         *
         * @param  \Illuminate\Http\Request $request
         *
         * @return void
         */
        protected function validateLogin(Request $request)
        {
            $this->validate($request, [
                $this->username()=>'required|string',
                'password'       =>'required|string',
            ]);
        }
        
        /**
         * Attempt to log the user into the application.
         *
         * @param  \Illuminate\Http\Request $request
         *
         * @return bool
         */
        protected function attemptLogin(Request $request)
        {
            return Sentinel::authenticate([
                "email"   =>$request->get("email"),
                "password"=>$request->get("password")
            ],
                $request->get("remember") == "on" ? true : false
            );
        }
        
        /**
         * Get the needed authorization credentials from the request.
         *
         * @param  \Illuminate\Http\Request $request
         *
         * @return array
         */
        protected function credentials(Request $request)
        {
            return $request->only($this->username(), 'password');
        }
        
        /**
         * Send the response after the user was authenticated.
         *
         * @param  \Illuminate\Http\Request $request
         *
         * @return \Illuminate\Http\Response
         */
        protected function sendLoginResponse(Request $request)
        {
            $request->session()->regenerate();

//            $this->clearLoginAttempts($request);
            
            return $this->authenticated($request, Sentinel::check())
                ?: redirect()->intended($this->redirectPath());
        }
        
        /**
         * The user has been authenticated.
         *
         * @param  \Illuminate\Http\Request $request
         * @param  mixed                    $user
         *
         * @return mixed
         */
        protected function authenticated(Request $request, $user)
        {
            //
        }
        
        /**
         * Log the user out of the application.
         *
         * @param  \Illuminate\Http\Request $request
         *
         * @return \Illuminate\Http\Response
         */
        public function logout(Request $request)
        {
            Sentinel::logout();
            
            $request->session()->flush();
            
            $request->session()->regenerate();
            
            return redirect('/');
        }
    }
