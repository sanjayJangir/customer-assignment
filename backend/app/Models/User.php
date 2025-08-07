<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model {
  protected $table      = 'users';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;
  protected $returnType       = 'array';

  protected $useSoftDeletes   = true;

  protected $allowedFields = [
    'first_name',
    'last_name',
    'email',
    'password',
    'dob',
    'created_at',
    'updated_at',
    'deleted_at'
  ];

  protected $useTimestamps = true;
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
  protected $deletedField  = 'deleted_at';
}
