<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Producto extends CI_Controller
{
    function __construct()
    {
        parent::__construct();


        $ruta_imagen = "C:/xampp/htdocs/graficag_v1/graficag_sistema/assets/images/productos";

        $this->load->model('producto_model');
        $this->load->library(['ion_auth', 'form_validation']);
        $this->load->helper(['form', 'url']);




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
        if ($res = $this->producto_model->getLastId()) {
            foreach ($res->result() as $r) {
                $row = new stdClass();
                $id_producto = $r->LAST_ID;

            }
            $response->proceso = 1;
        }
        echo json_encode($id_producto);
    }

    public function getProducto()
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


            if ($query = $this->producto_model->getProducto($where)) {
                foreach ($query->result() as $res) {
                    $row = null;
                    $row = new stdClass();
                    $row->id_producto = $res->ID_PRODUCTO;
                    $row->id_categoria = $res->ID_CATEGORIA;
                    $row->nombre_categoria = $res->nombre;

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


    public function getProductoByCategoria()
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


            if ($this->input->post('id_categoria')) {
                $request->id = trim($this->security->xss_clean($this->input->post('id_categoria', true)));
            } else { //SI NO, ALMACENAMOS EL ERROR EN UN ARRAY PARA DEVOLVERLO COMO RESPUESTA.
                $response->errores[] = "Ocurrió un problema al obtener la solicitud";
            }

            $request->id ? $where = " AND p.id_categoria=$request->id" : $where = '';

            if ($query = $this->producto_model->getProducto($where)) {
                foreach ($query->result() as $res) {
                    $row = null;
                    $row = new stdClass();
                    $row->id_producto = $res->ID_PRODUCTO;
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


    public function getProductoById()
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

            if (is_numeric($this->input->post('id_producto'))) {
                $request->id = trim($this->security->xss_clean($this->input->post('id_producto', true)));
            } else { //SI NO, ALMACENAMOS EL ERROR EN UN ARRAY PARA DEVOLVERLO COMO RESPUESTA.
                $response->errores[] = "Ocurrió un problema al obtener la solicitud";
            }

            $request->id ? $where = " AND p.id_producto=$request->id" : $where = '';


            if (sizeof($response->errores) == 0) {
                if ($query = $this->producto_model->getProducto($where)) {
                    foreach ($query->result() as $res) {
                        $row = null;
                        $row = new stdClass();
                        $row->id_producto = $res->ID_PRODUCTO;
                        $row->id_categoria = $res->ID_CATEGORIA;
                        $row->imagen = $res->IMAGEN;
                        $row->nombre = $res->NOMBRE;
                        $row->descripcion = $res->DESCRIPCION;

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

    public function insertProducto()
    {
        $this->load->library('upload');

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
            $ruta_imagen = "C:/xampp/htdocs/graficag_v1/graficag_sistema/assets/images/productos";


            if (!empty($this->input->post('id_categoria'))) {
                $request->id_categoria = $this->security->xss_clean($this->input->post('id_categoria'));
            }

            if (!empty($this->input->post('nombre'))) {
                $request->nombre = $this->security->xss_clean($this->input->post('nombre'));
            }

            if (!empty($this->input->post('descripcion'))) {
                $request->descripcion = $this->security->xss_clean($this->input->post('descripcion'));
            }

            // if ($_FILES['imagen']) {
              $folderPath = "assets/images/productos/";

              $file_tmp = $_FILES['imagen']['tmp_name'];
              $img_name = $_FILES['imagen']['name'];
              $tmp_ext = explode('.', $img_name);
              $file_ext = end($tmp_ext);

              $file = $folderPath . uniqid() . '.'.$file_ext;

            // }

            //ALMACENAMOS LOS DATOS QUE VIENEN DEL POST, QUE REEMPLAZARAN A LA FILA ACTUAL EN LA BASE DE DATOS.
            $datos = array(
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'imagen' => $file,
                'id_categoria' => $request->id_categoria,
                'fecha_creacion' => $fecha,
                'estado' => 1
            );

            //INSERCION, ACTUALIZACION U OPERACIONES
            if ($query = $this->producto_model->insertProducto('producto', $datos)) {
              move_uploaded_file($file_tmp, $file);

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
    public function updateProducto()
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
            if ($this->input->post('id_producto')) {
                $request->id = trim($this->security->xss_clean($this->input->post('id_producto', true)));
            } else { //SI NO, ALMACENAMOS EL ERROR EN UN ARRAY PARA DEVOLVERLO COMO RESPUESTA.
                $response->errores[] = "Ocurrió un problema al obtener la solicitud";
            }

            if (sizeof($response->errores) == 0) {
                //VERIFICAMOS LAS VARIABLES QUE RECIBIMOS PARA EDITAR.

                if (!empty($this->input->post('id_categoria'))) {
                    $request->id_categoria = $this->security->xss_clean($this->input->post('id_categoria'));
                }

                if (!empty($this->input->post('nombre'))) {
                    $request->nombre = $this->security->xss_clean($this->input->post('nombre'));
                }

                if (!empty($this->input->post('descripcion'))) {
                    $request->descripcion = $this->security->xss_clean($this->input->post('descripcion'));
                }




                //ALMACENAMOS LOS DATOS QUE VIENEN DEL POST, QUE REEMPLAZARAN A LA FILA ACTUAL EN LA BASE DE DATOS.
                $datos = array(
                    'nombre' => $request->nombre,
                    'descripcion' => $request->descripcion,
                    'id_categoria' => $request->id_categoria,
                    'fecha_modificacion' => $fecha,
                    'estado' => 1
                );
            }


            //SI ES QUE NO HAY ERRORES, PROCEDEMOS A HACER LA PETICION MEDIANTE UN LLAMADO A LA FUNCION DEL MODELO.
            if (sizeof($response->errores) == 0) {
                if ($query = $this->producto_model->updateProducto('producto', 'id_producto', $datos, $request->id)) {
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

    public function deleteProducto()
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
            if ($this->input->post('id_producto')) {
                $request->id_producto = $this->security->xss_clean($this->input->post('id_producto'));
            } else { //SI NO, ALMACENAMOS EL ERROR EN UN ARRAY PARA DEVOLVERLO COMO RESPUESTA.
                $response->errores[] = "Ocurrió un problema al obtener la solicitud";
            }

            $where = " AND id_producto=$request->id_producto";
            $itemEliminado = $this->producto_model->getProducto($where);

            $response->data = $itemEliminado->result();

            //SI ES QUE NO HAY ERRORES, PROCEDEMOS A HACER LA PETICION MEDIANTE UN LLAMADO A LA FUNCION DEL MODELO.
            if (sizeof($response->errores) == 0) {
                if ($this->producto_model->updateProducto("producto", "id_producto", array('fecha_baja' => $fecha, "estado" => 0), $request->id)) {
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
