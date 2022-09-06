<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cotizacion extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('cotizacion_model');
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
        if ($res = $this->cotizacion_model->getLastId()) {
            foreach ($res->result() as $r) {
                $row = new stdClass();
                $id_cotizacion = $r->LAST_ID;

            }
            $response->proceso = 1;
        }
        echo json_encode($id_cotizacion);
    }

    public function getCotizacion()
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
            if ($query = $this->cotizacion_model->getCotizacion()) {
                foreach ($query->result() as $res) {
                    $row = null;
                    $row = new stdClass();
                    $row->id_cotizacion = $res->ID_COTIZACION;
                    $row->id_cliente = $res->ID_CLIENTE;
                    $row->id_usuario = $res->ID_USUARIO;
                    $row->observacion = $res->OBSERVACION;
                    $row->id_tiempo_entrega = $res->ID_TIEMPO_ENTREGA;
                    $row->tiempo_entrega = $res->tiempo_entrega;
                    $row->id_forma_pago = $res->ID_FORMA_PAGO;
                    $row->id_tipo_impuesto = $res->ID_TIPO_IMPUESTO;
                    $row->tipo_impuesto = $res->tipo_impuesto;
                    $row->enviado_correo = $res->ENVIADO_CORREO;
                    $row->total_neto = $res->TOTAL_NETO;
                    $row->total_iva = $res->TOTAL_IVA;
                    $row->total = $res->TOTAL;
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


    public function getCotizacionTabla()
    {
        if (true) {
            //DECLARACION DE VARIABLES, OBJETOS Y ARRAYS DE [PETICION]
            $request = new stdClass();
            $request->id = null;
            $request->data = [];
            $where = "";

            $fecha = date('Y-m-d H:i:s');

            //DECLARACION DE VARIABLES, OBJETOS Y ARRAYS DE [RESPUESTA]
            $response = new stdClass();
            $response->id = null;
            $response->data = [];
            $response->proceso = 0;
            $response->errores = [];

            if($this->input->post('fecha_inicio') && $this->input->post('fecha_fin')){
              $fecha_inicio = trim($this->security->xss_clean($this->input->post('fecha_inicio', true)));
              $fecha_fin = trim($this->security->xss_clean($this->input->post('fecha_fin', true)));
              $fecha_inicio ? $where .= " AND c.fecha_creacion BETWEEN '$fecha_inicio' AND '$fecha_fin' " : $where .= '';

            } else if ($this->input->post('fecha_inicio') ) {
                $fecha_inicio = trim($this->security->xss_clean($this->input->post('fecha_inicio', true)));
                $fecha_inicio ? $where .= " AND c.fecha_creacion >= '$fecha_inicio' " : $where .= '';

            } else if ($this->input->post('fecha_fin')) {
                $fecha_fin = trim($this->security->xss_clean($this->input->post('fecha_fin', true)));
                $fecha_fin ? $where .= " AND c.fecha_creacion <= '$fecha_fin' " : $where .= '';

            }

            if ($this->input->post('id_tipo_impuesto')) {
                $id_tipo_impuesto = trim($this->security->xss_clean($this->input->post('id_tipo_impuesto', true)));

                $id_tipo_impuesto ? $where .= " AND c.id_tipo_impuesto=$id_tipo_impuesto" : $where .= '';
            }


            if ($query = $this->cotizacion_model->getCotizacionTabla($where)) {
                foreach ($query->result() as $res) {
                    $row = null;
                    $row = new stdClass();
                    $row->id_cotizacion = $res->ID_COTIZACION;
                    $row->id_cliente = $res->ID_CLIENTE;
                    $row->nombre_cliente = $res->NOMBRE_CLIENTE;
                    $row->email_cliente = $res->EMAIL_CLIENTE;
                    $row->rut_empresa = $res->RUT_EMPRESA;
                    $row->nombre_empresa = $res->NOMBRE_EMPRESA;
                    $row->fecha_cotizacion = $res->FECHA_COTIZACION;
                    $row->nro_item = $res->NRO_ITEM;
                    $row->nro_cantidad = $res->NRO_CANTIDAD;
                    $row->id_tipo_impuesto = $res->ID_TIPO_IMPUESTO;
                    $row->tipo_impuesto = $res->TIPO_IMPUESTO;
                    $row->id_tiempo_entrega = $res->ID_TIEMPO_ENTREGA;
                    $row->tiempo_entrega = $res->TIEMPO_ENTREGA;
                    $row->id_forma_pago = $res->ID_FORMA_PAGO;
                    $row->forma_pago = $res->FORMA_PAGO;

                    $row->enviado_correo = $res->ENVIADO_CORREO;
                    $row->total_neto = $res->TOTAL_NETO;
                    $row->total_iva = $res->TOTAL_IVA;
                    $row->total = $res->TOTAL;
                    $row->deuda = 0;
                    $row->fecha_ultima_ot = $res->FECHA_COTIZACION;
                    $row->id_ot = 1;



                    array_push($response->data, $row);
                }
            }
            echo json_encode($response);
        } else {
            redirect('auth/login', 'refresh');
        }
    }

    public function getCotizacionDataFiltro()
    {
        if (true) {
            //DECLARACION DE VARIABLES, OBJETOS Y ARRAYS DE [PETICION]
            $request = new stdClass();
            $request->id = null;
            $request->data = [];
            $where = "";
            $fecha = date('Y-m-d H:i:s');

            //DECLARACION DE VARIABLES, OBJETOS Y ARRAYS DE [RESPUESTA]
            $response = new stdClass();
            $response->id = null;
            $response->data = [];
            $response->proceso = 0;
            $response->errores = [];



            if($this->input->post('fecha_inicio') && $this->input->post('fecha_fin')){
              $fecha_inicio = trim($this->security->xss_clean($this->input->post('fecha_inicio', true)));
              $fecha_fin = trim($this->security->xss_clean($this->input->post('fecha_fin', true)));
              $fecha_inicio ? $where .= " AND c.fecha_creacion BETWEEN '$fecha_inicio' AND '$fecha_fin' " : $where .= '';

            } else if ($this->input->post('fecha_inicio') ) {
                $fecha_inicio = trim($this->security->xss_clean($this->input->post('fecha_inicio', true)));
                $fecha_inicio ? $where .= " AND c.fecha_creacion >= '$fecha_inicio' " : $where .= '';

            } else if ($this->input->post('fecha_fin')) {
                $fecha_fin = trim($this->security->xss_clean($this->input->post('fecha_fin', true)));
                $fecha_fin ? $where .= " AND c.fecha_creacion <= '$fecha_fin' " : $where .= '';

            }

            if ($this->input->post('id_tipo_impuesto')) {
                $id_tipo_impuesto = trim($this->security->xss_clean($this->input->post('id_tipo_impuesto', true)));

                $id_tipo_impuesto ? $where .= " AND c.id_tipo_impuesto=$id_tipo_impuesto" : $where .= '';
            }


            if ($query = $this->cotizacion_model->getCotizacionDataFiltro($where)) {
                foreach ($query->result() as $res) {
                    $row = null;
                    $row = new stdClass();
                    $row->id_cotizacion = $res->ID_COTIZACION;
                    $row->total_neto = $res->TOTAL_NETO;
                    $row->total_iva = $res->TOTAL_IVA;
                    $row->total = $res->TOTAL;

                    array_push($response->data, $row);
                }
            }
            echo json_encode($response);
        } else {
            redirect('auth/login', 'refresh');
        }
    }


    public function getCotizacionById()
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

            if ($this->input->post('id_cotizacion')) {
                $request->id = trim($this->security->xss_clean($this->input->post('id_cotizacion', true)));
            } else { //SI NO, ALMACENAMOS EL ERROR EN UN ARRAY PARA DEVOLVERLO COMO RESPUESTA.
                $response->errores[] = "Ocurrió un problema al obtener la solicitud";
            }

            $request->id ? $where = " AND c.id_cotizacion=$request->id" : $where = '';


            if (sizeof($response->errores) == 0) {
                if ($query = $this->cotizacion_model->getCotizacionById($where)) {
                    foreach ($query->result() as $res) {
                        $row = null;
                        $row = new stdClass();
                        $row->id_cotizacion = $res->ID_COTIZACION;
                        $row->id_cliente = $res->ID_CLIENTE;
                        $row->nombre_cliente = $res->NOMBRE_CLIENTE;
                        $row->email_cliente = $res->EMAIL_CLIENTE;
                        $row->rut_empresa = $res->RUT_EMPRESA;
                        $row->nombre_empresa = $res->NOMBRE_EMPRESA;
                        $row->fecha_cotizacion = $res->FECHA_COTIZACION;
                        $row->nro_item = $res->NRO_ITEM;
                        $row->nro_cantidad = $res->NRO_CANTIDAD;
                        $row->id_tipo_impuesto = $res->ID_TIPO_IMPUESTO;
                        $row->tipo_impuesto = $res->TIPO_IMPUESTO;
                        $row->id_tiempo_entrega = $res->ID_TIEMPO_ENTREGA;
                        $row->tiempo_entrega = $res->TIEMPO_ENTREGA;
                        $row->descripcion_tiempo_entrega = $res->DESCRIPCION_TIEMPO_ENTREGA;
                        $row->id_forma_pago = $res->ID_FORMA_PAGO;
                        $row->forma_pago = $res->FORMA_PAGO;
                        $row->descripcion_forma_pago = $res->DESCRIPCION_FORMA_PAGO;
                        $row->observacion = $res->OBSERVACION;
                        $row->descuento = $res->descuento;
                        $row->enviado_correo = $res->ENVIADO_CORREO;
                        $row->total_neto = $res->TOTAL_NETO;
                        $row->total_iva = $res->TOTAL_IVA;
                        $row->total = $res->TOTAL;
                        $row->deuda = 0;
                        $row->fecha_ultima_ot = $res->FECHA_COTIZACION;
                        $row->id_ot = 1;

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

    public function insertCotizacion()
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

            if (!empty($this->input->post('id_usuario'))) {
                $request->id_usuario = $this->security->xss_clean($this->input->post('id_usuario'));
            }

            if (!empty($this->input->post('observacion'))) {
                $request->observacion = $this->security->xss_clean($this->input->post('observacion'));
            } else {
              $request->observacion = " ";
            }

            if (!empty($this->input->post('id_tiempo_entrega'))) {
                $request->id_tiempo_entrega = $this->security->xss_clean($this->input->post('id_tiempo_entrega'));
            }

            if (!empty($this->input->post('id_forma_pago'))) {
                $request->id_forma_pago = $this->security->xss_clean($this->input->post('id_forma_pago'));
            }

            if (!empty($this->input->post('id_tipo_impuesto'))) {
                $request->id_tipo_impuesto = $this->security->xss_clean($this->input->post('id_tipo_impuesto'));
            }

            if (!empty($this->input->post('descuento'))) {
                $request->descuento = $this->security->xss_clean($this->input->post('descuento'));
            } else {
              $request->descuento = "0";
            }

            if (!empty($this->input->post('enviado_correo'))) {
                $request->enviado_correo = $this->security->xss_clean($this->input->post('enviado_correo'));
            }

            if (!empty($this->input->post('total_neto'))) {
                $request->total_neto = $this->security->xss_clean($this->input->post('total_neto'));
            }

            if (!empty($this->input->post('total_iva'))) {
                $request->total_iva = $this->security->xss_clean($this->input->post('total_iva'));
            } else {
              $request->total_iva = "0";
            }

            if (!empty($this->input->post('total'))) {
                $request->total = $this->security->xss_clean($this->input->post('total'));
            }


            if (!empty($this->input->post('estado'))) {
                $request->estado = $this->security->xss_clean($this->input->post('estado'));
            }

            //ALMACENAMOS LOS DATOS QUE VIENEN DEL POST, QUE REEMPLAZARAN A LA FILA ACTUAL EN LA BASE DE DATOS.
            $datos = array(
                'id_cliente' => $request->id_cliente,
                'id_usuario' => $request->id_usuario,
                'observacion' => $request->observacion,
                'id_tiempo_entrega' => $request->id_tiempo_entrega,
                'id_forma_pago' => $request->id_forma_pago,
                'id_tipo_impuesto' => $request->id_tipo_impuesto,
                'descuento' => $request->descuento,
                'enviado_correo' => $request->enviado_correo,
                'total_neto' => $request->total_neto,
                'total_iva' => $request->total_iva,
                'total' => $request->total,
                'fecha_creacion' => $fecha,
                'estado' => 1

            );

            //INSERCION, ACTUALIZACION U OPERACIONES
            if ($query = $this->cotizacion_model->insertCotizacion('cotizacion', $datos)) {
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
    public function updateCotizacion()
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
            if ($this->input->post('id_cotizacion')) {
                $request->id = trim($this->security->xss_clean($this->input->post('id_cotizacion', true)));
            } else { //SI NO, ALMACENAMOS EL ERROR EN UN ARRAY PARA DEVOLVERLO COMO RESPUESTA.
                $response->errores[] = "Ocurrió un problema al obtener la solicitud";
            }

            if (sizeof($response->errores) == 0) {
                //VERIFICAMOS LAS VARIABLES QUE RECIBIMOS PARA EDITAR.

                if (!empty($this->input->post('id_cliente'))) {
                    $request->id_cliente = $this->security->xss_clean($this->input->post('id_cliente'));
                }

                if (!empty($this->input->post('id_usuario'))) {
                    $request->id_usuario = $this->security->xss_clean($this->input->post('id_usuario'));
                }

                if (!empty($this->input->post('observacion'))) {
                    $request->observacion = $this->security->xss_clean($this->input->post('observacion'));
                } else {
                  $request->observacion = "";
                }

                if (!empty($this->input->post('id_tiempo_entrega'))) {
                    $request->id_tiempo_entrega = $this->security->xss_clean($this->input->post('id_tiempo_entrega'));
                }

                if (!empty($this->input->post('id_forma_pago'))) {
                    $request->id_forma_pago = $this->security->xss_clean($this->input->post('id_forma_pago'));
                }

                if (!empty($this->input->post('id_tipo_impuesto'))) {
                    $request->id_tipo_impuesto = $this->security->xss_clean($this->input->post('id_tipo_impuesto'));
                }

                if (!empty($this->input->post('descuento'))) {
                    $request->descuento = $this->security->xss_clean($this->input->post('descuento'));
                } else {
                  $request->descuento = "0";
                }

                if (!empty($this->input->post('enviado_correo'))) {
                    $request->enviado_correo = $this->security->xss_clean($this->input->post('enviado_correo'));
                }

                if (!empty($this->input->post('total_neto'))) {
                    $request->total_neto = $this->security->xss_clean($this->input->post('total_neto'));
                }

                if (!empty($this->input->post('total_iva'))) {
                    $request->total_iva = $this->security->xss_clean($this->input->post('total_iva'));
                } else {
                  $request->total_iva = "0";
                }

                if (!empty($this->input->post('total'))) {
                    $request->total = $this->security->xss_clean($this->input->post('total'));
                }


                if (!empty($this->input->post('estado'))) {
                    $request->estado = $this->security->xss_clean($this->input->post('estado'));
                }


                //ALMACENAMOS LOS DATOS QUE VIENEN DEL POST, QUE REEMPLAZARAN A LA FILA ACTUAL EN LA BASE DE DATOS.
                $datos = array(
                    'id_cliente' => $request->id_cliente,
                    'id_usuario' => $request->id_usuario,
                    'observacion' => $request->observacion,
                    'id_tiempo_entrega' => $request->id_tiempo_entrega,
                    'id_forma_pago' => $request->id_forma_pago,
                    'id_tipo_impuesto' => $request->id_tipo_impuesto,
                    'descuento' => $request->descuento,
                    'enviado_correo' => $request->enviado_correo,
                    'total_neto' => $request->total_neto,
                    'total_iva' => $request->total_iva,
                    'total' => $request->total,
                    'fecha_modificacion' => $fecha,
                    'estado' => 1
                );
            }


            //SI ES QUE NO HAY ERRORES, PROCEDEMOS A HACER LA PETICION MEDIANTE UN LLAMADO A LA FUNCION DEL MODELO.
            if (sizeof($response->errores) == 0) {
                if ($query = $this->cotizacion_model->updateCotizacion('cotizacion', 'id_cotizacion', $datos, $request->id)) {
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

    public function deleteCotizacion()
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
            if ($this->input->post('id_cotizacion')) {
                $request->id = $this->security->xss_clean($this->input->post('id_cotizacion'));
            } else { //SI NO, ALMACENAMOS EL ERROR EN UN ARRAY PARA DEVOLVERLO COMO RESPUESTA.
                $response->errores[] = "Ocurrió un problema al obtener la solicitud";
            }

            $where = " AND id_cotizacion=$request->id";
            $itemEliminado = $this->cotizacion_model->getCotizacion($where);

            $response->data = $itemEliminado->result();

            //SI ES QUE NO HAY ERRORES, PROCEDEMOS A HACER LA PETICION MEDIANTE UN LLAMADO A LA FUNCION DEL MODELO.
            if (sizeof($response->errores) == 0) {
                if ($this->cotizacion_model->updateCotizacion("cotizacion", "id_cotizacion", array('fecha_baja' => $fecha, "estado" => 0), $request->id)) {
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
