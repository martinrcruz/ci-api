<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Actividad extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('actividad_model');

        date_default_timezone_set('America/Santiago');
    }

    public function index()
    {
        $data['datalibrary'] = array(
            'titulo' => "Actividad",
            'vista' => array('index', 'modals'),
            'libjs' => array('libjs'),
            'active' => 'actividad'
        );
        $this->load->view('estructura/body', $data);
    }




}
