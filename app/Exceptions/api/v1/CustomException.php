<?php

namespace App\Exceptions\api\v1;

use Exception;

class CustomException extends Exception
{
    protected $message;
    protected $code;

    public function __construct($message, $code)
    {
        $this->message = $message;
        $this->code = $code;
    }

    /**
     * Report the exception.
     *
     * @return bool|null
     */
    public function report()
    {
        //
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render()
    {
        $data = [
            'status_code' => $this->code,
            'message' => $this->message
        ];

        return response()->json($data, $this->code);
    }
}
