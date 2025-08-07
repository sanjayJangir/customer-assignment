<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Cors implements FilterInterface {
  public function before(RequestInterface $request, $arguments = null) {
    // CORS headers
    header('Access-Control-Allow-Origin: *'); // or restrict to: http://localhost:3000
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
    header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization');

    // Handle preflight
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
      header('HTTP/1.1 200 OK');
      exit;
    }
  }

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {
    return $response;
  }
}
