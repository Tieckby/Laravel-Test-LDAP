<?php

namespace App\Http\Middleware;

use App\Exceptions\api\v1\CustomException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Handle an unauthenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $guards
     * @return void
     *
     * @throws App\Exceptions\api\v1\CustomException
     */
    protected function unauthenticated($request, array $guards)
    {
        throw new CustomException(config('constant_values.unauthenticatedMsg'), 403);
    }
}
