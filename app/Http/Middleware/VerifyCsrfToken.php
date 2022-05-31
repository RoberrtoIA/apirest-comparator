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
        'http://localhost/apirest-comparator/public/compare',
        // Glass
        'http://localhost/apirest-comparator/public/store-glass',
        'http://localhost/apirest-comparator/public/update-glass',
        'http://localhost/apirest-comparator/public/delete-glass',
        // OS
        'http://localhost/apirest-comparator/public/store-os',
        'http://localhost/apirest-comparator/public/update-os',
        'http://localhost/apirest-comparator/public/delete-os',
        // CPU
        'http://localhost/apirest-comparator/public/store-cpu',
        'http://localhost/apirest-comparator/public/update-cpu',
        'http://localhost/apirest-comparator/public/delete-cpu',
        // ModelBrand
        'http://localhost/apirest-comparator/public/store-modelbrand',
        'http://localhost/apirest-comparator/public/update-modelbrand',
        'http://localhost/apirest-comparator/public/delete-modelbrand',
        // Model
        'http://localhost/apirest-comparator/public/store-model',
        'http://localhost/apirest-comparator/public/update-model',
        'http://localhost/apirest-comparator/public/delete-model',
        // Users
        'http://localhost/apirest-comparator/public/user',
        'http://localhost/apirest-comparator/public/store-user',
    ];
}
