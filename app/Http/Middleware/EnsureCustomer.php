<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EnsureCustomer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->exists('token')) {
            return redirect('/');
        } else {
            $validate = Http::withHeaders([
                'Authorization' => 'Bearer ' . $request->session()->get('token')
            ])
            ->post(config('app.wp_api_auth') . 'token/validate')
            ->status();

            if ($validate == 200)
                return $next($request);
            else
                return redirect('/');
        }
    }
}
