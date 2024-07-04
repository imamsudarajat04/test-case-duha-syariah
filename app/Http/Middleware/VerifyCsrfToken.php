<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'cart/add/*',             // Exclude all URIs matching /cart/add/*
        'cart/update/*',          // Exclude all URIs matching /cart/update/*
        'cart/remove/*',          // Exclude all URIs matching /cart/remove/*
        'discount/apply',         // Exclude the /discount/apply URI
    ];
}
