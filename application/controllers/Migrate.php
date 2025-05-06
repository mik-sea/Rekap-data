<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('migration');
        
        if (!$this->input->is_cli_request() && ENVIRONMENT !== 'development') {
            show_error('Migration can only be accessed via CLI or in development environment');
        }
    }

    public function index() {
        if ($this->migration->current() === FALSE) {
            show_error($this->migration->error_string());
        } else {
            echo "All migrations have been run successfully.";
        }
    }

    public function version($version) {
        if ($this->migration->version($version) === FALSE) {
            show_error($this->migration->error_string());
        } else {
            echo "Migrations have been run successfully up to version " . $version;
        }
    }

    public function reset() {
        if ($this->migration->version(0) === FALSE) {
            show_error($this->migration->error_string());
        } else {
            echo "All migrations have been reset.";
        }
    }
}
