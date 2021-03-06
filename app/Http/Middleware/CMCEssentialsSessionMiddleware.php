<?php

namespace CmcEssentials\Http\Middleware;

use Closure;
/**
* Session management middleware for the web app. 
* This middleware provides check for session login and is applied to all routes that routes that require session login.
*/
class CMCEssentialsSessionMiddleware
{
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        if($this->issetUsername($request)){
            return $next($request);
        }else{
            return redirect()->route('sessionLogin');
        }
    }
    
    /**
     * Check if username is set for this session. If not redirect to session login page. 
     * Returns boolean. true if username is set and false otherwise. 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return boolean
     */
    private function issetUsername($request){
        $sessionData = json_decode($request->cookie('CmcESession'), true);
        if(!empty($sessionData) && !empty($sessionData['username'])){
            return true;
        }elseif( !empty($request->get('username'))){
            return true;
        }
        return false;
    }
}
