<?php

namespace App\Controllers\Api;


use App\Services\AuthService;
use App\Repositories\UserRepository;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use Exception;



class UserController extends ResourceController {
  use ResponseTrait;

  protected $repo;
  protected $user_id;

  public function __construct() {
    $this->repo = new UserRepository();
    $this->user_id = AuthService::getUser()['sub'] ?? null; // Get user ID from AuthService
  }

  public function index() {
    try {
      $users = $this->repo->allExcept($this->user_id);
      // Debugging line to check user_id
      $response = [
        'status'  => 200,
        'message' => "users retrieved successfully",
        'data'    => $users,
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

  public function show($id = null) {
    try {
      $user = $this->repo->find($id);
      if (!$user) {
        return $this->failNotFound("User not found");
      }
      return $this->respond($user);
    } catch (Exception $e) {
      return $this->failServerError($e->getMessage());
    }
  }

  public function create() {
    try {
      $data = $this->request->getJSON(true) ?? $this->request->getPost();

      // validate here...

      $this->repo->create($data);
      return $this->respondCreated(['message' => 'User created successfully']);
    } catch (Exception $e) {
      return $this->failServerError($e->getMessage());
    }
  }

  public function update($id = null) {
    try {
      $data = $this->request->getJSON(true);
      $this->repo->update($id, $data);
      return $this->respond(['message' => 'User updated successfully']);
    } catch (Exception $e) {
      return $this->failServerError($e->getMessage());
    }
  }

  public function delete($id = null) {
    try {
      $this->repo->delete($id);
      return $this->respondDeleted(['message' => 'User deleted successfully']);
    } catch (Exception $e) {
      return $this->failServerError($e->getMessage());
    }
  }
}
