<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRoleEnumTOUsers extends Migration {
  public function up() {
    $this->forge->addField([
      'role' => [
        'type'       => 'ENUM',
        'constraint' => ['admin', 'user', 'guest'],
        'default'    => 'user',
        'null'       => false,
      ],
    ]);
  }

  public function down() {
    $this->forge->dropColumn('users', 'role');
  }
}
