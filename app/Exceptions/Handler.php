<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {

//        $this->reportable(function (Throwable $e) {
//            //
//        });

//        $this->renderable(function (\Exception $e){
//
//            return response()->json([
//                'message' => $e->getMessage()
//            ],401);
//        });
    }

    public function render($request, Throwable $e)
    {
        if ($request->is("api/*")) {
            return response()->json(["message" => $e->getMessage()], $e->getCode());
        } elseif ($request instanceof Request && $request->expectsJson()) {
            return response()->json(["message" => $e->getMessage()], $e->getCode());
        } else {
            return parent::render($request, $e);
        }
    }
}
