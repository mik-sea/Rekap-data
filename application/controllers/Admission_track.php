<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admission_tracks extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Admission_track_model');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('session');
    }
}
