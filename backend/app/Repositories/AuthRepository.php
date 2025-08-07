<?php

namespace App\Repositories;

use App\Interfaces\AuthInterface;
use App\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;

class AuthRepository implements AuthInterface {
  protected $userModel;
  protected $key;

  public function __construct() {
    $this->userModel = new User();
    $this->key = getenv('JWT_SECRET');
  }

  public function register(array $data) {
    try {
      $user = $this->userModel->where('email', $data['email'])->first();

      if ($user) {
        throw new Exception("Email already registered");
      }
      $data['dob'] = $data['date_of_birth'] ?? null;  // Handle date of birth if provided
      unset($data['date_of_birth']); // Remove date_of_birth from data array
      $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

      $this->userModel->insert($data);
      return $data;
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }

  public function login(array $credentials) {
    try {
      $user = $this->userModel->where('email', $credentials['email'])->first();
      if (!$user || !password_verify($credentials['password'], $user['password'])) {
        throw new Exception("Invalid credentials");
      }

      $payload = [
        'sub' => $user['id'],
        'email' => $user['email'],
        'iat' => time(),
        'exp' => time() + 3600
      ];

      $token = JWT::encode($payload, $this->key, 'HS256');
      return ['token' => $token];
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }
}
