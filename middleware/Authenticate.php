<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Auth\AuthenticationException;

class Authenticate extends Middleware
{
    protected $guard;
    
    /**
     * Handle an unauthenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $guards
     * @return void
     *
     * @throws \Illuminate\Auth\AuthenticationException
    **/
    protected function unauthenticated($request, array $guards)
    {
        $this->guard = $guards[0];
        throw new AuthenticationException(
            'Unauthenticated.', $guards, $this->redirectTo($request)
        );
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            switch ($this->guard) {
                case 'customer':
                    $login = 'customer.login';
                    break;
                default:
                    $login = 'login';
                    break;
            }
            return route($login);
        }else{
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
    }
}
