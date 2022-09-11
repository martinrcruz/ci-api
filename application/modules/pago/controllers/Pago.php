<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pago extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('pago_model');
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
        if ($res = $this->pago_model->getLastId()) {
            foreach ($res->result() as $r) {
                $row = new stdClass();
                $id_pago = $r->LAST_ID;
            }
            $response->proceso = 1;
        }
        echo json_encode($id_pago);
    }

    public function getPago()
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
                if ($query = $this->pago_model->getPago()) {
                    foreach ($query->result() as $res) {
                        $row = null;
                        $row = new stdClass();
                        $row->id_pago = $res->ID_PAGO;
                        $row->id_cotizacion = $res->ID_COTIZACION;
                        $row->id_orden_trabajo = $res->ID_ORDEN_TRABAJO;
                        $row->id_tipo_pago = $res->ID_TIPO_PAGO;
                        $row->monto = $res->MONTO;
                        $row->fecha_pago = $res->FECHA_PAGO;
                        $row->banco_origen = $res->BANCO_ORIGEN;
                        $row->nro_orden = $res->NRO_ORDEN;
                        $row->nombre_emitido = $res->NOMBRE_EMITIDO_ORDEN;
                        $row->fecha_cobro = $res->FECHA_COBRO;
                        $row->nro_cheque = $res->NRO_CHEQUE;
                        $row->nombre_titular_cheque = $res->NOMBRE_TITULAR_CHEQUE;
                        $row->tipo_tarjeta = $res->TIPO_TARJETA;
                        $row->nro_operacion = $res->NRO_OPERACION;
                        $row->codigo_autorizacion = $res->CODIGO_AUTORIZACION;
                        $row->otros = $res->OTROS;
                        $row->id_trabajador = $res->ID_TRABAJADOR;
                        $row->fecha = $res->FECHA;

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


    public function getPagoById()
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

            if ($this->input->post('id_pago')) {
                $request->id = $this->security->xss_clean($this->input->post('id_pago'));
            } else { //SI NO, ALMACENAMOS EL ERROR EN UN ARRAY PARA DEVOLVERLO COMO RESPUESTA.
                $response->errores[] = "Ocurrió un problema al obtener la solicitud";
            }

            $request->id ? $where = " AND p.id_pago=$request->id" : $where = '';


            if (sizeof($response->errores) == 0) {
                if ($query = $this->pago_model->getPagoBox($where)) {
                    foreach ($query->result() as $res) {
                        $row = null;
                        $row = new stdClass();
                        $row->id_pago = $res->ID_PAGO;
                        $row->id_cotizacion = $res->ID_COTIZACION;
                        $row->id_orden_trabajo = $res->ID_ORDEN_TRABAJO;
                        $row->id_tipo_pago = $res->ID_TIPO_PAGO;
                        $row->monto = $res->MONTO;
                        $row->fecha_pago = $res->FECHA_PAGO;
                        $row->banco_origen = $res->BANCO_ORIGEN;
                        $row->nro_orden = $res->NRO_ORDEN;
                        $row->nombre_emitido = $res->NOMBRE_EMITIDO_ORDEN;
                        $row->fecha_cobro = $res->FECHA_COBRO;
                        $row->nro_cheque = $res->NRO_CHEQUE;
                        $row->nombre_titular_cheque = $res->NOMBRE_TITULAR_CHEQUE;
                        $row->tipo_tarjeta = $res->TIPO_TARJETA;
                        $row->nro_operacion = $res->NRO_OPERACION;
                        $row->codigo_autorizacion = $res->CODIGO_AUTORIZACION;
                        $row->otros = $res->OTROS;
                        $row->id_trabajador = $res->ID_TRABAJADOR;
                        $row->fecha = $res->FECHA;


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


    public function getPagoByOrdenTrabajoId()
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



            if ($this->input->post('id_orden_trabajo')) {
                $request->id_orden_trabajo = $this->security->xss_clean($this->input->post('id_orden_trabajo'));
            } else { //SI NO, ALMACENAMOS EL ERROR EN UN ARRAY PARA DEVOLVERLO COMO RESPUESTA.
                $response->errores[] = "Ocurrió un problema al obtener el id_orden_trabajo";
            }

            $request->id_orden_trabajo ? $where .= " AND ot.id_orden_trabajo=$request->id_orden_trabajo" : $where = '';



            if (sizeof($response->errores) == 0) {
                if ($query = $this->pago_model->getPagoByOrden($where)) {
                    foreach ($query->result() as $res) {
                        $row = null;
                        $row = new stdClass();
                        $row->id_pago = $res->ID_PAGO;
                        $row->id_cotizacion = $res->ID_COTIZACION;
                        $row->id_orden_trabajo = $res->ID_ORDEN_TRABAJO;
                        $row->id_tipo_pago = $res->ID_TIPO_PAGO;
                        $row->tipo_pago = $res->tipo_pago;
                        $row->monto = $res->MONTO;
                        $row->fecha_pago = $res->FECHA_PAGO;
                        $row->banco_origen = $res->BANCO_ORIGEN;
                        $row->nro_orden = $res->NRO_ORDEN;
                        $row->nombre_emitido = $res->NOMBRE_EMITIDO_ORDEN;
                        $row->fecha_cobro = $res->FECHA_COBRO;
                        $row->nro_cheque = $res->NRO_CHEQUE;
                        $row->nombre_titular_cheque = $res->NOMBRE_TITULAR_CHEQUE;
                        $row->tipo_tarjeta = $res->TIPO_TARJETA;
                        $row->nro_operacion = $res->NRO_OPERACION;
                        $row->codigo_autorizacion = $res->CODIGO_AUTORIZACION;
                        $row->otros = $res->OTROS;
                        $row->id_trabajador = $res->ID_TRABAJADOR;
                        $row->nombre_trabajador = $res->nombre_trabajador;
                        $row->fecha = $res->FECHA;

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

    public function insertPago()
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
            } else {
                $request->id_cotizacion = null;
            }

            if (!empty($this->input->post('id_orden_trabajo'))) {
                $request->id_orden_trabajo = $this->security->xss_clean($this->input->post('id_orden_trabajo'));
            } else {
                $request->id_orden_trabajo = null;
            }

            if (!empty($this->input->post('id_tipo_pago'))) {
                $request->id_tipo_pago = $this->security->xss_clean($this->input->post('id_tipo_pago'));
            } else {
                $request->id_tipo_pago = null;
            }

            if (!empty($this->input->post('monto'))) {
                $request->monto = $this->security->xss_clean($this->input->post('monto'));
            } else {
                $request->monto = null;
            }

            if (!empty($this->input->post('fecha_pago'))) {
                $request->fecha_pago = $this->security->xss_clean($this->input->post('fecha_pago'));
            } else {
                $request->fecha_pago = null;
            }

            if (!empty($this->input->post('banco_origen'))) {
                $request->banco_origen = $this->security->xss_clean($this->input->post('banco_origen'));
            } else {
                $request->banco_origen = null;
            }

            if (!empty($this->input->post('nro_orden'))) {
                $request->nro_orden = $this->security->xss_clean($this->input->post('nro_orden'));
            } else {
                $request->nro_orden = null;
            }

            if (!empty($this->input->post('nombre_emitido'))) {
                $request->nombre_emitido = $this->security->xss_clean($this->input->post('nombre_emitido'));
            } else {
                $request->nombre_emitido = null;
            }

            if (!empty($this->input->post('fecha_cobro'))) {
                $request->fecha_cobro = $this->security->xss_clean($this->input->post('fecha_cobro'));
            } else {
                $request->fecha_cobro = null;
            }

            if (!empty($this->input->post('nro_cheque'))) {
                $request->nro_cheque = $this->security->xss_clean($this->input->post('nro_cheque'));
            } else {
                $request->nro_cheque = null;
            }

            if (!empty($this->input->post('nombre_titular_cheque'))) {
                $request->nombre_titular_cheque = $this->security->xss_clean($this->input->post('nombre_titular_cheque'));
            } else {
                $request->nombre_titular_cheque = null;
            }

            if (!empty($this->input->post('tipo_tarjeta'))) {
                $request->tipo_tarjeta = $this->security->xss_clean($this->input->post('tipo_tarjeta'));
            } else {
                $request->tipo_tarjeta = null;
            }

            if (!empty($this->input->post('nro_operacion'))) {
                $request->nro_operacion = $this->security->xss_clean($this->input->post('nro_operacion'));
            } else {
                $request->nro_operacion = null;
            }

            if (!empty($this->input->post('codigo_autorizacion'))) {
                $request->codigo_autorizacion = $this->security->xss_clean($this->input->post('codigo_autorizacion'));
            } else {
                $request->codigo_autorizacion = null;
            }

            if (!empty($this->input->post('otros'))) {
                $request->otros = $this->security->xss_clean($this->input->post('otros'));
            } else {
                $request->otros = null;
            }

            if (!empty($this->input->post('id_trabajador'))) {
                $request->id_trabajador = $this->security->xss_clean($this->input->post('id_trabajador'));
            }

       




            //ALMACENAMOS LOS DATOS QUE VIENEN DEL POST, QUE REEMPLAZARAN A LA FILA ACTUAL EN LA BASE DE DATOS.
            $datos = array(
                'id_cotizacion' => $request->id_cotizacion,
                'id_orden_trabajo' => $request->id_orden_trabajo,
                'id_tipo_pago' => $request->id_tipo_pago,
                'monto' => $request->monto,
                'fecha_pago' => $request->fecha_pago,
                'banco_origen' => $request->banco_origen,
                'nro_orden' => $request->nro_orden,
                'nombre_emitido_orden' => $request->nombre_emitido,
                'fecha_cobro' => $request->fecha_cobro,
                'nro_cheque' => $request->nro_cheque,
                'nombre_titular_cheque' => $request->nombre_titular_cheque,
                'tipo_tarjeta' => $request->tipo_tarjeta,
                'nro_operacion' => $request->nro_operacion,
                'codigo_autorizacion' => $request->codigo_autorizacion,
                'otros' => $request->otros,
                'id_trabajador' => $request->id_trabajador,
                'fecha' => $fecha,
                'fecha_creacion' => $fecha,
                'estado' => 1

            );

            //INSERCION, ACTUALIZACION U OPERACIONES
            if ($query = $this->pago_model->insertPago('pago', $datos)) {
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
    public function updatePago()
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
            if ($this->input->post('id_pago')) {
                $request->id = trim($this->security->xss_clean($this->input->post('id_pago', true)));
            } else { //SI NO, ALMACENAMOS EL ERROR EN UN ARRAY PARA DEVOLVERLO COMO RESPUESTA.
                $response->errores[] = "Ocurrió un problema al obtener la solicitud";
            }

            if (sizeof($response->errores) == 0) {
                //VERIFICAMOS LAS VARIABLES QUE RECIBIMOS PARA EDITAR.

                if (!empty($this->input->post('id_cotizacion'))) {
                    $request->id_cotizacion = $this->security->xss_clean($this->input->post('id_cotizacion'));
                } else {
                    $request->id_cotizacion = null;
                }

                if (!empty($this->input->post('id_orden_trabajo'))) {
                    $request->id_orden_trabajo = $this->security->xss_clean($this->input->post('id_orden_trabajo'));
                } else {
                    $request->id_orden_trabajo = null;
                }

                if (!empty($this->input->post('id_tipo_pago'))) {
                    $request->id_tipo_pago = $this->security->xss_clean($this->input->post('id_tipo_pago'));
                } else {
                    $request->id_tipo_pago = null;
                }

                if (!empty($this->input->post('monto'))) {
                    $request->monto = $this->security->xss_clean($this->input->post('monto'));
                } else {
                    $request->monto = null;
                }

                if (!empty($this->input->post('fecha_pago'))) {
                    $request->fecha_pago = $this->security->xss_clean($this->input->post('fecha_pago'));
                } else {
                    $request->fecha_pago = null;
                }

                if (!empty($this->input->post('banco_origen'))) {
                    $request->banco_origen = $this->security->xss_clean($this->input->post('banco_origen'));
                } else {
                    $request->banco_origen = null;
                }

                if (!empty($this->input->post('nro_orden'))) {
                    $request->nro_orden = $this->security->xss_clean($this->input->post('nro_orden'));
                } else {
                    $request->nro_orden = null;
                }

                if (!empty($this->input->post('nombre_emitido'))) {
                    $request->nombre_emitido = $this->security->xss_clean($this->input->post('nombre_emitido'));
                } else {
                    $request->nombre_emitido = null;
                }

                if (!empty($this->input->post('fecha_cobro'))) {
                    $request->fecha_cobro = $this->security->xss_clean($this->input->post('fecha_cobro'));
                } else {
                    $request->fecha_cobro = null;
                }

                if (!empty($this->input->post('nro_cheque'))) {
                    $request->nro_cheque = $this->security->xss_clean($this->input->post('nro_cheque'));
                } else {
                    $request->nro_cheque = null;
                }

                if (!empty($this->input->post('nombre_titular_cheque'))) {
                    $request->nombre_titular_cheque = $this->security->xss_clean($this->input->post('nombre_titular_cheque'));
                } else {
                    $request->nombre_titular_cheque = null;
                }

                if (!empty($this->input->post('tipo_tarjeta'))) {
                    $request->tipo_tarjeta = $this->security->xss_clean($this->input->post('tipo_tarjeta'));
                } else {
                    $request->tipo_tarjeta = null;
                }

                if (!empty($this->input->post('nro_operacion'))) {
                    $request->nro_operacion = $this->security->xss_clean($this->input->post('nro_operacion'));
                } else {
                    $request->nro_operacion = null;
                }

                if (!empty($this->input->post('codigo_autorizacion'))) {
                    $request->codigo_autorizacion = $this->security->xss_clean($this->input->post('codigo_autorizacion'));
                } else {
                    $request->codigo_autorizacion = null;
                }

                if (!empty($this->input->post('otros'))) {
                    $request->otros = $this->security->xss_clean($this->input->post('otros'));
                } else {
                    $request->otros = null;
                }

                if (!empty($this->input->post('id_trabajador'))) {
                    $request->id_trabajador = $this->security->xss_clean($this->input->post('id_trabajador'));
                }

                if (!empty($this->input->post('fecha'))) {
                    $request->fecha = $this->security->xss_clean($this->input->post('fecha'));
                }else {
                    $request->fecha = null;
                }



                //ALMACENAMOS LOS DATOS QUE VIENEN DEL POST, QUE REEMPLAZARAN A LA FILA ACTUAL EN LA BASE DE DATOS.
                $datos = array(
                    'id_cotizacion' => $request->id_cotizacion,
                    'id_orden_trabajo' => $request->id_orden_trabajo,
                    'id_tipo_pago' => $request->id_tipo_pago,
                    'monto' => $request->monto,
                    'fecha_pago' => $request->fecha_pago,
                    'banco_origen' => $request->banco_origen,
                    'nro_orden' => $request->nro_orden,
                    'nombre_emitido_orden' => $request->nombre_emitido,
                    'fecha_cobro' => $request->fecha_cobro,
                    'nro_cheque' => $request->nro_cheque,
                    'nombre_titular_cheque' => $request->nombre_titular_cheque,
                    'tipo_tarjeta' => $request->tipo_tarjeta,
                    'nro_operacion' => $request->nro_operacion,
                    'codigo_autorizacion' => $request->codigo_autorizacion,
                    'otros' => $request->otros,
                    'id_trabajador' => $request->id_trabajador,
                    'fecha' => $fecha,
                    'fecha_modificacion' => $fecha
                );
            }


            //SI ES QUE NO HAY ERRORES, PROCEDEMOS A HACER LA PETICION MEDIANTE UN LLAMADO A LA FUNCION DEL MODELO.
            if (sizeof($response->errores) == 0) {
                if ($query = $this->pago_model->updatePago('pago', 'id_pago', $datos, $request->id)) {
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

    public function deletePago()
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
            if ($this->input->post('id_pago')) {
                $request->id = $this->security->xss_clean($this->input->post('id_pago'));
            } else { //SI NO, ALMACENAMOS EL ERROR EN UN ARRAY PARA DEVOLVERLO COMO RESPUESTA.
                $response->errores[] = "Ocurrió un problema al obtener la solicitud";
            }

            $where = " AND id_pago=$request->id";
            $itemEliminado = $this->pago_model->getPago($where);

            $response->data = $itemEliminado->result();

            //SI ES QUE NO HAY ERRORES, PROCEDEMOS A HACER LA PETICION MEDIANTE UN LLAMADO A LA FUNCION DEL MODELO.
            if (sizeof($response->errores) == 0) {
                if ($this->pago_model->updatePago("pago", "id_pago", array('fecha_baja' => $fecha, "estado" => 0), $request->id)) {
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
