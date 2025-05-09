<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Students_Table extends CI_Migration {

    public function up() {
        $this->dbforge->add_field([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => TRUE
            ],
            'student_identification_number' => [
                'type'       => 'VARCHAR',
                'constraint' => 8,
                'null'       => FALSE,
                'unique'     => TRUE
            ],
            'admission_track_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => FALSE
            ],
            'faculty_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => FALSE
            ],
            'major_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => FALSE
            ],
            'location' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => FALSE
            ],
            'class' => [
                'type'       => 'VARCHAR',
                'constraint' => 5,
                'null'       => FALSE
            ],
            'profile_photo' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => FALSE
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => FALSE
            ],
            'place_of_birth' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => FALSE
            ],
            'date_of_birth' => [
                'type'       => 'DATE',
                'null'       => FALSE
            ],
            'religion' => [
                'type'       => "ENUM('Islam','Kristen Protestan','Kristen Katolik','Hindu','Buddha','Konghucu')",
                'null'       => FALSE
            ],
            'gender' => [
                'type'       => "ENUM('Laki-laki','Perempuan')",
                'null'       => FALSE
            ]
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (admission_track_id) REFERENCES admission_tracks(id)');
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (faculty_id) REFERENCES faculties(id)');
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (major_id) REFERENCES majors(id)');
        $this->dbforge->create_table('students');
    }

    public function down() {
        $this->dbforge->drop_table('students', TRUE);
    }
}
