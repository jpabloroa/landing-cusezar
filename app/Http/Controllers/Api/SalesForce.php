<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalesForce extends Controller
{
    public function __construct(Request $request, $version = 'v1')
    {
        $controller = $this->{$version}();
        return call_user_func($controller->{}, $request);
    }

    public function __call($method, $parameters)
    {
        return parent::__call($method, $parameters);
    }
}
