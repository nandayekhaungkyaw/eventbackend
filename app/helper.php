<?php

if(!function_exists('apiResponse')){
    function apiResponse($data = null, $message = 'NO data here'){
    $statusCode= $data ? 200 :404;

    return response()->json([
        'data' => $data,
        'message' => $message,
        'statusCode' => $statusCode,
    ], $statusCode);

}
}
