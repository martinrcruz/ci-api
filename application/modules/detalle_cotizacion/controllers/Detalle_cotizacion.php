<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Detalle_cotizacion extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('detalle_cotizacion_model');
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
        if ($res = $this->detalle_cotizacion_model->getLastId()) {
            foreach ($res->result() as $r) {
                $row = new stdClass();
                $id_detalle_cotizacion = $r->LAST_ID;

            }
            $response->proceso = 1;
        }
        echo json_encode($id_detalle_cotizacion);
    }


    public function getDetalleCotizacion($id_cotizacion)
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


            $id_cotizacion ? $where = "AND dc.id_cotizacion=".$id_cotizacion : $where = null;


            if ($query = $this->detalle_cotizacion_model->getTerminacionesByDetalle($where)) {
                foreach ($query->result() as $res) {
                    $row = null;
                    $row = new stdClass();
                    $row->id_detalle_cotizacion = $res->ID_DETALLE_COTIZACION;
                    $row->id_producto = $res->ID_PRODUCTO;
                    $row->id_categoria = $res->ID_CATEGORIA;
                    $row->terminaciones = $res->terminaciones;
                    $row->producto = $res->PRODUCTO;
                    $row->cantidad = $res->CANTIDAD;
                    $row->ancho = $res->ANCHO;
                    $row->alto = $res->ALTO;
                    $row->area = $res->AREA;
                    $row->descripcion = $res->DESCRIPCION;
                    $row->descripcion_producto = $res->descripcion_producto;
                    $row->imagen = $res->IMAGEN;
                    $row->id_tipo_valor = $res->ID_TIPO_VALOR;
                    $row->tipo_valor = $res->TIPO_VALOR;
                    $row->descuento = $res->descuento;
                    $row->valor_m2 = $res->VALOR_M2;
                    $row->valor_unidad = $res->VALOR_UNITARIO;
                    $row->valor_total = $res->VALOR_TOTAL;
                    $row->valor_adicional = $res->VALOR_ADICIONAL;
                    $row->fecha_creacion = $res->FECHA_CREACION;
                    $row->estado = $res->ESTADO;


                    array_push($response->data, $row);
                }
            }
            echo json_encode($response);
        } else {
            redirect('auth/login', 'refresh');
        }
    }


    public function getDetalleCotizacionTabla()
    {
        if (true) {
            //DECLARACION DE VARIABLES, OBJETOS Y ARRAYS DE [PETICION]
            $request = new stdClass();
            $request->id = null;
            $request->data = [];

            $fecha = date('Y-m-d H:i:s');
            $where = '';

            //DECLARACION DE VARIABLES, OBJETOS Y ARRAYS DE [RESPUESTA]
            $response = new stdClass();
            $response->id = null;
            $response->data = [];
            $response->proceso = 0;
            $response->errores = [];

            if (is_numeric($this->input->post('id_cotizacion'))) {
                $request->id = trim($this->security->xss_clean($this->input->post('id_cotizacion', true)));
            } else { //SI NO, ALMACENAMOS EL ERROR EN UN ARRAY PARA DEVOLVERLO COMO RESPUESTA.
                $response->errores[] = "Ocurrió un problema al obtener la solicitud";
            }

            $request->id ? $where = " AND id_cotizacion=$request->id" : $where = '';


            if (sizeof($response->errores) == 0) {
                if ($query = $this->detalle_cotizacion_model->getDetalleCotizacion($where)) {
                    foreach ($query->result() as $res) {
                        $row = null;
                        $row = new stdClass();
                        $row->id_detalle_cotizacion = $res->ID_DETALLE_COTIZACION;
                        $row->id_producto = $res->ID_PRODUCTO;
                        $row->id_categoria = $res->ID_CATEGORIA;
                        $row->producto = $res->PRODUCTO;
                        $row->cantidad = $res->CANTIDAD;
                        $row->ancho = $res->ANCHO;
                        $row->alto = $res->ALTO;
                        $row->area = $res->AREA;
                        $row->descripcion = $res->DESCRIPCION;
                        $row->tipo_valor = $res->ID_TIPO_VALOR;
                        $row->valor_m2 = $res->VALOR_M2;
                        $row->valor_unidad = $res->VALOR_UNITARIO;
                        $row->valor_adicional = $res->VALOR_ADICIONAL;
                        $row->valor_total = $res->VALOR_TOTAL;
                        $row->fecha_creacion = $res->FECHA_CREACION;
                        $row->estado = $res->ESTADO;

                        array_push($response->data, $row);
                    }
                }
            } else {
                echo 'error';
            }
            echo json_encode($response);
        } else {
            redirect('auth/login', 'refresh');
        }
    }


    public function getDetalleCotizacionById()
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

            if (is_numeric($this->input->post('id_detalle_cotizacion'))) {
                $request->id = trim($this->security->xss_clean($this->input->post('id_detalle_cotizacion', true)));
            } else { //SI NO, ALMACENAMOS EL ERROR EN UN ARRAY PARA DEVOLVERLO COMO RESPUESTA.
                $response->errores[] = "Ocurrió un problema al obtener la solicitud";
            }

            $request->id ? $where = " AND dc.id_detalle_cotizacion=$request->id" : $where = '';


            if (sizeof($response->errores) == 0) {
                if ($query = $this->detalle_cotizacion_model->getDetalleCotizacion($where)) {
                    foreach ($query->result() as $res) {
                        $row = null;
                        $row = new stdClass();
                        $row->id_detalle_cotizacion = $res->ID_DETALLE_COTIZACION;
                        $row->id_cotizacion = $res->ID_COTIZACION;
                        $row->id_categoria = $res->ID_CATEGORIA;
                        $row->id_producto = $res->ID_PRODUCTO;
                        $row->producto = $res->PRODUCTO;
                        $row->cantidad = $res->CANTIDAD;
                        $row->ancho = $res->ANCHO;
                        $row->alto = $res->ALTO;
                        $row->area = $res->AREA;
                        $row->descripcion = $res->DESCRIPCION;
                        $row->imagen = $res->imagen;
                        $row->descripcion_producto = $res->descripcion_producto;
                        $row->tipo_valor = $res->ID_TIPO_VALOR;
                        $row->valor_m2 = $res->VALOR_M2;
                        $row->valor_unitario = $res->VALOR_UNITARIO;
                        $row->valor_adicional = $res->VALOR_ADICIONAL;
                        $row->valor_total = $res->VALOR_TOTAL;
                        $row->fecha_creacion = $res->FECHA_CREACION;
                        $row->estado = $res->ESTADO;

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

    public function insertDetalleCotizacion()
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


            if (!empty($this->input->post('id_cotizacion'))) {
                $request->id_cotizacion = $this->security->xss_clean($this->input->post('id_cotizacion'));
            }

            if (!empty($this->input->post('id_categoria'))) {
                $request->id_categoria = $this->security->xss_clean($this->input->post('id_categoria'));
            }

            if (!empty($this->input->post('id_producto'))) {
                $request->id_producto = $this->security->xss_clean($this->input->post('id_producto'));
            }

            if (!empty($this->input->post('cantidad'))) {
                $request->cantidad = $this->security->xss_clean($this->input->post('cantidad'));
            }

            if (!empty($this->input->post('ancho'))) {
                $request->ancho = $this->security->xss_clean($this->input->post('ancho'));
            }

            if (!empty($this->input->post('alto'))) {
                $request->alto = $this->security->xss_clean($this->input->post('alto'));
            }

            if (!empty($this->input->post('area'))) {
                $request->area = $this->security->xss_clean($this->input->post('area'));
            }

            if ($this->input->post('descripcion') != null || $this->input->post('descripcion') != "" || !empty($this->input->post('descripcion'))) {
                $request->descripcion = $this->security->xss_clean($this->input->post('descripcion'));
            } else if($this->input->post('descripcion') == null || $this->input->post('descripcion') == "" || empty($this->input->post('descripcion'))){
              $request->descripcion = " ";
            }

            if (!empty($this->input->post('tipo_valor'))) {
                $request->id_tipo_valor = $this->security->xss_clean($this->input->post('tipo_valor'));
            }

            if (!empty($this->input->post('valor_m2'))) {
                $request->valor_m2 = $this->security->xss_clean($this->input->post('valor_m2'));
            }

            if (!empty($this->input->post('valor_unitario'))) {
                $request->valor_unitario = $this->security->xss_clean($this->input->post('valor_unitario'));
            }

            if (!empty($this->input->post('valor_adicional'))) {
                $request->valor_adicional = $this->security->xss_clean($this->input->post('valor_adicional'));
            } else {
              $request->valor_adicional = 0;
            }

            if (!empty($this->input->post('valor_total'))) {
                $request->valor_total = $this->security->xss_clean($this->input->post('valor_total'));
            }

            //ALMACENAMOS LOS DATOS QUE VIENEN DEL POST, QUE REEMPLAZARAN A LA FILA ACTUAL EN LA BASE DE DATOS.
            $datos = array(
                'id_cotizacion' => $request->id_cotizacion,
                'id_producto' => $request->id_producto,
                'id_categoria' => $request->id_categoria,
                'cantidad' => $request->cantidad,
                'ancho' => $request->ancho,
                'alto' => $request->alto,
                'area' => $request->area,
                'descripcion' => $request->descripcion,
                'id_tipo_valor' => $request->id_tipo_valor,
                'valor_m2' => $request->valor_m2,
                'valor_unitario' => $request->valor_unitario,
                'valor_adicional' => $request->valor_adicional,
                'valor_total' => $request->valor_total,
                'fecha_creacion' => $fecha,
                'estado' => 1

            );

            //INSERCION, ACTUALIZACION U OPERACIONES
            if ($query = $this->detalle_cotizacion_model->insertDetalleCotizacion('detalle_cotizacion', $datos)) {
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
    public function updateDetalleCotizacion()
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
            if ($this->input->post('id_detalle_cotizacion')) {
                $request->id = trim($this->security->xss_clean($this->input->post('id_detalle_cotizacion', true)));
            } else { //SI NO, ALMACENAMOS EL ERROR EN UN ARRAY PARA DEVOLVERLO COMO RESPUESTA.
                $response->errores[] = "Ocurrió un problema al obtener la solicitud";
            }

            if (sizeof($response->errores) == 0) {
                //VERIFICAMOS LAS VARIABLES QUE RECIBIMOS PARA EDITAR.
                            if (!empty($this->input->post('id_cotizacion'))) {
                                $request->id_cotizacion = $this->security->xss_clean($this->input->post('id_cotizacion'));
                            }

                            if (!empty($this->input->post('id_categoria'))) {
                                $request->id_categoria = $this->security->xss_clean($this->input->post('id_categoria'));
                            }

                            if (!empty($this->input->post('id_producto'))) {
                                $request->id_producto = $this->security->xss_clean($this->input->post('id_producto'));
                            }

                            if (!empty($this->input->post('cantidad'))) {
                                $request->cantidad = $this->security->xss_clean($this->input->post('cantidad'));
                            }

                            if (!empty($this->input->post('ancho'))) {
                                $request->ancho = $this->security->xss_clean($this->input->post('ancho'));
                            }

                            if (!empty($this->input->post('alto'))) {
                                $request->alto = $this->security->xss_clean($this->input->post('alto'));
                            }

                            if (!empty($this->input->post('area'))) {
                                $request->area = $this->security->xss_clean($this->input->post('area'));
                            }

                            if (!empty($this->input->post('descripcion'))) {
                                $request->descripcion = $this->security->xss_clean($this->input->post('descripcion'));
                            }

                            if (!empty($this->input->post('tipo_valor'))) {
                                $request->id_tipo_valor = $this->security->xss_clean($this->input->post('tipo_valor'));
                            }

                            if (!empty($this->input->post('valor_m2'))) {
                                $request->valor_m2 = $this->security->xss_clean($this->input->post('valor_m2'));
                            }

                            if (!empty($this->input->post('valor_unitario'))) {
                                $request->valor_unitario = $this->security->xss_clean($this->input->post('valor_unitario'));
                            }

                            if (!empty($this->input->post('valor_adicional'))) {
                                $request->valor_adicional = $this->security->xss_clean($this->input->post('valor_adicional'));
                            }

                            if (!empty($this->input->post('valor_total'))) {
                                $request->valor_total = $this->security->xss_clean($this->input->post('valor_total'));
                            }


                //ALMACENAMOS LOS DATOS QUE VIENEN DEL POST, QUE REEMPLAZARAN A LA FILA ACTUAL EN LA BASE DE DATOS.
                $datos = array(
                    'id_cotizacion' => $request->id_cotizacion,
                    'id_categoria' => $request->id_categoria,
                    'id_producto' => $request->id_producto,
                    'cantidad' => $request->cantidad,
                    'ancho' => $request->ancho,
                    'alto' => $request->alto,
                    'area' => $request->area,
                    'descripcion' => $request->descripcion,
                    'id_tipo_valor' => $request->id_tipo_valor,
                    'valor_m2' => $request->valor_m2,
                    'valor_unitario' => $request->valor_unitario,
                    'valor_adicional' => $request->valor_adicional,
                    'valor_total' => $request->valor_total,
                    'fecha_modificacion' => $fecha,
                    'estado' => 1
                );
            }


            //SI ES QUE NO HAY ERRORES, PROCEDEMOS A HACER LA PETICION MEDIANTE UN LLAMADO A LA FUNCION DEL MODELO.
            if (sizeof($response->errores) == 0) {
                if ($query = $this->detalle_cotizacion_model->updateDetalleCotizacion('detalle_cotizacion', 'ID_DETALLE_COTIZACION', $datos, $request->id)) {
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

    public function deleteDetalleCotizacion()
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
            if ($this->input->post('id_detalle_cotizacion')) {
                $request->id = $this->security->xss_clean($this->input->post('id_detalle_cotizacion'));
            } else { //SI NO, ALMACENAMOS EL ERROR EN UN ARRAY PARA DEVOLVERLO COMO RESPUESTA.
                $response->errores[] = "Ocurrió un problema al obtener la solicitud";
            }

            $where = " AND id_detalle_cotizacion=$request->id";


            //SI ES QUE NO HAY ERRORES, PROCEDEMOS A HACER LA PETICION MEDIANTE UN LLAMADO A LA FUNCION DEL MODELO.
            if (sizeof($response->errores) == 0) {
                if ($this->detalle_cotizacion_model->updateDetalleCotizacion("detalle_cotizacion", "ID_DETALLE_COTIZACION", array('FECHA_BAJA' => $fecha, "ESTADO" => 0), $request->id)) {
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


    public function deleteDetallesCotizacion(){
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
          if ($this->input->post('id_cotizacion')) {
              $request->id = $this->security->xss_clean($this->input->post('id_cotizacion'));
          } else { //SI NO, ALMACENAMOS EL ERROR EN UN ARRAY PARA DEVOLVERLO COMO RESPUESTA.
              $response->errores[] = "Ocurrió un problema al obtener la solicitud";
          }

          $where = " AND id_cotizacion=$request->id";


          //SI ES QUE NO HAY ERRORES, PROCEDEMOS A HACER LA PETICION MEDIANTE UN LLAMADO A LA FUNCION DEL MODELO.
          if (sizeof($response->errores) == 0) {
              if ($query = $this->detalle_cotizacion_model->deleteDetalles($where, $fecha)) {
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
