<?php
namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    public function render($request, Exception $e)
    {
      // return parent::render($request, $e);
        if ($this->isHttpException($e)) {
        switch ($e->getStatusCode()) {
            // not authorized
            case '403':
                return response()->json(['error' => 'UnAuthorized'], 403);
                break;
            // not found
            case '404':
                return response()->json(['error' => 'Endpoint Not Found'], 404);
                break;
            // internal error
            case '500':
                return response()->json(['error' => 'Internal Error'], 500);
                break;
            default:
                return $this->renderHttpException($e);
                break;
        }
      }
        return response()->json(['error' => 'Unexpected Error'], 500);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest(route('login'));
    }
}
 ?>
