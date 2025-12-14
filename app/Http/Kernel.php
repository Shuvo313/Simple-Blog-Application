<?php
namespace App\Http;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
class Kernel extends HttpKernel
{
    protected $routeMiddleware = [
        // ...
        'auth.session' => \App\Http\Middleware\AuthSessionMiddleware::class,
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
    ];
}
