<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Empresa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('empresa_model');
        $this->load->library(['ion_auth', 'form_validation']);

        date_default_timezone_set('America/Santiago');
    }



    public function getEmpresa()
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

            $draw = 1;
            $where = '';
            $filters = '';
            $clauses = [];
            $ORDER_BY = '';
            $limit = '';





            if ($query = $this->empresa_model->getEmpresa($where)) {
                foreach ($query->result() as $res) {
                    $row = null;
                    $row = new stdClass();
                    $row->id_empresa = $res->ID_EMPRESA;
                    $row->nombre = $res->NOMBRE;
                    $row->rut = $res->RUT;
                    $row->giro = $res->GIRO;
                    $row->direccion = $res->DIRECCION;
                    $row->correo = $res->CORREO;
                    $row->ciudad = $res->CIUDAD;
                    $row->telefono = $res->TELEFONO;
                    $row->celular = $res->CELULAR;
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


    public function getEmpresaById()
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

            if (is_numeric($this->input->post('id_empresa'))) {
                $request->id = trim($this->security->xss_clean($this->input->post('id_empresa', true)));
            } else { //SI NO, ALMACENAMOS EL ERROR EN UN ARRAY PARA DEVOLVERLO COMO RESPUESTA.
                $response->errores[] = "Ocurrió un problema al obtener la solicitud";
            }

            $request->id ? $where = " AND id_empresa=$request->id" : $where = '';


            if (sizeof($response->errores) == 0) {
                if ($query = $this->empresa_model->getEmpresa($where)) {
                    foreach ($query->result() as $res) {
                        $row = null;
                        $row = new stdClass();
                        $row->id_empresa = $res->ID_EMPRESA;
                        $row->nombre = $res->NOMBRE;
                        $row->rut = $res->RUT;
                        $row->giro = $res->GIRO;
                        $row->direccion = $res->DIRECCION;
                        $row->correo = $res->CORREO;
                        $row->ciudad = $res->CIUDAD;
                        $row->telefono = $res->TELEFONO;
                        $row->celular = $res->CELULAR;
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

    public function insertEmpresa()
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

            if (!empty($this->input->post('rut'))) {
                $request->rut = $this->security->xss_clean($this->input->post('rut'));
            }

            if (!empty($this->input->post('giro'))) {
                $request->giro = $this->security->xss_clean($this->input->post('giro'));
            }

            if (!empty($this->input->post('direccion'))) {
                $request->direccion = $this->security->xss_clean($this->input->post('direccion'));
            }

            if (!empty($this->input->post('celular'))) {
                $request->celular = $this->security->xss_clean($this->input->post('celular'));
            }

            if (!empty($this->input->post('correo'))) {
                $request->correo = $this->security->xss_clean($this->input->post('correo'));
            }

            if (!empty($this->input->post('telefono'))) {
                $request->telefono = $this->security->xss_clean($this->input->post('telefono'));
            }

            if (!empty($this->input->post('ciudad'))) {
                $request->ciudad = $this->security->xss_clean($this->input->post('ciudad'));
            }




            //ALMACENAMOS LOS DATOS QUE VIENEN DEL POST, QUE REEMPLAZARAN A LA FILA ACTUAL EN LA BASE DE DATOS.
            $datos = array(
                'nombre' => $request->nombre,
                'rut' => $request->rut,
                'giro' => $request->giro,
                'correo' => $request->correo,
                'celular' => $request->celular,
                'telefono' => $request->telefono,
                'direccion' => $request->direccion,
                'ciudad' => $request->ciudad,
                'fecha_creacion' => $fecha,
                'estado' => 1

            );

            //INSERCION, ACTUALIZACION U OPERACIONES
            if ($query = $this->empresa_model->insertEmpresa('empresa', $datos)) {
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
    public function updateEmpresa()
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
            if ($this->input->post('id_empresa')) {
                $request->id = trim($this->security->xss_clean($this->input->post('id_empresa', true)));
            } else { //SI NO, ALMACENAMOS EL ERROR EN UN ARRAY PARA DEVOLVERLO COMO RESPUESTA.
                $response->errores[] = "Ocurrió un problema al obtener la solicitud";
            }

            if (sizeof($response->errores) == 0) {
                //VERIFICAMOS LAS VARIABLES QUE RECIBIMOS PARA EDITAR.

                if (!empty($this->input->post('nombre'))) {
                    $request->nombre = $this->security->xss_clean($this->input->post('nombre'));
                }

                if (!empty($this->input->post('rut'))) {
                    $request->rut = $this->security->xss_clean($this->input->post('rut'));
                }

                if (!empty($this->input->post('giro'))) {
                    $request->giro = $this->security->xss_clean($this->input->post('giro'));
                }

                if (!empty($this->input->post('direccion'))) {
                    $request->direccion = $this->security->xss_clean($this->input->post('direccion'));
                }

                if (!empty($this->input->post('celular'))) {
                    $request->celular = $this->security->xss_clean($this->input->post('celular'));
                }

                if (!empty($this->input->post('correo'))) {
                    $request->correo = $this->security->xss_clean($this->input->post('correo'));
                }

                if (!empty($this->input->post('telefono'))) {
                    $request->telefono = $this->security->xss_clean($this->input->post('telefono'));
                }

                if (!empty($this->input->post('ciudad'))) {
                    $request->ciudad = $this->security->xss_clean($this->input->post('ciudad'));
                }



                //ALMACENAMOS LOS DATOS QUE VIENEN DEL POST, QUE REEMPLAZARAN A LA FILA ACTUAL EN LA BASE DE DATOS.
                $datos = array(
                    'nombre' => $request->nombre,
                    'rut' => $request->rut,
                    'giro' => $request->giro,
                    'correo' => $request->correo,
                    'celular' => $request->celular,
                    'telefono' => $request->telefono,
                    'direccion' => $request->direccion,
                    'ciudad' => $request->ciudad,
                    'fecha_modificacion' => $fecha,
                    'estado' => 1
                );
            }


            //SI ES QUE NO HAY ERRORES, PROCEDEMOS A HACER LA PETICION MEDIANTE UN LLAMADO A LA FUNCION DEL MODELO.
            if (sizeof($response->errores) == 0) {
                if ($query = $this->empresa_model->updateEmpresa('EMPRESA', 'ID_EMPRESA', $datos, $request->id)) {
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

    public function deleteEmpresa()
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
            if ($this->input->post('id_empresa')) {
                $request->id_empresa = $this->security->xss_clean($this->input->post('id_empresa'));
            } else { //SI NO, ALMACENAMOS EL ERROR EN UN ARRAY PARA DEVOLVERLO COMO RESPUESTA.
                $response->errores[] = "Ocurrió un problema al obtener la solicitud";
            }

            $where = " AND id_empresa=$request->id_empresa";
            $itemEliminado = $this->empresa_model->getEmpresa($where);

            $response->data = $itemEliminado->result();

            //SI ES QUE NO HAY ERRORES, PROCEDEMOS A HACER LA PETICION MEDIANTE UN LLAMADO A LA FUNCION DEL MODELO.
            if (sizeof($response->errores) == 0) {
                if ($this->empresa_model->updateEmpresa("EMPRESA", "ID_EMPRESA", array('FECHA_BAJA' => $fecha, "ESTADO" => 0), $request->id)) {
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
