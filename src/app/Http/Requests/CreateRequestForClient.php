<?php

namespace App\Http\Requests;

use App\AppRequest;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequestForClient extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return AppRequest::$creationRules;
    }
}
