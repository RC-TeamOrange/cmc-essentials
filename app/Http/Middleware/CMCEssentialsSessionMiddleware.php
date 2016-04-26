<?php

namespace CmcEssentials\Http\Middleware;

use Closure;

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
