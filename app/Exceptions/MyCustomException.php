<?php

namespace App\Exceptions;

use App\Models\Product;
use Exception;

class MyCustomException extends Exception
{

    /**
     * Render the exception as an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
        public function render($request)
        {
            return 5;
        }

//    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
//    {
//        parent::__construct($message, $code, $previous);
//    }
}
