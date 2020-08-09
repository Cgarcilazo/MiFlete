<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseApi extends Controller
{
    //API Http codes
    const HTTP_OK = 200;
    const HTTP_CREATED = 201;
    const HTTP_ACCEPTED = 202;
    const HTTP_INVALID_REQUEST = 400;
    const HTTP_AUTH_ERROR = 401;
    const HTTP_FORBIDDEN_ERROR = 403;
    const HTTP_NOT_FOUND = 404;
    const HTTP_CONFLICT = 409;
    const HTTP_VALIDATION_ERROR = 422;
    const HTTP_SERVER_ERROR = 500;
}
