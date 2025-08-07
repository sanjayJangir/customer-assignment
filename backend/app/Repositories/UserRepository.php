<?php

namespace App\Repositories;

use App\Interfaces\UserInterface;
use App\Models\User;
use Exception;

class UserRepository implements UserInterface {
  protected $model;

  public function __construct() {
    $this->model = new User();
  }

  public function all() {
    $users = $this->model->findAll();

    return array_map(function ($user) {
      unset($user['password'], $user['deleted_at']);
      return $user;
    }, $users);
  }

  public function find($id) {
    return $this->model->find($id);
  }

  public function create(array $data) {
    try {
      $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

      return $this->model->insert($data);
    } catch (Exception $e) {
      throw new Exception('Failed to create user: ' . $e->getMessage());
    }
  }

  public function update($id, array $data) {
    try {
      return $this->model->update($id, $data);
    } catch (Exception $e) {
      throw new Exception('Failed to update user: ' . $e->getMessage());
    }
  }

  public function delete($id) {
    try {
      return $this->model->delete($id);
    } catch (Exception $e) {
      throw new Exception('Failed to delete user: ' . $e->getMessage());
    }
  }

  public function allExcept($currentUserId) {
    $users = $this->model
      ->where('id !=', $currentUserId)
      ->findAll();

    return array_map(function ($user) {
      unset($user['password'], $user['deleted_at']);
      return $user;
    }, $users);
  }
}
