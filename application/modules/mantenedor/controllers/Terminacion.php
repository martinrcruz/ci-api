<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Terminacion extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('terminacion_model');
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
        if ($res = $this->terminacion_model->getLastId()) {
            foreach ($res->result() as $r) {
                $row = new stdClass();
                $id_terminacion = $r->LAST_ID;
            }
            $response->proceso = 1;
        }
        echo json_encode($id_terminacion);
    }

    public function getTerminacion()
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

            $where = '';




            if ($query = $this->terminacion_model->getTerminacion($where)) {
                foreach ($query->result() as $res) {
                    $row = null;
                    $row = new stdClass();
                    $row->id_terminacion = $res->ID_TERMINACION;
                    $row->id_categoria = $res->ID_CATEGORIA;
                    $row->nombre_categoria = $res->nombre;

                    $row->nombre = $res->NOMBRE;
                    $row->descripcion = $res->DESCRIPCION;

                    $row->fecha_creacion = $res->FECHA_CREACION;

                    array_push($response->data, $row);
                }

                $response->estado = 1;
            }
            echo json_encode($response);
        } else {
            redirect('auth/login', 'refresh');
        }
    }


    public function getTerminacionByCategoria()
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

            $where = '';


            if ($this->input->post('id_categoria')) {
                $request->id = trim($this->security->xss_clean($this->input->post('id_categoria', true)));
            } else {
                $response->errores[] = "Ocurrió un problema al obtener la solicitud";
            }

            if ($this->input->post('tipo_terminacion')) {
                $tipo_terminacion = trim($this->security->xss_clean($this->input->post('tipo_terminacion', true)));
            } else {
                $response->errores[] = "Ocurrió un problema al obtener el tipo de terminacion";
            }

            $request->id ? $where = " AND t.id_categoria=$request->id" : $where = '';

            // if ($tipo_terminacion == "OT") {

            // } else if ($tipo_terminacion == "C") {

            // }


            if ($query = $this->terminacion_model->getTerminacion($where)) {
                foreach ($query->result() as $res) {
                    $row = null;
                    $row = new stdClass();
                    $row->id_terminacion = $res->ID_TERMINACION;
                    $row->id_categoria = $res->ID_CATEGORIA;
                    $row->nombre = $res->NOMBRE;
                    $row->descripcion = $res->DESCRIPCION;

                    array_push($response->data, $row);
                }

                $response->estado = 1;
            }

            echo json_encode($response);
        } else {
            redirect('auth/login', 'refresh');
        }
    }


    public function getTerminacionByDetalle()
    {
        if (true) {
            //DECLARACION DE VARIABLES, OBJETOS Y ARRAYS DE [PETICION]
            $request = new stdClass();
            $request->id = null;
            $request->data = [];
            // $tipo_terminacion = null;

            $fecha = date('Y-m-d H:i:s');

            //DECLARACION DE VARIABLES, OBJETOS Y ARRAYS DE [RESPUESTA]
            $response = new stdClass();
            $response->id = null;
            $response->data = [];
            $response->proceso = 0;
            $response->errores = [];

            $where = '';


            if ($this->input->post('id_detalle')) {
                $request->id = trim($this->security->xss_clean($this->input->post('id_detalle', true)));
            } else {
                $response->errores[] = "Ocurrió un problema al obtener la solicitud";
            }

            if ($this->input->post('tipo_terminacion')) {
                $tipo_terminacion = $this->security->xss_clean($this->input->post('tipo_terminacion'));
            } else {
                $response->errores[] = "Ocurrió un problema al obtener el tipo de terminacion";
            }


            if ($tipo_terminacion == "OT") {

                $request->id ? $where = " AND tot.id_detalle_orden_trabajo=$request->id" : $where = '';

                if ($query = $this->terminacion_model->getTerminacionDetalleOT($where)) {
                    foreach ($query->result() as $res) {
                        $row = null;
                        $row = new stdClass();
                        $row->id_terminacion_ot = $res->id_terminacion_ot;
                        $row->id_terminacion = $res->id_terminacion;
                        $row->id_detalle_orden_trabajo = $res->id_detalle_orden_trabajo;
                        $row->nombre = $res->nombre;
                        $row->descripcion = $res->descripcion;

                        // $row->fecha_creacion = $res->FECHA_CREACION;

                        array_push($response->data, $row);
                    }

                    $response->estado = 1;
                }
            } else if ($tipo_terminacion == "C") {

                $request->id ? $where = " AND td.id_detalle=$request->id" : $where = '';

                if ($query = $this->terminacion_model->getTerminacionDetalle($where)) {
                    foreach ($query->result() as $res) {
                        $row = null;
                        $row = new stdClass();
                        $row->id_terminacion_detalle = $res->id_terminacion_detalle;
                        $row->id_terminacion = $res->id_terminacion;
                        $row->id_detalle = $res->id_detalle;
                        $row->nombre = $res->nombre;
                        $row->descripcion = $res->descripcion;

                        // $row->fecha_creacion = $res->FECHA_CREACION;

                        array_push($response->data, $row);
                    }

                    $response->estado = 1;
                }
            }



            echo json_encode($response);
        } else {
            redirect('auth/login', 'refresh');
        }
    }


    public function getTerminacionById()
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

            if (is_numeric($this->input->post('id_terminacion'))) {
                $request->id = trim($this->security->xss_clean($this->input->post('id_terminacion', true)));
            } else {
                $response->errores[] = "Ocurrió un problema al obtener la solicitud";
            }

            if ($this->input->post('tipo_terminacion')) {
                $tipo_terminacion = trim($this->security->xss_clean($this->input->post('tipo_terminacion', true)));
            } else {
                $response->errores[] = "Ocurrió un problema al obtener el tipo de terminacion";
            }


            $request->id ? $where = " AND t.id_terminacion=$request->id" : $where = '';




            if (sizeof($response->errores) == 0) {
                if ($query = $this->terminacion_model->getTerminacion($where)) {
                    foreach ($query->result() as $res) {
                        $row = null;
                        $row = new stdClass();
                        $row->id_terminacion = $res->ID_TERMINACION;
                        $row->id_categoria = $res->ID_CATEGORIA;
                        $row->nombre = $res->NOMBRE;
                        $row->descripcion = $res->DESCRIPCION;

                        $row->fecha_creacion = $res->FECHA_CREACION;

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

    public function insertTerminacion()
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


            if (!empty($this->input->post('nombre'))) {
                $request->nombre = $this->security->xss_clean($this->input->post('nombre'));
            }

            if (!empty($this->input->post('categoria'))) {
                $request->categoria = $this->security->xss_clean($this->input->post('categoria'));
            }

            if (!empty($this->input->post('descripcion'))) {
                $request->descripcion = $this->security->xss_clean($this->input->post('descripcion'));
            }

            if ($this->input->post('tipo_terminacion')) {
                $tipo_terminacion = trim($this->security->xss_clean($this->input->post('tipo_terminacion', true)));
            } else {
                $response->errores[] = "Ocurrió un problema al obtener el tipo de terminacion";
            }


            //ALMACENAMOS LOS DATOS QUE VIENEN DEL POST, QUE REEMPLAZARAN A LA FILA ACTUAL EN LA BASE DE DATOS.
            $datos = array(
                'nombre' => $request->nombre,
                'id_categoria' => $request->categoria,
                'descripcion' => $request->descripcion,
                'fecha_creacion' => $fecha,
                'estado' => 1

            );

            //INSERCION, ACTUALIZACION U OPERACIONES

            if ($query = $this->terminacion_model->insertTerminacion('terminacion', $datos)) {
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

    public function insertDetalleTerminacion()
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

            if (!empty($this->input->post('id_terminacion'))) {
                $request->id_terminacion = $this->security->xss_clean($this->input->post('id_terminacion'));
            }

            if (!empty($this->input->post('id_detalle'))) {
                $request->id_detalle = $this->security->xss_clean($this->input->post('id_detalle'));
            }

            if ($this->input->post('tipo_terminacion')) {
                $tipo_terminacion = trim($this->security->xss_clean($this->input->post('tipo_terminacion', true)));
            } else {
                $response->errores[] = "Ocurrió un problema al obtener el tipo de terminacion";
            }

            //ALMACENAMOS LOS DATOS QUE VIENEN DEL POST, QUE REEMPLAZARAN A LA FILA ACTUAL EN LA BASE DE DATOS.
    

            if ($tipo_terminacion == "OT") {

                $datos = array(
                    'id_terminacion' => $request->id_terminacion,
                    'id_detalle_orden_trabajo' => $request->id_detalle,
                    'fecha_creacion' => $fecha,
                    'estado' => 1
    
                );

                
                if ($query = $this->terminacion_model->insertTerminacion('terminacion_orden_trabajo', $datos)) {
                    $response->proceso = 1;
                    $response->id = $query;
                    $response->data = $datos;
                } else {
                    $response->errores[] = "El dato no pudo ser ingresado";
                }
            } else if ($tipo_terminacion == "C") {

                $datos = array(
                    'id_terminacion' => $request->id_terminacion,
                    'id_detalle' => $request->id_detalle,
                    'fecha_creacion' => $fecha,
                    'estado' => 1
    
                );
    
                if ($query = $this->terminacion_model->insertTerminacion('terminacion_detalle', $datos)) {
                    $response->proceso = 1;
                    $response->id = $query;
                    $response->data = $datos;
                } else {
                    $response->errores[] = "El dato no pudo ser ingresado";
                }
            }

            echo json_encode($response);
        } else {
            redirect('auth/login', 'refresh');
        }
    }

    public function deleteDetalleTerminacion()
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

            if ($this->input->post('tipo_terminacion')) {
                $tipo_terminacion = trim($this->security->xss_clean($this->input->post('tipo_terminacion', true)));
            } else {
                $response->errores[] = "Ocurrió un problema al obtener el tipo de terminacion";
            }


            if ($tipo_terminacion == "OT") {

                if ($this->input->post('id_terminacion_ot')) {
                    $request->id_terminacion_ot = $this->security->xss_clean($this->input->post('id_terminacion_ot'));
                } else {
                    $response->errores[] = "Ocurrió un problema al obtener la solicitud";
                }


                if (sizeof($response->errores) == 0) {
                    if ($this->terminacion_model->updateTerminacion("terminacion_orden_trabajo", "id_terminacion_ot", array('fecha_baja' => $fecha, "estado" => 0), $request->id_terminacion_ot)) {
                        $response->proceso = 1;
                    }
                } else {
                    $response->errores[] = "Ocurrió un problema al procesar la eliminacion";
                }


            } else if ($tipo_terminacion == "C") {


                if ($this->input->post('id_terminacion_detalle')) {
                    $request->id_terminacion_detalle = $this->security->xss_clean($this->input->post('id_terminacion_detalle'));
                } else {
                    $response->errores[] = "Ocurrió un problema al obtener la solicitud";
                }


                if (sizeof($response->errores) == 0) {
                    if ($this->terminacion_model->updateTerminacion("terminacion_detalle", "id_terminacion_detalle", array('fecha_baja' => $fecha, "estado" => 0), $request->id_terminacion_detalle)) {
                        $response->proceso = 1;
                    }
                } else {
                    $response->errores[] = "Ocurrió un problema al procesar la eliminacion";
                }
            }

            echo json_encode($response);
        } else {
            redirect('auth/login', 'refresh');
        }
    }


    public function updateTerminacion()
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
            if ($this->input->post('id_terminacion')) {
                $request->id = trim($this->security->xss_clean($this->input->post('id_terminacion', true)));
            } else {
                $response->errores[] = "Ocurrió un problema al obtener la solicitud";
            }

            if (sizeof($response->errores) == 0) {
                //VERIFICAMOS LAS VARIABLES QUE RECIBIMOS PARA EDITAR.

                if (!empty($this->input->post('nombre'))) {
                    $request->nombre = $this->security->xss_clean($this->input->post('nombre'));
                }

                if (!empty($this->input->post('categoria'))) {
                    $request->categoria = $this->security->xss_clean($this->input->post('categoria'));
                }

                if (!empty($this->input->post('descripcion'))) {
                    $request->descripcion = $this->security->xss_clean($this->input->post('descripcion'));
                }





                //ALMACENAMOS LOS DATOS QUE VIENEN DEL POST, QUE REEMPLAZARAN A LA FILA ACTUAL EN LA BASE DE DATOS.
                $datos = array(
                    'nombre' => $request->nombre,
                    'id_categoria' => $request->categoria,
                    'descripcion' => $request->descripcion,
                    'fecha_modificacion' => $fecha,
                    'estado' => 1
                );
            }


            //SI ES QUE NO HAY ERRORES, PROCEDEMOS A HACER LA PETICION MEDIANTE UN LLAMADO A LA FUNCION DEL MODELO.
            if (sizeof($response->errores) == 0) {
                if ($query = $this->terminacion_model->updateTerminacion('terminacion', 'id_terminacion', $datos, $request->id)) {
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

    public function deleteTerminacion()
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
            if ($this->input->post('id_terminacion')) {
                $request->id_terminacion = $this->security->xss_clean($this->input->post('id_terminacion'));
            } else {
                $response->errores[] = "Ocurrió un problema al obtener la solicitud";
            }

            $where = " AND id_terminacion=$request->id_terminacion";
            $itemEliminado = $this->terminacion_model->getTerminacion($where);

            $response->data = $itemEliminado->result();

            //SI ES QUE NO HAY ERRORES, PROCEDEMOS A HACER LA PETICION MEDIANTE UN LLAMADO A LA FUNCION DEL MODELO.
            if (sizeof($response->errores) == 0) {
                if ($this->terminacion_model->updateTerminacion("terminacion", "id_terminacion", array('fecha_baja' => $fecha, "estado" => 0), $request->id)) {
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
