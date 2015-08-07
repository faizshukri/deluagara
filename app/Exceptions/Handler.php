<?php

namespace Katsitu\Exceptions;

use Exception;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Debug\ExceptionHandler as SymfonyDisplayer;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if( app()->environment('local') || config('app.debug') ) {

            // Make all exception except 503 turn into stack trace
            if($this->isHttpException($e) && $e->getStatusCode() == 503)
                return parent::render($request, $e); // Default handler

            // Response stack trace
            return (new SymfonyDisplayer(config('app.debug')))->createResponse($e);
        }

        // If not http exception, return error page from view
        if(!$this->isHttpException($e)) {
            return response()->view('errors.500', [], 500);
        }

        // Default handler
        return parent::render($request, $e);
    }
}
