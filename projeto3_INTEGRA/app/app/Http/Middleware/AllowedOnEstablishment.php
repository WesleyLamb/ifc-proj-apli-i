<?php

namespace App\Http\Middleware;

use App\Exceptions\InvalidCallException;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AllowedOnEstablishment
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $ability)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$request->route('establishment_id'))
            throw new InvalidCallException('Can\'t call this middleware without the {establishment_id} route param!');
        if (!$user->canOnEstablishment($request->route('establishment_id'), $ability))
            abort(403);

        return $next($request);
    }
}
