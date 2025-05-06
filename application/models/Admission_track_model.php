<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admission_track_model extends CI_Model {
    private $_table = 'admission_tracks';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getAdmissionTracks() {
        $this->db->select('*');
        $this->db->from($this->_table);
        
        $query = $this->db->get();
        return $query->result();
    }

    public function createAdmissionTrack($data) {
        $this->db->insert($this->_table, $data);
        
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        }
        
        return FALSE;
    }

    public function getAdmissionTrackById($id) {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        
        return NULL;
    }

    public function updateAdmissionTrack($id, $data) {
        $this->db->where('id', $id);
        $this->db->update($this->_table, $data);
        
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }

    public function deleteAdmissionTrack($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->_table);
        
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }
}
