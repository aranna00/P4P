<?php
    
    namespace App\Http\Middleware;
    
    use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
    use Closure;
    
    class SentinelGuest
    {
        /**
         * Handle an incoming request.
         *
         * @param  \Illuminate\Http\Request $request
         * @param  \Closure                 $next
         *
         * @return mixed
         */
        public function handle($request, Closure $next)
        {
            if (Sentinel::check()) {
                if ($request->ajax()) {
                    $message=$this->translate('unauthorized', 'Unauthorized');
                    
                    return response()->json(['error'=>$message], 401);
                } else {
                    return redirect('/dashboard');
                }
            }
            
            return $next($request);
        }
    }
