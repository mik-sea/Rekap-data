<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Admission_Tracks_Table extends CI_Migration {

    public function up() {
        $this->dbforge->add_field([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => TRUE
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => FALSE,
                'unique'     => TRUE
            ]
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('admission_tracks');
    }

    public function down() {
        $this->dbforge->drop_table('admission_tracks', TRUE);
    }
}
