<?php

namespace App\Exceptions;

use Exception;
use Throwable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class UserException extends Exception
{
    public function __construct(string $message = '', int $code = Response::HTTP_NOT_ACCEPTABLE, ?Throwable $previous = null)
    {

        parent::__construct($message, $code, $previous);
    }


    public function render(Request $request): JsonResponse
    {
        return new JsonResponse(
            [
                'error' => 'UserNotFound',
                'message' => $this->message
            ],
            $this->code
        );
    }
}
