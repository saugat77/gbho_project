<?php

namespace App\Http\Middleware;

use Closure;
use Jenssegers\Agent\Agent;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class DetectMobile
{
    protected $agent;

    public function __construct(Agent $agent)
    {
        $this->agent = $agent;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($this->agent->isMobile() || $this->agent->isTablet()) {
            $request->session()->put('mobile', true);
        } else {
            $request->session()->put('mobile', false);
        }

        $response = $next($request);
        return $response->setVary('User-Agent');
    }
}
