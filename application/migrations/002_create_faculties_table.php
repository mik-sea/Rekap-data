<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Faculties_Table extends CI_Migration {

    public function up() {
        $this->dbforge->add_field([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => TRUE
            ],
            'code' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
                'null'       => FALSE,
                'unique'     => TRUE
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => FALSE,
                'unique'     => TRUE
            ]
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('faculties');
    }

    public function down() {
        $this->dbforge->drop_table('faculties', TRUE);
    }
}
