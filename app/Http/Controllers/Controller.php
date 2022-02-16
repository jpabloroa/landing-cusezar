<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function log($message = '')
    {
        Log::debug("¡ Error ! - " . $message);
        return new RedirectResponse("https://www.cusezar.com");
    }

    public function __call($method, $parameters)
    {
        return response(json_encode(["client_id" => Auth::user()->id, "error" => 'Method ' . $method . ' not supported']));
    }
}
