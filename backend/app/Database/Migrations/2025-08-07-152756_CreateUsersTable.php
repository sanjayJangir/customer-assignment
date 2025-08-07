<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration {
  public function up() {
    $this->forge->addField([
      'id' => [
        'type'           => 'INT',
        'constraint'     => 11,
        'auto_increment' => true,
        'unsigned'       => true,
      ],
      'first_name' => [
        'type'       => 'VARCHAR',
        'constraint' => '100',
      ],
      'last_name' => [
        'type'       => 'VARCHAR',
        'constraint' => '100',
      ],
      'email' => [
        'type'       => 'VARCHAR',
        'constraint' => '255',
        'unique'     => true,
      ],
      'password' => [
        'type'       => 'VARCHAR',
        'constraint' => '255',
      ],
      'dob' => [
        'type' => 'DATE',
        'null' => true,
      ],
      'created_at' => [
        'type' => 'DATETIME',
        'null' => true,
      ],
      'updated_at' => [
        'type' => 'DATETIME',
        'null' => true,
      ],
      'deleted_at' => [
        'type' => 'DATETIME',
        'null' => true,
      ],
    ]);

    $this->forge->addKey('id', true);
    $this->forge->createTable('users');
  }

  public function down() {
    $this->forge->dropTable('users');
  }
}
