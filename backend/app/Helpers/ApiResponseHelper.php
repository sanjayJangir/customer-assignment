<?php

if (!function_exists('apiResponse')) {
  function apiResponse(bool $status, string $message, $data = null, $errors = null, int $code = 200) {
    $response = [
      'status'  => $status,
      'message' => $message,
    ];

    if ($data !== null) {
      $response['data'] = $data;
    }

    if ($errors !== null) {
      $response['errors'] = $errors;
    }

    return \CodeIgniter\Config\Services::response()
      ->setStatusCode($code)
      ->setJSON($response);
  }
}
