<?php

namespace Damoon\Blog\Http\Middleware;

use Closure;
use Damoon\Blog\Http\Middleware\Interfaces\IAdminUser;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AuthAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if($user instanceof IAdminUser){
            if($user->is_admin())
                return $next($request);
            throw new NotFoundHttpException('صفحه یافت نشد'); // not found page exception set because we don't want to users know about admin pages
        }
        throw new \InvalidArgumentException('user model must implements [\'IAdminUser\'] interface', 500);
    }
}
