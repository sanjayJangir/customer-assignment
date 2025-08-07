<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;
use App\Services\AuthService;


class JWTAuthFilter implements FilterInterface {
  public function before(RequestInterface $request, $arguments = null) {
    $key = getenv('JWT_SECRET');
    $authHeader = $request->getHeaderLine('Authorization');

    if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
      return service('response')->setJSON(['message' => 'Token missing'])->setStatusCode(401);
    }

    $token = str_replace('Bearer ', '', $authHeader);

    try {
      $decoded = JWT::decode($token, new Key($key, 'HS256'));

      // Set decoded user info globally
      $request = service('request'); // get instance
      $request->setGlobal('auth_user', (array) $decoded);
      AuthService::setUser((array) $decoded);
    } catch (Exception $e) {
      return service('response')->setJSON(['message' => 'Invalid token'])->setStatusCode(401);
    }
  }

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {
    // Do nothing
  }
}
