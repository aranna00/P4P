<?php
    
    namespace App\Http\Middleware;

    use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
    use Closure;

    class SentinelUserInRole
    {
        /**
         * Handle an incoming request.
         *
         * @param  \Illuminate\Http\Request $request
         * @param  \Closure                 $next
         *
         * @return mixed
         */
        public function handle($request, Closure $next, $role)
        {
            if (!Sentinel::check()) {
                return $this->denied($request);
            }
            if (!Sentinel::inRole($role)) {
                return $this->denied($request);
            }
    
            return $next($request);
        }
    
        public function denied($request)
        {
            if ($request->ajax()) {
                $message=trans('auth.unauthorized', 'Unauthorized');
    
                return response()->json(['error'=>$message], 401);
            } else {
                $message=trans("auth.need_permission");
                session()->flash('error', $message);
    
                return redirect()->back();
            }
        }
    }
