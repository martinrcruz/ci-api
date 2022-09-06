<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Orden_trabajo extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('orden_trabajo_model');
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
        if ($res = $this->orden_trabajo_model->getLastId()) {
            foreach ($res->result() as $r) {
                $row = new stdClass();
                $id_orden_trabajo = $r->LAST_ID;

            }
            $response->proceso = 1;
        }
        echo json_encode($id_orden_trabajo);
    }


    public function getOrdenTrabajo()
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

            if ($query = $this->orden_trabajo_model->getOrdenTrabajo()) {
                foreach ($query->result() as $res) {
                    $row = null;
                    $row = new stdClass();
                    $row->id_orden_trabajo = $res->id_orden_trabajo;
                    $row->id_cliente = $res->id_cliente;
                    $row->id_usuario = $res->id_usuario;
                    $row->observacion = $res->observacion;
                    $row->timepo_entrega = $res->timepo_entrega;
                    $row->id_pago_orden_trabajo = $res->id_pago_orden_trabajo;
                    $row->id_tipo_impuesto = $res->id_tipo_impuesto;
                    $row->descuento = $res->descuento;
                    $row->enviado_correo = $res->enviado_correo;
                    $row->total_neto = $res->total_neto;
                    $row->total_iva = $res->total_iva;
                    $row->total = $res->total;
                    $row->fecha_orden_trabajo = $res->fecha_orden_trabajo;
                    $row->fecha_creacion = $res->fecha_creacion;
                    $row->estado = $res->estado;


                    array_push($response->data, $row);
                }
            }
            echo json_encode($response);
        } else {
            redirect('auth/login', 'refresh');
        }
    }

    public function getOrdenTrabajoTabla()
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
              $fecha_inicio ? $where .= " AND ot.fecha_creacion BETWEEN '$fecha_inicio' AND '$fecha_fin' " : $where .= '';

            } else if ($this->input->post('fecha_inicio') ) {
                $fecha_inicio = trim($this->security->xss_clean($this->input->post('fecha_inicio', true)));
                $fecha_inicio ? $where .= " AND ot.fecha_creacion >= '$fecha_inicio' " : $where .= '';

            } else if ($this->input->post('fecha_fin')) {
                $fecha_fin = trim($this->security->xss_clean($this->input->post('fecha_fin', true)));
                $fecha_fin ? $where .= " AND ot.fecha_creacion <= '$fecha_fin' " : $where .= '';

            }

            if ($this->input->post('id_tipo_impuesto')) {
                $id_tipo_impuesto = trim($this->security->xss_clean($this->input->post('id_tipo_impuesto', true)));

                $id_tipo_impuesto ? $where .= " AND ot.id_tipo_impuesto=$id_tipo_impuesto" : $where .= '';
            }


            if ($query = $this->orden_trabajo_model->getOrdenTrabajoTabla($where)) {
                foreach ($query->result() as $res) {
                    $row = null;
                    $row = new stdClass();
                    $row->id_orden_trabajo = $res->ID_ORDEN_TRABAJO;
                    $row->id_cliente = $res->ID_CLIENTE;
                    $row->nombre_cliente = $res->NOMBRE_CLIENTE;
                    $row->email_cliente = $res->EMAIL_CLIENTE;
                    $row->rut_empresa = $res->RUT_EMPRESA;
                    $row->nombre_empresa = $res->NOMBRE_EMPRESA;
                    $row->fecha_orden_trabajo = $res->FECHA_ORDEN_TRABAJO;
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
                    $row->fecha_ultima_ot = $res->FECHA_ORDEN_TRABAJO;
                    $row->id_ot = 1;



                    array_push($response->data, $row);
                }
            }
            echo json_encode($response);
        } else {
            redirect('auth/login', 'refresh');
        }
    }


    public function getOrdenTrabajoById()
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

            if (is_numeric($this->input->post('id_orden_trabajo'))) {
                $request->id = trim($this->security->xss_clean($this->input->post('id_orden_trabajo', true)));
            } else { //SI NO, ALMACENAMOS EL ERROR EN UN ARRAY PARA DEVOLVERLO COMO RESPUESTA.
                $response->errores[] = "Ocurrió un problema al obtener la solicitud";
            }

            $request->id ? $where = " AND id_orden_trabajo=$request->id" : $where = '';


            if (sizeof($response->errores) == 0) {
                if ($query = $this->orden_trabajo_model->getOrdenTrabajo($where)) {
                    foreach ($query->result() as $res) {
                        $row = null;
                        $row = new stdClass();
                        $row->id_orden_trabajo = $res->ID_ORDEN_TRABAJO;
                        $row->id_cliente = $res->ID_CLIENTE;
                        $row->fecha_orden_trabajo = $res->FECHA_ORDEN_TRABAJO;
                        $row->observacion = $res->OBSERVACION;
                        $row->id_tipo_impuesto = $res->ID_TIPO_IMPUESTO;
                        $row->id_tiempo_entrega = $res->ID_TIEMPO_ENTREGA;
                        $row->tiempo_entrega = $res->tiempo_entrega;
                        $row->id_forma_pago = $res->ID_FORMA_PAGO;
                        $row->descuento = $res->DESCUENTO;
                        $row->enviado_correo = $res->ENVIADO_CORREO;
                        $row->total_neto = $res->TOTAL_NETO;
                        $row->total_iva = $res->TOTAL_IVA;
                        $row->total = $res->TOTAL;
                        $row->deuda = 0;
                        $row->fecha_ultima_ot = $res->FECHA_ORDEN_TRABAJO;
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

    public function insertOrdenTrabajo()
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
            }

            if (!empty($this->input->post('id_tiempo_entrega'))) {
                $request->id_tiempo_entrega = $this->security->xss_clean($this->input->post('id_tiempo_entrega'));
            }

            if (!empty($this->input->post('id_forma_pago'))) {
                $request->id_forma_pago = $this->security->xss_clean($this->input->post('id_forma_pago'));
            }


            if (!empty($this->input->post('id_pago_orden_trabajo'))) {
                $request->id_pago_orden_trabajo = $this->security->xss_clean($this->input->post('id_pago_orden_trabajo'));
            }

            if (!empty($this->input->post('id_tipo_impuesto'))) {
                $request->id_tipo_impuesto = $this->security->xss_clean($this->input->post('id_tipo_impuesto'));
            }

            if (!empty($this->input->post('descuento'))) {
                $request->descuento = $this->security->xss_clean($this->input->post('descuento'));
            } else {
                $request->descuento = " ";
            }

            if (!empty($this->input->post('enviado_correo'))) {
                $request->enviado_correo = $this->security->xss_clean($this->input->post('enviado_correo'));
            }

            if (!empty($this->input->post('total_neto'))) {
                $request->total_neto = $this->security->xss_clean($this->input->post('total_neto'));
            }

            if (!empty($this->input->post('total_iva'))) {
                $request->total_iva = $this->security->xss_clean($this->input->post('total_iva'));
            }

            if (!empty($this->input->post('total'))) {
                $request->total = $this->security->xss_clean($this->input->post('total'));
            }

            if (!empty($this->input->post('fecha_orden_trabajo'))) {
                $request->fecha_orden_trabajo = $this->security->xss_clean($this->input->post('fecha_orden_trabajo'));
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
                'id_pago_orden_trabajo' => $request->id_pago_orden_trabajo,
                'id_tipo_impuesto' => $request->id_tipo_impuesto,
                'descuento' => $request->descuento,
                'enviado_correo' => $request->enviado_correo,
                'total_neto' => $request->total_neto,
                'total_iva' => $request->total_iva,
                'total' => $request->total,
                'fecha_orden_trabajo' => $fecha,
                'fecha_creacion' => $fecha,
                'estado' => 1

            );

            //INSERCION, ACTUALIZACION U OPERACIONES
            if ($query = $this->orden_trabajo_model->insertOrdenTrabajo('orden_trabajo', $datos)) {
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
    public function updateOrdenTrabajo()
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
            if ($this->input->post('id_orden_trabajo')) {
                $request->id = trim($this->security->xss_clean($this->input->post('id_orden_trabajo', true)));
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
                }

                if (!empty($this->input->post('tiempo_entrega'))) {
                    $request->tiempo_entrega = $this->security->xss_clean($this->input->post('tiempo_entrega'));
                }

                if (!empty($this->input->post('id_pago_orden_trabajo'))) {
                    $request->id_pago_orden_trabajo = $this->security->xss_clean($this->input->post('id_pago_orden_trabajo'));
                } else {
                    $request->id_pago_orden_trabajo = " ";
                }

                if (!empty($this->input->post('id_tipo_impuesto'))) {
                    $request->id_tipo_impuesto = $this->security->xss_clean($this->input->post('id_tipo_impuesto'));
                }

                if (!empty($this->input->post('descuento'))) {
                    $request->descuento = $this->security->xss_clean($this->input->post('descuento'));
                }

                if (!empty($this->input->post('enviado_correo'))) {
                    $request->enviado_correo = $this->security->xss_clean($this->input->post('enviado_correo'));
                }

                if (!empty($this->input->post('total_neto'))) {
                    $request->total_neto = $this->security->xss_clean($this->input->post('total_neto'));
                }

                if (!empty($this->input->post('total_iva'))) {
                    $request->total_iva = $this->security->xss_clean($this->input->post('total_iva'));
                }

                if (!empty($this->input->post('total'))) {
                    $request->total = $this->security->xss_clean($this->input->post('total'));
                }

                if (!empty($this->input->post('fecha_orden_trabajo'))) {
                    $request->fecha_orden_trabajo = $this->security->xss_clean($this->input->post('fecha_orden_trabajo'));
                }

                if (!empty($this->input->post('estado'))) {
                    $request->estado = $this->security->xss_clean($this->input->post('estado'));
                }


                //ALMACENAMOS LOS DATOS QUE VIENEN DEL POST, QUE REEMPLAZARAN A LA FILA ACTUAL EN LA BASE DE DATOS.
                $datos = array(
                    'id_cliente' => $request->id_cliente,
                    'id_usuario' => $request->id_usuario,
                    'observacion' => $request->observacion,
                    'tiempo_entrega' => $request->tiempo_entrega,
                    'id_pago_orden_trabajo' => $request->id_pago_orden_trabajo,
                    'id_tipo_impuesto' => $request->id_tipo_impuesto,
                    'descuento' => $request->descuento,
                    'enviado_correo' => $request->enviado_correo,
                    'total_neto' => $request->total_neto,
                    'total_iva' => $request->total_iva,
                    'total' => $request->total,
                    'fecha_orden_trabajo' => $request->fecha_orden_trabajo,
                    'fecha_modificacion' => $fecha,
                    'estado' => 1
                );
            }


            //SI ES QUE NO HAY ERRORES, PROCEDEMOS A HACER LA PETICION MEDIANTE UN LLAMADO A LA FUNCION DEL MODELO.
            if (sizeof($response->errores) == 0) {
                if ($query = $this->orden_trabajo_model->updateOrdenTrabajo('orden_trabajo', 'id_orden_trabajo', $datos, $request->id)) {
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

    public function deleteOrdenTrabajo()
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
            if ($this->input->post('id_orden_trabajo')) {
                $request->id = $this->security->xss_clean($this->input->post('id_orden_trabajo'));
            } else { //SI NO, ALMACENAMOS EL ERROR EN UN ARRAY PARA DEVOLVERLO COMO RESPUESTA.
                $response->errores[] = "Ocurrió un problema al obtener la solicitud";
            }

            $where = " AND id_orden_trabajo=$request->id";
            $itemEliminado = $this->orden_trabajo_model->getOrdenTrabajo($where);

            $response->data = $itemEliminado->result();

            //SI ES QUE NO HAY ERRORES, PROCEDEMOS A HACER LA PETICION MEDIANTE UN LLAMADO A LA FUNCION DEL MODELO.
            if (sizeof($response->errores) == 0) {
                if ($this->orden_trabajo_model->updateOrdenTrabajo("orden_trabajo", "id_orden_trabajo", array('fecha_baja' => $fecha, "estado" => 0), $request->id)) {
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
