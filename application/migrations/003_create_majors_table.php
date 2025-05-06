<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Majors_Table extends CI_Migration {

    public function up() {
        $this->dbforge->add_field([
            'id' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
                'null'       => FALSE
            ],
            'faculty_id' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
                'null'       => FALSE
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => FALSE,
                'unique'     => TRUE
            ]
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (faculty_id) REFERENCES faculties(id)');
        $this->dbforge->create_table('majors');
    }

    public function down() {
        $this->dbforge->drop_table('majors', TRUE);
    }
}
