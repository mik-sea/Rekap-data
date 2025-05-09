<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_model extends CI_Model {
    private $_table = 'students';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function selectAll() {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->order_by('id');
        
        $query = $this->db->get();
        return $query->result();
    }

    public function insert($data) {
        $this->db->insert($this->_table, $data);
        
        $error = $this->db->error();
        if (!empty($error['message'])) {
            return FALSE;
        }

        return TRUE;
    }

    public function select($id) {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        
        if ($query->num_rows() <= 0) {
            return NULL;
        }
        
        return $query->row();
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        $this->db->update($this->_table, $data);
        
        $error = $this->db->error();
        if (!empty($error['message'])) {
            return FALSE;
        }

        return TRUE;
    }

    public function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->_table);
        
        $error = $this->db->error();
        if (!empty($error['message'])) {
            return FALSE;
        }

        return TRUE;
    }
}
