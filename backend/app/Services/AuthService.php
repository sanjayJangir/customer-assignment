<?php

namespace App\Services;

class AuthService {
  private static $user = null;

  public static function setUser(array $user) {
    self::$user = $user;
  }

  public static function getUser() {
    return self::$user;
  }
}
