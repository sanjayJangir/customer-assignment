<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Repositories\AuthRepository;
use CodeIgniter\API\ResponseTrait;
use Exception;

class AuthController extends ResourceController {
  use ResponseTrait;

  protected $authRepo;

  public function __construct() {
    $this->authRepo = new AuthRepository();
  }

  public function register() {
    try {
      $data = $this->request->getPost() ?? $this->request->getJSON(true);


      if (!is_array($data)) {
        return $this->failValidationErrors("Invalid input format. Expecting JSON or POST data.");
      }

      $rules = [
        'first_name'       => 'required|min_length[2]',
        'last_name'        => 'required|min_length[2]',
        'email'            => 'required|valid_email|is_unique[users.email]',
        'password'         => 'required|min_length[6]',
        'confirm_password' => 'required|matches[password]',
        'date_of_birth'    => 'required|valid_date[Y-m-d]',
        'role'    => 'required',
      ];

      if (!$this->validate($rules)) {
        return $this->failValidationErrors($this->validator->getErrors());
      }

      $response = $this->authRepo->register($data);

      $response = [
        'status'  => 200,
        'message' => "users registered successfully",
        'data'    =>  $response ?? [],
      ];
      return $this->respond($response, 200);
    } catch (Exception $e) {
      $response = [
        'status'  => 401,
        'message' => $e->getMessage(),
        'data'    => [],
      ];
      return $this->respond($response, 401);
    }
  }

  public function login() {
    try {
      $data =  $this->request->getPost() ?? $this->request->getJSON(true);

      if (!is_array($data)) {
        return $this->failValidationErrors("Invalid input format. Expecting JSON or POST data.");
      }

      $rules = [
        'email'    => 'required|valid_email',
        'password' => 'required',
      ];

      if (!$this->validate($rules)) {
        return $this->failValidationErrors($this->validator->getErrors());
      }

      $response = $this->authRepo->login($data);

      $response = [
        'status'  => 200,
        'message' => "Login successful",
        'data'    =>  $response ?? [],
      ];
      return $this->respond($response, 200);
    } catch (Exception $e) {

      $response = [
        'status'  => 401,
        'message' => $e->getMessage(),
        'data'    => [],
      ];
      return $this->respond($response, 401);
    }
  }
}
