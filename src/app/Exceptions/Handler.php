<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use App\Http\Controllers\Api\BaseApi;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if (in_array('application/json', $request->getAcceptableContentTypes())) {
            $package = new ResponsePackage();

            switch (get_class($exception)) {
                case 'Illuminate\Validation\ValidationException':
                    $validationErrors = $exception->validator->errors();

                    $package->setError(BaseApi::DEFAULT_VALIDATION_ERROR, BaseApi::HTTP_INVALID_REQUEST);

                    $errors = $validationErrors->isEmpty() ? [] : $validationErrors;
                    $package->setData('errors', $errors);

                    break;

                case 'Symfony\Component\HttpKernel\Exception\NotFoundHttpException':
                    $package->setError('Service Not found', BaseApi::HTTP_NOT_FOUND);
                    $package->data = null;
                    break;

                case 'Illuminate\Auth\Access\AuthorizationException':
                    $package->setError(BaseApi::DEFAULT_AUTHORIZATION_ERROR, BaseApi::HTTP_FORBIDDEN_ERROR);
                    $package->setData('errors', ['authorization' => $exception->getMessage()]);
                    break;

                case 'Illuminate\Database\Eloquent\ModelNotFoundException':
                    $package->setError(BaseApi::DEFAULT_MODEL_QUERY_RESULT_ERROR, BaseApi::HTTP_NOT_FOUND);
                    $model = explode('\\', $exception->getModel());
                    $package->setData('errors', ['model' => $model[1]]);
                    break;

                default:
                    $status = method_exists($exception, 'getStatusCode')
                        ? $exception->getStatusCode()
                        : BaseApi::HTTP_INVALID_REQUEST;

                    $message = $exception->getMessage() ? $exception->getMessage() : BaseApi::API_GENERAL_ERROR;

                    $package->setError($message, $status);
                    $package->setStatus($status);
                    $package->setData('errors', $exception->getTrace());
            }

            return $package->toResponse();
        }

        return parent::render($request, $exception);
    }
}
