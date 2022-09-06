<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('home_model');
        $this->load->library(['ion_auth', 'form_validation']);

        date_default_timezone_set('America/Santiago');
    }




    public function getIndicadores(){
      $request = new stdClass();
      $request->id = null;
      $request->data = [];

      $fecha = date('Y-m-d H:i:s');

      $response = new stdClass();
      $response->id = null;
      $response->data = [];
      $response->proceso = 0;
      $response->errores = [];

      if ($res = $this->home_model->getIndicadores()) {
          foreach ($res->result() as $r) {
              $row = new stdClass();
              $indicador_ot = $r->ORDEN_TRABAJO;
              $indicador_cotizacion = $r->COTIZACION;
              $indicador_clientes = $r->CLIENTES;
              
              $indicador_activo = $r->SERVICIOS_ACTIVOS;
              $indicador_pendiente = $r->SERVICIOS_PENDIENTES;
              $indicador_completado = $r->SERVICIOS_COMPLETADOS;


          }
          $response->proceso = 1;
      }
      echo json_encode($id_cotizacion);
    }

}
