<?php

namespace App\Helpers;

class ResponseHelper 
{
  /**
   * @param $success
   * @param $message
   * @param $data
   */
  public function loginSuccess($success, $message, $data)
  {
    return response()->json([
      'success' => $success,
      'message' => $message,
      'data' => $data
    ]);
  }

  /**
   * @param $success
   * @param $message
   * @param $data
   */
  public function successResponse($success, $message, $data)
  {
    return response()->json([
      'data' => [
        'success' => $success,
        'message' => $message,
        'data' => $data
      ]
    ]);
  }
  
  /**
   * @param $success
   * @param $message
   * @param $data
   * @param $errorCode
   */
  public function errorResponse($error, $message, $data, $errorCode)
  {
    return response()->json([
      'data' => [
        'success' => $error,
        'message' => $message,
        'data' => $data
      ]
    ], $errorCode);
  }
}
