<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseApi;
use App\Http\Controllers\Api\ResponsePackage;

class TestController extends BaseApi
{
    public function test()
    {
        $package = new ResponsePackage();

        return $package->toResponse();
    }
}
