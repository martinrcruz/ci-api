<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contacto_cliente extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('contacto_cliente_model');
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
        if ($res = $this->contacto_cliente_model->getLastId()) {
            foreach ($res->result() as $r) {
                $row = new stdClass();
                $id_contacto_cliente = $r->LAST_ID;

            }
            $response->proceso = 1;
        }
        echo json_encode($id_contacto_cliente);
    }

    public function getContactoCliente()
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
                if ($query = $this->contacto_cliente_model->getContactoCliente()) {
                    foreach ($query->result() as $res) {
                        $row = null;
                        $row = new stdClass();
                        $row->id_contacto_cliente = $res->ID_CONTACTO_CLIENTE;
                        $row->id_cliente = $res->ID_CLIENTE;
                        $row->correo = $res->CORREO;
                        $row->nombre = $res->NOMBRE;
                        $row->celular = $res->CELULAR;
                        $row->cargo = $res->CARGO;


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



    public function getContactoClienteTabla()
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


            if ($this->input->post('id_cliente')) {
                $request->id = $this->security->xss_clean($this->input->post('id_cliente'));
            } else { //SI NO, ALMACENAMOS EL ERROR EN UN ARRAY PARA DEVOLVERLO COMO RESPUESTA.
                $response->errores[] = "Ocurrió un problema al obtener la solicitud";
            }

            $request->id ? $where = " AND id_cliente=$request->id" : $where = '';

    
            if (sizeof($response->errores) == 0) {
                if ($query = $this->contacto_cliente_model->getContactoCliente($where)) {
                    foreach ($query->result() as $res) {
                        $row = null;
                        $row = new stdClass();
                        $row->id_contacto_cliente = $res->ID_CONTACTO_CLIENTE;
                        $row->id_cliente = $res->ID_CLIENTE;
                        $row->correo = $res->CORREO;
                        $row->nombre = $res->NOMBRE;
                        $row->celular = $res->CELULAR;
                        $row->cargo = $res->CARGO;


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


    public function getContactoClienteById()
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

            if ($this->input->post('id_contacto_cliente')) {
                $request->id = $this->security->xss_clean($this->input->post('id_contacto_cliente'));
            } else { //SI NO, ALMACENAMOS EL ERROR EN UN ARRAY PARA DEVOLVERLO COMO RESPUESTA.
                $response->errores[] = "Ocurrió un problema al obtener la solicitud";
            }

            $request->id ? $where = " AND c.id_contacto_cliente=$request->id" : $where = '';


            if (sizeof($response->errores) == 0) {
                if ($query = $this->contacto_cliente_model->getContactoClienteBox($where)) {
                    foreach ($query->result() as $res) {
                        $row = null;
                        $row = new stdClass();
                        $row->id_contacto_cliente = $res->ID_CONTACTO_CLIENTE;
                        $row->id_cliente = $res->ID_CLIENTE;
                        $row->correo = $res->CORREO;
                        $row->nombre = $res->NOMBRE;
                        $row->celular = $res->CELULAR;
                        $row->cargo = $res->CARGO;


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

    public function insertContactoCliente()
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



            if (!empty($this->input->post('id_cliente'))) {
                $request->id_cliente = $this->security->xss_clean($this->input->post('id_cliente'));
            }

            if (!empty($this->input->post('nombre'))) {
                $request->nombre = $this->security->xss_clean($this->input->post('nombre'));
            }

            if (!empty($this->input->post('cargo'))) {
                $request->cargo = $this->security->xss_clean($this->input->post('cargo'));
            }

            if (!empty($this->input->post('correo'))) {
                $request->correo = $this->security->xss_clean($this->input->post('correo'));
            }

            if (!empty($this->input->post('celular'))) {
                $request->celular = $this->security->xss_clean($this->input->post('celular'));
            }



            //ALMACENAMOS LOS DATOS QUE VIENEN DEL POST, QUE REEMPLAZARAN A LA FILA ACTUAL EN LA BASE DE DATOS.
            $datos = array(
                'id_cliente' => $request->id_cliente,
                'correo' => $request->correo,
                'nombre' => $request->nombre,
                'celular' => $request->celular,
                'cargo' => $request->cargo,
                'fecha_creacion' => $fecha,
                'estado' => 1

            );

            //INSERCION, ACTUALIZACION U OPERACIONES
            if ($query = $this->contacto_cliente_model->insertContactoCliente('contacto_cliente', $datos)) {
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
    public function updateContactoCliente()
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
            if ($this->input->post('id_contacto_cliente')) {
                $request->id = trim($this->security->xss_clean($this->input->post('id_contacto_cliente', true)));
            } else { //SI NO, ALMACENAMOS EL ERROR EN UN ARRAY PARA DEVOLVERLO COMO RESPUESTA.
                $response->errores[] = "Ocurrió un problema al obtener la solicitud";
            }

            if (sizeof($response->errores) == 0) {
                //VERIFICAMOS LAS VARIABLES QUE RECIBIMOS PARA EDITAR.

                if (!empty($this->input->post('nombre'))) {
                    $request->nombre = $this->security->xss_clean($this->input->post('nombre'));
                }

                if (!empty($this->input->post('cargo'))) {
                    $request->cargo = $this->security->xss_clean($this->input->post('cargo'));
                }

                if (!empty($this->input->post('correo'))) {
                    $request->correo = $this->security->xss_clean($this->input->post('correo'));
                }

                if (!empty($this->input->post('celular'))) {
                    $request->celular = $this->security->xss_clean($this->input->post('celular'));
                }

                if (!empty($this->input->post('id_cliente'))) {
                    $request->id_cliente = $this->security->xss_clean($this->input->post('id_cliente'));
                }

                //ALMACENAMOS LOS DATOS QUE VIENEN DEL POST, QUE REEMPLAZARAN A LA FILA ACTUAL EN LA BASE DE DATOS.
                $datos = array(
                    'id_cliente' => $request->id_cliente,
                    'correo' => $request->correo,
                    'nombre' => $request->nombre,
                    'celular' => $request->celular,
                    'cargo' => $request->cargo,
                    'fecha_modificacion' => $fecha
                );
            }


            //SI ES QUE NO HAY ERRORES, PROCEDEMOS A HACER LA PETICION MEDIANTE UN LLAMADO A LA FUNCION DEL MODELO.
            if (sizeof($response->errores) == 0) {
                if ($query = $this->contacto_cliente_model->updateContactoCliente('contacto_cliente', 'id_contacto_cliente', $datos, $request->id)) {
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

    public function deleteContactoCliente()
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
            if ($this->input->post('id_contacto_cliente')) {
                $request->id = $this->security->xss_clean($this->input->post('id_contacto_cliente'));
            } else { //SI NO, ALMACENAMOS EL ERROR EN UN ARRAY PARA DEVOLVERLO COMO RESPUESTA.
                $response->errores[] = "Ocurrió un problema al obtener la solicitud";
            }

            $where = " AND id_contacto_cliente=$request->id";
            $itemEliminado = $this->contacto_cliente_model->getContactoCliente($where);

            $response->data = $itemEliminado->result();

            //SI ES QUE NO HAY ERRORES, PROCEDEMOS A HACER LA PETICION MEDIANTE UN LLAMADO A LA FUNCION DEL MODELO.
            if (sizeof($response->errores) == 0) {
                if ($this->contacto_cliente_model->updateContactoCliente("contacto_cliente", "id_contacto_cliente", array('fecha_baja' => $fecha, "estado" => 0), $request->id)) {
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
