<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reporte_detalle extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('reporte_detalle_model');
        $this->load->library(['ion_auth', 'form_validation']);

        date_default_timezone_set('America/Santiago');
    }

    public function getLastId()
    {
        $request = new stdClass();
        $request->id = null;
        $request->data = [];

        $fecha = date('Y-m-d H:i:s');

        //DECLARACION DE VARIABLES, OBJETOS Y ARRAYS DE [RESPUESTA]
        $response = new stdClass();
        $response->id = null;
        $response->data = [];
        $response->proceso = 0;
        $response->errores = [];
        if ($res = $this->reporte_detalle_model->getLastId()) {
            foreach ($res->result() as $r) {
                $row = new stdClass();
                $id_reporte_detalle = $r->LAST_ID;
            }
            $response->proceso = 1;
        }
        echo json_encode($id_reporte_detalle);
    }

    public function getReporteDetalle()
    {
        if (true) {
            //DECLARACION DE VARIABLES, OBJETOS Y ARRAYS DE [PETICION]
            $request = new stdClass();
            $request->id = null;
            $request->data = [];

            $fecha = date('Y-m-d H:i:s');

            //DECLARACION DE VARIABLES, OBJETOS Y ARRAYS DE [RESPUESTA]
            $response = new stdClass();
            $response->id = null;
            $response->data = [];
            $response->proceso = 0;
            $response->errores = [];

            if (sizeof($response->errores) == 0) {
                if ($query = $this->reporte_detalle_model->getReporteDetalle()) {
                    foreach ($query->result() as $res) {
                        $row = null;
                        $row = new stdClass();
                        $row->id_reporte_detalle = $res->ID_REPORTE_DETALLE;
                        $row->cliente_envia_1 = $res->CLIENTE_ENVIA_1;
                        $row->id_trabajador_1 = $res->ID_TRABAJADOR_1;
                        $row->propuesta_2 = $res->PROPUESTA_2;
                        $row->id_trabajador_2 = $res->ID_TRABAJADOR_2;
                        $row->cliente_aprueba_3 = $res->CLIENTE_APRUEBA_3;
                        $row->id_trabajador_3 = $res->ID_TRABAJADOR_3;
                        $row->realiza_4 = $res->REALIZA_4;
                        $row->id_trabajador_4 = $res->ID_TRABAJADOR_4;
                        $row->problema_5 = $res->PROBLEMA_5;
                        $row->id_trabajador_5 = $res->ID_TRABAJADOR_5;


                        array_push($response->data, $row);
                    }
                    $response->proceso = 1;
                }
            }
            echo json_encode($response);
        } else {
            redirect('auth/login', 'refresh');
        }
    }



    // public function getReporteDetalleTabla()
    // {
    //     if (true) {
    //         //DECLARACION DE VARIABLES, OBJETOS Y ARRAYS DE [PETICION]
    //         $request = new stdClass();
    //         $request->id = null;
    //         $request->data = [];

    //         $fecha = date('Y-m-d H:i:s');

    //         //DECLARACION DE VARIABLES, OBJETOS Y ARRAYS DE [RESPUESTA]
    //         $response = new stdClass();
    //         $response->id = null;
    //         $response->data = [];
    //         $response->proceso = 0;
    //         $response->errores = [];


    //         if ($this->input->post('id_cliente')) {
    //             $request->id = $this->security->xss_clean($this->input->post('id_cliente'));
    //         } else { //SI NO, ALMACENAMOS EL ERROR EN UN ARRAY PARA DEVOLVERLO COMO RESPUESTA.
    //             $response->errores[] = "Ocurrió un problema al obtener la solicitud";
    //         }

    //         $request->id ? $where = " AND id_cliente=$request->id" : $where = '';


    //         if (sizeof($response->errores) == 0) {
    //             if ($query = $this->reporte_detalle_model->getReporteDetalle($where)) {
    //                 foreach ($query->result() as $res) {
    //                     $row = null;
    //                     $row = new stdClass();
    //                     $row->id_reporte_detalle = $res->ID_REPORTE_DETALLE;
    //                     $row->id_cliente = $res->ID_CLIENTE;
    //                     $row->correo = $res->CORREO;
    //                     $row->nombre = $res->NOMBRE;
    //                     $row->celular = $res->CELULAR;
    //                     $row->cargo = $res->CARGO;


    //                     array_push($response->data, $row);
    //                 }
    //                 $response->proceso = 1;
    //             }
    //         }
    //         echo json_encode($response);
    //     } else {
    //         redirect('auth/login', 'refresh');
    //     }
    // }


    public function getReporteDetalleById()
    {
        if (true) {

            //DECLARACION DE VARIABLES, OBJETOS Y ARRAYS DE [PETICION]
            $request = new stdClass();
            $request->id = null;
            $request->data = [];

            $fecha = date('Y-m-d H:i:s');

            //DECLARACION DE VARIABLES, OBJETOS Y ARRAYS DE [RESPUESTA]
            $response = new stdClass();
            $response->data = [];
            $response->proceso = 0;
            $response->errores = [];


            //DECLARACION DE VARIABLES DE FILTRO PARA QUERY
            $where = '';

            if ($this->input->post('id_reporte_detalle')) {
                $request->id = $this->security->xss_clean($this->input->post('id_reporte_detalle'));
            } else { //SI NO, ALMACENAMOS EL ERROR EN UN ARRAY PARA DEVOLVERLO COMO RESPUESTA.
                $response->errores[] = "Ocurrió un problema al obtener la solicitud";
            }

            $request->id ? $where = " AND rd.id_reporte_detalle=$request->id" : $where = '';


            if (sizeof($response->errores) == 0) {
                if ($query = $this->reporte_detalle_model->getReporteDetalleBox($where)) {
                    foreach ($query->result() as $res) {
                        $row = null;
                        $row = new stdClass();
                        $row->id_reporte_detalle = $res->ID_REPORTE_DETALLE;
                        $row->cliente_envia_1 = $res->CLIENTE_ENVIA_1;
                        $row->id_trabajador_1 = $res->ID_TRABAJADOR_1;
                        $row->propuesta_2 = $res->PROPUESTA_2;
                        $row->id_trabajador_2 = $res->ID_TRABAJADOR_2;
                        $row->cliente_aprueba_3 = $res->CLIENTE_APRUEBA_3;
                        $row->id_trabajador_3 = $res->ID_TRABAJADOR_3;
                        $row->realiza_4 = $res->REALIZA_4;
                        $row->id_trabajador_4 = $res->ID_TRABAJADOR_4;
                        $row->problema_5 = $res->PROBLEMA_5;
                        $row->id_trabajador_5 = $res->ID_TRABAJADOR_5;


                        array_push($response->data, $row);
                    }
                    $response->proceso = 1;
                }
            }

            echo json_encode($response);
        } else {
            redirect('auth/login', 'refresh');
        }
    }

    public function insertReporteDetalle()
    {
        if (true) {

            //DECLARACION DE VARIABLES, OBJETOS Y ARRAYS DE [PETICION]
            $request = new stdClass();
            $request->id = null;
            $request->data = [];

            $fecha = date('Y-m-d H:i:s');

            //DECLARACION DE VARIABLES, OBJETOS Y ARRAYS DE [RESPUESTA]
            $response = new stdClass();
            $response->id = null;
            $response->data = [];
            $response->proceso = 0;
            $response->errores = [];



            if (!empty($this->input->post('cliente_envia_1'))) {
                $request->cliente_envia_1 = $this->security->xss_clean($this->input->post('cliente_envia_1'));
            }

            if (!empty($this->input->post('id_trabajador_1'))) {
                $request->id_trabajador_1 = $this->security->xss_clean($this->input->post('id_trabajador_1'));
            }

            if (!empty($this->input->post('propuesta_2'))) {
                $request->propuesta_2 = $this->security->xss_clean($this->input->post('propuesta_2'));
            }

            if (!empty($this->input->post('id_trabajador_2'))) {
                $request->id_trabajador_2 = $this->security->xss_clean($this->input->post('id_trabajador_2'));
            }

            if (!empty($this->input->post('cliente_aprueba_3'))) {
                $request->cliente_aprueba_3 = $this->security->xss_clean($this->input->post('cliente_aprueba_3'));
            }

            if (!empty($this->input->post('id_trabajador_3'))) {
                $request->id_trabajador_3 = $this->security->xss_clean($this->input->post('id_trabajador_3'));
            }

            if (!empty($this->input->post('realiza_4'))) {
                $request->realiza_4 = $this->security->xss_clean($this->input->post('realiza_4'));
            }

            if (!empty($this->input->post('id_trabajador_4'))) {
                $request->id_trabajador_4 = $this->security->xss_clean($this->input->post('id_trabajador_4'));
            }

            if (!empty($this->input->post('problema_5'))) {
                $request->problema_5 = $this->security->xss_clean($this->input->post('problema_5'));
            }

            if (!empty($this->input->post('id_trabajador_5'))) {
                $request->id_trabajador_5 = $this->security->xss_clean($this->input->post('id_trabajador_5'));
            }




            //ALMACENAMOS LOS DATOS QUE VIENEN DEL POST, QUE REEMPLAZARAN A LA FILA ACTUAL EN LA BASE DE DATOS.
            $datos = array(
                'cliente_envia_1' => $request->cliente_envia_1,
                'propuesta_2' => $request->propuesta_2,
                'cliente_aprueba_3' => $request->cliente_aprueba_3,
                'realiza_4' => $request->realiza_4,
                'problema_5' => $request->problema_5,
                'id_trabajador_1' => $request->id_trabajador_1,
                'id_trabajador_2' => $request->id_trabajador_2,
                'id_trabajador_3' => $request->id_trabajador_3,
                'id_trabajador_4' => $request->id_trabajador_4,
                'id_trabajador_5' => $request->id_trabajador_5,
                'fecha_creacion' => $fecha,
                'estado' => 1

            );

            //INSERCION, ACTUALIZACION U OPERACIONES
            if ($query = $this->reporte_detalle_model->insertReporteDetalle('reporte_detalle', $datos)) {
                $response->proceso = 1;
                $response->id = $query;
                $response->data = $datos;
            } else {
                $response->errores[] = "El dato no pudo ser ingresado";
            }

            echo json_encode($response);
        } else {
            redirect('auth/login', 'refresh');
        }
    }
    public function updateReporteDetalle()
    {
        if (true) {

            //DECLARACION DE VARIABLES, OBJETOS Y ARRAYS DE [PETICION]
            $request = new stdClass();
            $request->id = null;
            $request->data = [];

            $fecha = date('Y-m-d H:i:s');

            //DECLARACION DE VARIABLES, OBJETOS Y ARRAYS DE [RESPUESTA]
            $response = new stdClass();
            $response->id = null;
            $response->data = [];
            $response->proceso = 0;
            $response->errores = [];

            //COMPROBAMOS SI VIENE UN ID MEDIANTE LA PETICION POST, Y SI ES QUE VIENE LO GUARDAMOS (SI NO VIENE EL ID NO ES POSIBLE EDITAR, YA QUE NO ESTAMOS APUNTANDO A NINGUNA TUPLA DE DATOS)
            if ($this->input->post('id_reporte_detalle')) {
                $request->id = trim($this->security->xss_clean($this->input->post('id_reporte_detalle', true)));
            } else { //SI NO, ALMACENAMOS EL ERROR EN UN ARRAY PARA DEVOLVERLO COMO RESPUESTA.
                $response->errores[] = "Ocurrió un problema al obtener la solicitud";
            }

            if (sizeof($response->errores) == 0) {
                //VERIFICAMOS LAS VARIABLES QUE RECIBIMOS PARA EDITAR.

                if (!empty($this->input->post('cliente_envia_1'))) {
                    $request->cliente_envia_1 = $this->security->xss_clean($this->input->post('cliente_envia_1'));
                }
    
                if (!empty($this->input->post('id_trabajador_1'))) {
                    $request->id_trabajador_1 = $this->security->xss_clean($this->input->post('id_trabajador_1'));
                }
    
                if (!empty($this->input->post('propuesta_2'))) {
                    $request->propuesta_2 = $this->security->xss_clean($this->input->post('propuesta_2'));
                }
    
                if (!empty($this->input->post('id_trabajador_2'))) {
                    $request->id_trabajador_2 = $this->security->xss_clean($this->input->post('id_trabajador_2'));
                }
    
                if (!empty($this->input->post('cliente_aprueba_3'))) {
                    $request->cliente_aprueba_3 = $this->security->xss_clean($this->input->post('cliente_aprueba_3'));
                }
    
                if (!empty($this->input->post('id_trabajador_3'))) {
                    $request->id_trabajador_3 = $this->security->xss_clean($this->input->post('id_trabajador_3'));
                }
    
                if (!empty($this->input->post('realiza_4'))) {
                    $request->realiza_4 = $this->security->xss_clean($this->input->post('realiza_4'));
                }
    
                if (!empty($this->input->post('id_trabajador_4'))) {
                    $request->id_trabajador_4 = $this->security->xss_clean($this->input->post('id_trabajador_4'));
                }
    
                if (!empty($this->input->post('problema_5'))) {
                    $request->problema_5 = $this->security->xss_clean($this->input->post('problema_5'));
                }
    
                if (!empty($this->input->post('id_trabajador_5'))) {
                    $request->id_trabajador_5 = $this->security->xss_clean($this->input->post('id_trabajador_5'));
                }

                //ALMACENAMOS LOS DATOS QUE VIENEN DEL POST, QUE REEMPLAZARAN A LA FILA ACTUAL EN LA BASE DE DATOS.
                $datos = array(
                    'cliente_envia_1' => $request->cliente_envia_1,
                    'propuesta_2' => $request->propuesta_2,
                    'cliente_aprueba_3' => $request->cliente_aprueba_3,
                    'realiza_4' => $request->realiza_4,
                    'problema_5' => $request->problema_5,
                    'id_trabajador_1' => $request->id_trabajador_1,
                    'id_trabajador_2' => $request->id_trabajador_2,
                    'id_trabajador_3' => $request->id_trabajador_3,
                    'id_trabajador_4' => $request->id_trabajador_4,
                    'id_trabajador_5' => $request->id_trabajador_5,
                    'fecha_modificacion' => $fecha
                );
            }


            //SI ES QUE NO HAY ERRORES, PROCEDEMOS A HACER LA PETICION MEDIANTE UN LLAMADO A LA FUNCION DEL MODELO.
            if (sizeof($response->errores) == 0) {
                if ($query = $this->reporte_detalle_model->updateReporteDetalle('reporte_detalle', 'id_reporte_detalle', $datos, $request->id)) {
                    //SI EL PROCESO ES EXITOSO, DEVOLVERA UN VALOR DENTRO DEL ARRAY DE RESPUESTA IGUAL A 1
                    $response->proceso = 1;
                    $response->id = $query;
                    $response->data = $datos;
                }
            } else {
                $response->errores[] = "Ocurrió un problema al procesar la edicion";
            }

            echo json_encode($response);
        } else {
            redirect('auth/login', 'refresh');
        }
    }

    public function deleteReporteDetalle()
    {
        if (true) {

            //DECLARACION DE VARIABLES, OBJETOS Y ARRAYS DE [PETICION]
            $request = new stdClass();
            $request->id = null;
            $fecha = date('Y-m-d H:i:s');

            //DECLARACION DE VARIABLES, OBJETOS Y ARRAYS DE [RESPUESTA]
            $response = new stdClass();
            $response->id = null;
            $response->data = [];
            $response->proceso = 0;
            $response->errores = [];

            $where = '';

            //COMPROBAMOS SI VIENE UN ID MEDIANTE LA PETICION POST, Y SI ES QUE VIENE LO GUARDAMOS.
            if ($this->input->post('id_reporte_detalle')) {
                $request->id = $this->security->xss_clean($this->input->post('id_reporte_detalle'));
            } else { //SI NO, ALMACENAMOS EL ERROR EN UN ARRAY PARA DEVOLVERLO COMO RESPUESTA.
                $response->errores[] = "Ocurrió un problema al obtener la solicitud";
            }

            $where = " AND id_reporte_detalle=$request->id";
            $itemEliminado = $this->reporte_detalle_model->getReporteDetalle($where);

            $response->data = $itemEliminado->result();

            //SI ES QUE NO HAY ERRORES, PROCEDEMOS A HACER LA PETICION MEDIANTE UN LLAMADO A LA FUNCION DEL MODELO.
            if (sizeof($response->errores) == 0) {
                if ($this->reporte_detalle_model->updateReporteDetalle("reporte_detalle", "id_reporte_detalle", array('fecha_baja' => $fecha, "estado" => 0), $request->id)) {
                    //SI EL PROCESO ES EXITOSO, DEVOLVERA UN VALOR DENTRO DEL ARRAY DE RESPUESTA IGUAL A 1
                    $response->proceso = 1;
                }
            } else {
                $response->errores[] = "Ocurrió un problema al procesar la eliminacion";
            }

            echo json_encode($response);
        } else {
            redirect('auth/login', 'refresh');
        }
    }
}
