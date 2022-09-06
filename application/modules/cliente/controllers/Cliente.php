<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cliente extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('cliente_model');
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
        if ($res = $this->cliente_model->getLastId()) {
            foreach ($res->result() as $r) {
                $row = new stdClass();
                $id_cliente = $r->LAST_ID;

            }
            $response->proceso = 1;
        }
        echo json_encode($id_cliente);
    }

    public function getCliente()
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
                if ($query = $this->cliente_model->getCliente()) {
                    foreach ($query->result() as $res) {
                        $row = null;
                        $row = new stdClass();
                        $row->id_cliente = $res->id_cliente;
                        $row->rut = $res->RUT;
                        $row->correo = $res->CORREO;
                        $row->empresa = $res->id_empresa;
                        $row->nombre_empresa = $res->nombre_empresa;
                        $row->rut_empresa = $res->rut_empresa;
                        $row->nombre = $res->nombre_cliente;
                        // $row->apellidop = $res->APELLIDOP;
                        // $row->apellidom = $res->APELLIDOM;
                        $row->celular = $res->CELULAR;
                        $row->telefono = $res->TELEFONO;
                        $row->direccion = $res->direccion;
                        $row->sitio_web = $res->sitio_web;
                        $row->tipo_cliente = $res->tipo_cliente;

                        $row->observacion = $res->OBSERVACION;

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


    public function getClienteById()
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

            if ($this->input->post('id_cliente')) {
                $request->id = $this->security->xss_clean($this->input->post('id_cliente'));
            } else { //SI NO, ALMACENAMOS EL ERROR EN UN ARRAY PARA DEVOLVERLO COMO RESPUESTA.
                $response->errores[] = "Ocurrió un problema al obtener la solicitud";
            }

            $request->id ? $where = " AND c.id_cliente=$request->id" : $where = '';


            if (sizeof($response->errores) == 0) {
                if ($query = $this->cliente_model->getClienteBox($where)) {
                    foreach ($query->result() as $res) {
                        $row = null;
                        $row = new stdClass();
                        $row->id_cliente = $res->id_cliente;
                        $row->nombre_cliente = $res->nombre_cliente;
                        $row->correo = $res->CORREO;
                        $row->celular = $res->CELULAR;
                        $row->empresa = $res->id_empresa;
                        $row->nombre_empresa = $res->nombre_empresa;
                        $row->rut_empresa = $res->rut_empresa;
                        $row->giro_empresa = $res->giro_empresa;
                        $row->direccion_empresa = $res->direccion_empresa;
                        $row->rut = $res->RUT;
                        // $row->apellidop = $res->APELLIDOP;
                        // $row->apellidom = $res->APELLIDOM;
                        $row->telefono = $res->TELEFONO;
                        $row->direccion = $res->direccion;
                        $row->sitio_web = $res->sitio_web;
                        $row->tipo_cliente = $res->tipo_cliente;
                        $row->observacion = $res->OBSERVACION;

                        $row->ultima_cotizacion = $res->ultima_cotizacion;
                        $row->ultima_cotizacion_date = $res->ultima_cotizacion_date;

                        $row->ultima_orden_trabajo = $res->ultima_cotizacion;
                        $row->saldo_adeudado =  0; //$res->saldo_adeudado


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

    public function insertCliente()
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


                  if (!empty($this->input->post('rut'))) {
                    $request->rut = $this->security->xss_clean($this->input->post('rut'));
                } else {
                    $request->rut = " ";
                }

                if (!empty($this->input->post('correo'))) {
                    $request->correo = $this->security->xss_clean($this->input->post('correo'));
                }

                if (!empty($this->input->post('empresa'))) {
                    $request->id_empresa = $this->security->xss_clean($this->input->post('empresa'));
                }else {
                    $request->id_empresa = " ";
                }


                if (!empty($this->input->post('nombre'))) {
                    $request->nombre = $this->security->xss_clean($this->input->post('nombre'));
                }else {
                    $request->nombre = " ";
                }


                if (!empty($this->input->post('celular'))) {
                    $request->celular = $this->security->xss_clean($this->input->post('celular'));
                } else {
                    $request->celular = " ";
                }


                if (!empty($this->input->post('telefono'))) {
                    $request->telefono = $this->security->xss_clean($this->input->post('telefono'));
                } else {
                    $request->telefono = " ";
                }


                if (!empty($this->input->post('observacion'))) {
                    $request->observacion = $this->security->xss_clean($this->input->post('observacion'));
                } else {
                    $request->observacion = " ";
                }


            //ALMACENAMOS LOS DATOS QUE VIENEN DEL POST, QUE REEMPLAZARAN A LA FILA ACTUAL EN LA BASE DE DATOS.
            $datos = array(
                'rut' => $request->rut,
                'correo' => $request->correo,
                'id_empresa' => $request->id_empresa,
                'nombre' => $request->nombre,
                // 'apellidop' => $request->apellidop,
                // 'apellidom' => $request->apellidom,
                'celular' => $request->celular,
                'telefono' => $request->telefono,
                'observacion' => $request->observacion,
                'fecha_creacion' => $fecha,
                'estado' => 1

            );

            //INSERCION, ACTUALIZACION U OPERACIONES
            if ($query = $this->cliente_model->insertCliente('cliente', $datos)) {
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
    public function updateCliente()
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
            if ($this->input->post('id_cliente')) {
                $request->id = trim($this->security->xss_clean($this->input->post('id_cliente', true)));
            } else { //SI NO, ALMACENAMOS EL ERROR EN UN ARRAY PARA DEVOLVERLO COMO RESPUESTA.
                $response->errores[] = "Ocurrió un problema al obtener la solicitud";
            }

            if (sizeof($response->errores) == 0) {
                //VERIFICAMOS LAS VARIABLES QUE RECIBIMOS PARA EDITAR.

                if (!empty($this->input->post('rut'))) {
                    $request->rut = $this->security->xss_clean($this->input->post('rut'));
                } else {
                    $request->rut = " ";
                }

                if (!empty($this->input->post('correo'))) {
                    $request->correo = $this->security->xss_clean($this->input->post('correo'));
                }

                if (!empty($this->input->post('empresa'))) {
                    $request->id_empresa = $this->security->xss_clean($this->input->post('empresa'));
                }else {
                    $request->id_empresa = " ";
                }


                if (!empty($this->input->post('nombre'))) {
                    $request->nombre = $this->security->xss_clean($this->input->post('nombre'));
                }else {
                    $request->nombre = " ";
                }


                if (!empty($this->input->post('celular'))) {
                    $request->celular = $this->security->xss_clean($this->input->post('celular'));
                } else {
                    $request->celular = " ";
                }


                if (!empty($this->input->post('telefono'))) {
                    $request->telefono = $this->security->xss_clean($this->input->post('telefono'));
                } else {
                    $request->telefono = " ";
                }


                if (!empty($this->input->post('observacion'))) {
                    $request->observacion = $this->security->xss_clean($this->input->post('observacion'));
                } else {
                    $request->observacion = " ";
                }




                //ALMACENAMOS LOS DATOS QUE VIENEN DEL POST, QUE REEMPLAZARAN A LA FILA ACTUAL EN LA BASE DE DATOS.
                $datos = array(
                    'rut' => $request->rut,
                    'correo' => $request->correo,
                    'id_empresa' => $request->id_empresa,
                    'nombre' => $request->nombre,
                    // 'apellidop' => $request->apellidop,
                    // 'apellidom' => $request->apellidom,
                    'celular' => $request->celular,
                    'telefono' => $request->telefono,
                    'observacion' => $request->observacion,
                    'fecha_modificacion' => $fecha
                );
            }


            //SI ES QUE NO HAY ERRORES, PROCEDEMOS A HACER LA PETICION MEDIANTE UN LLAMADO A LA FUNCION DEL MODELO.
            if (sizeof($response->errores) == 0) {
                if ($query = $this->cliente_model->updateCliente('cliente', 'id_cliente', $datos, $request->id)) {
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

    public function deleteCliente()
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
            if ($this->input->post('id_cliente')) {
                $request->id = $this->security->xss_clean($this->input->post('id_cliente'));
            } else { //SI NO, ALMACENAMOS EL ERROR EN UN ARRAY PARA DEVOLVERLO COMO RESPUESTA.
                $response->errores[] = "Ocurrió un problema al obtener la solicitud";
            }

            $where = " AND id_cliente=$request->id";
            $itemEliminado = $this->cliente_model->getCliente($where);

            $response->data = $itemEliminado->result();

            //SI ES QUE NO HAY ERRORES, PROCEDEMOS A HACER LA PETICION MEDIANTE UN LLAMADO A LA FUNCION DEL MODELO.
            if (sizeof($response->errores) == 0) {
                if ($this->cliente_model->updateCliente("cliente", "id_cliente", array('fecha_baja' => $fecha, "estado" => 0), $request->id)) {
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
