<?php

namespace App\Exceptions;

use Exception;

class GuzzleException extends Exception
{
    /**
     * Report the exception.
     *
     * @return void
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
    public function render($request)
    {
        header('Content-Type: application/json');
        return response()->json([
            'error' => 'Guzzle HTTP Exception',
            'message' => $request->getMessage(),
        ], 500);
    }
}
