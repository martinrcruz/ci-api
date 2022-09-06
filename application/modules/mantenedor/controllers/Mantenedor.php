<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mantenedor extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('mantenedor_model');
        $this->load->library(['ion_auth', 'form_validation']);

        date_default_timezone_set('America/Santiago');
    }






}
