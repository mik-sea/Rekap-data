<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faculty extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Faculty_model');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('session');
    }
}
