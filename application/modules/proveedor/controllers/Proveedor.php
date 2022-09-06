<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Proveedor extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('proveedor_model');
        $this->load->library(['ion_auth', 'form_validation']);

        date_default_timezone_set('America/Santiago');
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } else {


            $data['datalibrary'] = array(
                'titulo' => "Proveedor",
                'vista' => array('index', 'modals'),
                'libjs' => array('libjs'),
                'active' => 'proveedor'
            );
            $this->load->view('estructura/body', $data);
        }
    }

    public function getProveedor()
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




            if ($query = $this->proveedor_model->getProveedor($where)) {
                foreach ($query->result() as $res) {
                    $row = null;
                    $row = new stdClass();
                    $row->id_proveedor = $res->id_proveedor;
                    $row->nombre = $res->nombre;
                    $row->descripcion = $res->descripcion;
                    $row->rubro = $res->rubro;
                    $row->correo = $res->correo;
                    $row->celular = $res->celular;
                    $row->telefono = $res->telefono;
                    $row->nombre_contacto = $res->nombre_contacto;
                    $row->rut_empresa = $res->rut_empresa;
                    $row->direccion_sucursal = $res->direccion_sucursal;
                    $row->ciudad_sucursal = $res->ciudad_sucursal;

                    array_push($response->data, $row);
                }
            }
            echo json_encode($response);
        } else {
            redirect('auth/login', 'refresh');
        }
    }


    public function getProveedorById()
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

            if (is_numeric($this->input->post('id_proveedor'))) {
                $request->id = trim($this->security->xss_clean($this->input->post('id_proveedor', true)));
            } else { //SI NO, ALMACENAMOS EL ERROR EN UN ARRAY PARA DEVOLVERLO COMO RESPUESTA.
                $response->errores[] = "Ocurrió un problema al obtener la solicitud";
            }

            $request->id ? $where = " AND id_proveedor=$request->id" : $where = '';


            if (sizeof($response->errores) == 0) {
                if ($query = $this->proveedor_model->getProveedor($where)) {
                    foreach ($query->result() as $res) {
                        $row = null;
                        $row = new stdClass();
                        $row->id_proveedor = $res->id_proveedor;
                        $row->nombre = $res->nombre;
                        $row->descripcion = $res->descripcion;
                        $row->rubro = $res->rubro;
                        $row->correo = $res->correo;
                        $row->celular = $res->celular;
                        $row->telefono = $res->telefono;
                        $row->nombre_contacto = $res->nombre_contacto;
                        $row->rut_empresa = $res->rut_empresa;
                        $row->direccion_sucursal = $res->direccion_sucursal;
                        $row->ciudad_sucursal = $res->ciudad_sucursal;
                        $row->fecha_creacion = $res->fecha_creacion;
                        $row->estado = $res->estado;

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

    public function insertProveedor()
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

            if (!empty($this->input->post('descripcion'))) {
                $request->descripcion = $this->security->xss_clean($this->input->post('descripcion'));
            }

            if (!empty($this->input->post('rubro'))) {
                $request->rubro = $this->security->xss_clean($this->input->post('rubro'));
            }

            if (!empty($this->input->post('correo'))) {
                $request->correo = $this->security->xss_clean($this->input->post('correo'));
            }

            if (!empty($this->input->post('celular'))) {
                $request->celular = $this->security->xss_clean($this->input->post('celular'));
            }

            if (!empty($this->input->post('telefono'))) {
                $request->telefono = $this->security->xss_clean($this->input->post('telefono'));
            }

            if (!empty($this->input->post('nombre_contacto'))) {
                $request->nombre_contacto = $this->security->xss_clean($this->input->post('nombre_contacto'));
            }

            if (!empty($this->input->post('rut_empresa'))) {
                $request->rut_empresa = $this->security->xss_clean($this->input->post('rut_empresa'));
            }

            if (!empty($this->input->post('direccion_sucursal'))) {
                $request->direccion_sucursal = $this->security->xss_clean($this->input->post('direccion_sucursal'));
            }

            if (!empty($this->input->post('ciudad_sucursal'))) {
                $request->ciudad_sucursal = $this->security->xss_clean($this->input->post('ciudad_sucursal'));
            }

            if (!empty($this->input->post('fecha_creacion'))) {
                $request->fecha_creacion = $this->security->xss_clean($this->input->post('fecha_creacion'));
            }

            if (!empty($this->input->post('estado'))) {
                $request->estado = $this->security->xss_clean($this->input->post('estado'));
            }



            //ALMACENAMOS LOS DATOS QUE VIENEN DEL POST, QUE REEMPLAZARAN A LA FILA ACTUAL EN LA BASE DE DATOS.
            $datos = array(
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'rubro' => $request->rubro,
                'correo' => $request->correo,
                'celular' => $request->celular,
                'telefono' => $request->telefono,
                'nombre_contacto' => $request->nombre_contacto,
                'rut_empresa' => $request->rut_empresa,
                'direccion_sucursal' => $request->direccion_sucursal,
                'ciudad_sucursal' => $request->ciudad_sucursal,
                'fecha_creacion' => $fecha,
                'estado' => 1

            );

            //INSERCION, ACTUALIZACION U OPERACIONES
            if ($query = $this->proveedor_model->insertProveedor('proveedor', $datos)) {
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
    public function updateProveedor()
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
            if ($this->input->post('id_proveedor')) {
                $request->id_proveedor = trim($this->security->xss_clean($this->input->post('id_proveedor', true)));
            } else { //SI NO, ALMACENAMOS EL ERROR EN UN ARRAY PARA DEVOLVERLO COMO RESPUESTA.
                $response->errores[] = "Ocurrió un problema al obtener la solicitud";
            }

            if (sizeof($response->errores) == 0) {
                //VERIFICAMOS LAS VARIABLES QUE RECIBIMOS PARA EDITAR.

                if (!empty($this->input->post('nombre'))) {
                    $request->nombre = $this->security->xss_clean($this->input->post('nombre'));
                }

                if (!empty($this->input->post('descripcion'))) {
                    $request->descripcion = $this->security->xss_clean($this->input->post('descripcion'));
                }

                if (!empty($this->input->post('rubro'))) {
                    $request->rubro = $this->security->xss_clean($this->input->post('rubro'));
                }

                if (!empty($this->input->post('correo'))) {
                    $request->correo = $this->security->xss_clean($this->input->post('correo'));
                }

                if (!empty($this->input->post('celular'))) {
                    $request->celular = $this->security->xss_clean($this->input->post('celular'));
                }

                if (!empty($this->input->post('telefono'))) {
                    $request->telefono = $this->security->xss_clean($this->input->post('telefono'));
                }

                if (!empty($this->input->post('nombre_contacto'))) {
                    $request->nombre_contacto = $this->security->xss_clean($this->input->post('nombre_contacto'));
                }

                if (!empty($this->input->post('rut_empresa'))) {
                    $request->rut_empresa = $this->security->xss_clean($this->input->post('rut_empresa'));
                }

                if (!empty($this->input->post('direccion_sucursal'))) {
                    $request->direccion_sucursal = $this->security->xss_clean($this->input->post('direccion_sucursal'));
                }

                if (!empty($this->input->post('ciudad_sucursal'))) {
                    $request->ciudad_sucursal = $this->security->xss_clean($this->input->post('ciudad_sucursal'));
                }

                if (!empty($this->input->post('fecha_creacion'))) {
                    $request->fecha_creacion = $this->security->xss_clean($this->input->post('fecha_creacion'));
                }

                if (!empty($this->input->post('estado'))) {
                    $request->estado = $this->security->xss_clean($this->input->post('estado'));
                }


                //ALMACENAMOS LOS DATOS QUE VIENEN DEL POST, QUE REEMPLAZARAN A LA FILA ACTUAL EN LA BASE DE DATOS.
                $datos = array(
                    'nombre' => $request->nombre,
                    'descripcion' => $request->descripcion,
                    'rubro' => $request->rubro,
                    'correo' => $request->correo,
                    'celular' => $request->celular,
                    'telefono' => $request->telefono,
                    'nombre_contacto' => $request->nombre_contacto,
                    'rut_empresa' => $request->rut_empresa,
                    'direccion_sucursal' => $request->direccion_sucursal,
                    'ciudad_sucursal' => $request->ciudad_sucursal,
                    'fecha_modificacion' => $fecha,
                    'estado' => 1
                );
            }


            //SI ES QUE NO HAY ERRORES, PROCEDEMOS A HACER LA PETICION MEDIANTE UN LLAMADO A LA FUNCION DEL MODELO.
            if (sizeof($response->errores) == 0) {
                if ($query = $this->proveedor_model->updateProveedor('proveedor', 'ID_PROVEEDOR', $datos, $request->id_proveedor)) {
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

    public function deleteProveedor()
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
            if ($this->input->post('id_proveedor')) {
                $request->id = $this->security->xss_clean($this->input->post('id_proveedor'));
            } else { //SI NO, ALMACENAMOS EL ERROR EN UN ARRAY PARA DEVOLVERLO COMO RESPUESTA.
                $response->errores[] = "Ocurrió un problema al obtener la solicitud";
            }

            $where = " AND id_proveedor=$request->id";
            $itemEliminado = $this->proveedor_model->getProveedor($where);

            $response->data = $itemEliminado->result();

            //SI ES QUE NO HAY ERRORES, PROCEDEMOS A HACER LA PETICION MEDIANTE UN LLAMADO A LA FUNCION DEL MODELO.
            if (sizeof($response->errores) == 0) {
                if ($this->proveedor_model->updateProveedor("proveedor", "id_proveedor", array('fecha_baja' => $fecha, "estado" => 0), $request->id)) {
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
