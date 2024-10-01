<?php

namespace App\Exceptions;

use Exception;
use Throwable;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserException extends Exception
{
    public function __construct($message = "Error de usuario", $code = Response::HTTP_INTERNAL_SERVER_ERROR, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function render(Request $request): JsonResponse  
    {
        if($request->isJson())
        {
            return new JsonResponse([
                'message' => $this->message
            ], $this->code);

        }
    }

}
