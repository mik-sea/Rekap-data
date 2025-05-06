<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Students_Table extends CI_Migration {

    public function up() {
        $this->dbforge->add_field([
            'id' => [
                'type'       => 'VARCHAR',
                'constraint' => 8,
                'null'       => FALSE
            ],
            'admission_track_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => FALSE
            ],
            'diploma_number' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => FALSE,
                'unique'     => TRUE
            ],
            'personal_identification_number' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => FALSE,
                'unique'     => TRUE
            ],
            'faculty_id' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
                'null'       => FALSE
            ],
            'major_id' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
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
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => FALSE
            ],
            'gender' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => FALSE
            ],
            'national_identity' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => FALSE
            ],
            'street' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => FALSE
            ],
            'house_number' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
                'null'       => FALSE
            ],
            'neighborhood_association' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
                'null'       => FALSE
            ],
            'citizen_association' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
                'null'       => FALSE
            ],
            'city' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => FALSE
            ],
            'postcode' => [
                'type'       => 'VARCHAR',
                'constraint' => 5,
                'null'       => FALSE
            ],
            'phone_number' => [
                'type'       => 'VARCHAR',
                'constraint' => 15,
                'null'       => FALSE
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
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
