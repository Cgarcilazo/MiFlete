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

    //API generic errors strings
    const DEFAULT_VALIDATION_ERROR = 'Validation error';
    const DEFAULT_AUTHORIZATION_ERROR = 'This action is unauthorized';
    const DEFAULT_MODEL_QUERY_RESULT_ERROR = 'No query results for model';
    const RESET_LINK_SENT = 'Token Sent';
    const PASSWORD_RESET_INVALID_USER = 'Reset password email is not valid';
    const PASSWORD_RESET_INVALID_TOKEN = 'Reset password token is not valid';
    const PASSWORD_RESET_TOKEN_EXPIRED = 'Reset password token is expired';
    const REWARD_DELETED_OR_NOT_AVAILABLE = 'Reward deleted or not available';
    const API_GENERAL_ERROR = 'General Error';
    const API_INVALID_REQUEST = 'Invalid request';
    const USER_UNAUTHORIZED = 'User unauthorized';
    const TOKEN_UNABLE_TO_REFRESH = 'Unable to refresh token';
    const RESET_PASSWORD_TOKEN_EXPIRED = 'This link has been already used to reset a password';
    const VERATAD_AGE_VALIDATION_FAILED = 'Call support for age validation';
    const FTC_AGE_VERIFICATION_MESSAGE = "Sorry, but registration could not be processed at this time.";

    /**
     * Returns authenticated account.
     *
     * @return mixed
     */
    public function user()
    {
        return auth('api')->user();
    }
}
