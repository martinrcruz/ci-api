<?php

class Orden_trabajo_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getOrdenTrabajo($where = '')
    {
        $sql = "SELECT *,
        te.nombre as tiempo_entrega,
        ti.nombre as tipo_impuesto
        FROM orden_trabajo ot
        JOIN  tiempo_entrega te ON ot.ID_TIEMPO_ENTREGA=te.ID_TIEMPO_ENTREGA
        JOIN tipo_impuesto ti ON ot.ID_TIPO_IMPUESTO=ti.ID_TIPO_IMPUESTO
        WHERE ot.ESTADO=1 $where
        ORDER BY id_orden_trabajo DESC;";
        $query = $this->db->query($sql);
        // var_dump($this->db->last_query());

        if ($query->num_rows() > 0)
            return $query;
        else
            return false;
    }

    public function getOrdenTrabajoTabla($where = '')
    {
        $sql = "SELECT ot.id_orden_trabajo as ID_ORDEN_TRABAJO,
        cl.id_cliente as ID_CLIENTE,
        cl.nombre as NOMBRE_CLIENTE,
        cl.correo as EMAIL_CLIENTE,
        em.rut as RUT_EMPRESA,
        em.nombre as NOMBRE_EMPRESA,
        DATE_FORMAT(OT.FECHA_CREACION, '%d/%m/%Y') as FECHA_ORDEN_TRABAJO,
        COUNT(dot.ID_PRODUCTO) as NRO_ITEM,
        SUM(dot.CANTIDAD) as NRO_CANTIDAD,
        ot.id_tipo_impuesto as ID_TIPO_IMPUESTO,
        ti.nombre as TIPO_IMPUESTO,
        ot.id_forma_pago as ID_FORMA_PAGO,
        fp.nombre as FORMA_PAGO,
        ot.enviado_correo AS ENVIADO_CORREO,
        ot.TOTAL_NETO as TOTAL_NETO,
        ot.TOTAL_IVA as TOTAL_IVA,
        ot.TOTAL as TOTAL,
        ot.id_tiempo_entrega as ID_TIEMPO_ENTREGA,
        te.nombre as TIEMPO_ENTREGA

        FROM orden_trabajo ot
        LEFT JOIN tiempo_entrega te ON ot.ID_TIEMPO_ENTREGA=te.ID_TIEMPO_ENTREGA
        LEFT JOIN tipo_impuesto ti ON ot.ID_TIPO_IMPUESTO=ti.ID_TIPO_IMPUESTO
        LEFT JOIN cliente cl ON cl.ID_CLIENTE=ot.ID_CLIENTE
        LEFT JOIN empresa em ON em.ID_EMPRESA=cl.ID_EMPRESA
        LEFT JOIN detalle_orden_trabajo dot ON dot.ID_ORDEN_TRABAJO=ot.ID_ORDEN_TRABAJO
        LEFT JOIN forma_pago fp ON fp.ID_FORMA_PAGO=ot.ID_FORMA_PAGO
        WHERE ot.ESTADO=1 $where
        GROUP BY ot.id_orden_trabajo
        ORDER BY ot.id_orden_trabajo DESC;";
        $query = $this->db->query($sql);
        // var_dump($this->db->last_query());

        if ($query->num_rows() > 0)
            return $query;
        else
            return false;
    }

    public function getOrdenTrabajoDataFiltro($where = '')
    {
        $sql = "SELECT
        SUM(ot.TOTAL_NETO) as TOTAL_NETO,
        SUM(ot.TOTAL_IVA) as TOTAL_IVA,
        SUM(ot.TOTAL) as TOTAL

        FROM orden_trabajo ot
        WHERE ot.ESTADO=1 $where
        GROUP BY ot.id_orden_trabajo
        ORDER BY ot.id_orden_trabajo DESC;";
        $query = $this->db->query($sql);
        // var_dump($this->db->last_query());

        if ($query->num_rows() > 0)
            return $query;
        else
            return false;
    }

    public function getOrdenTrabajoById($where = '')
    {
        $sql = "SELECT ot.id_orden_trabajo as ID_ORDEN_TRABAJO,
        ot.OBSERVACION as OBSERVACION,
        ot.descuento as descuento,
        cl.id_cliente as ID_CLIENTE,
        cl.nombre as NOMBRE_CLIENTE,
        cl.correo as EMAIL_CLIENTE,
        em.rut as RUT_EMPRESA,
        em.nombre as NOMBRE_EMPRESA,
        DATE_FORMAT(C.FECHA_CREACION, '%d/%m/%Y') as FECHA_COTIZACION,
        COUNT(dot.ID_PRODUCTO) as NRO_ITEM,
        SUM(dot.CANTIDAD) as NRO_CANTIDAD,
        ot.id_tipo_impuesto as ID_TIPO_IMPUESTO,
        ti.nombre as TIPO_IMPUESTO,
        ot.id_forma_pago as ID_FORMA_PAGO,
        fp.nombre as FORMA_PAGO,
        fp.descripcion as DESCRIPCION_FORMA_PAGO,
        ot.enviado_correo AS ENVIADO_CORREO,
        ot.TOTAL_NETO as TOTAL_NETO,
        ot.TOTAL_IVA as TOTAL_IVA,
        ot.TOTAL as TOTAL,
        ot.id_tiempo_entrega as ID_TIEMPO_ENTREGA,
        te.nombre as TIEMPO_ENTREGA,
        te.descripcion as DESCRIPCION_TIEMPO_ENTREGA

        FROM orden_trabajo ot
        JOIN tiempo_entrega te ON ot.ID_TIEMPO_ENTREGA=te.ID_TIEMPO_ENTREGA
        JOIN tipo_impuesto ti ON ot.ID_TIPO_IMPUESTO=ti.ID_TIPO_IMPUESTO
        JOIN cliente cl ON cl.ID_CLIENTE=ot.ID_CLIENTE
        JOIN empresa em ON em.ID_EMPRESA=cl.ID_EMPRESA
        JOIN detalle_orden_trabajo dot ON dot.ID_ORDEN_TRABAJO=ot.ID_ORDEN_TRABAJO
        JOIN forma_pago fp ON fp.ID_FORMA_PAGO=ot.ID_FORMA_PAGO
        WHERE ot.ESTADO=1 $where
        GROUP BY ot.id_orden_trabajo
        ORDER BY ot.id_orden_trabajo DESC;";
        $query = $this->db->query($sql);
        // var_dump($this->db->last_query());

        if ($query->num_rows() > 0)
            return $query;
        else
            return false;
    }

    public function getLastId()
    {
        $sql = "SELECT MAX(id_orden_trabajo) as LAST_ID
        FROM orden_trabajo;";
        $query = $this->db->query($sql);
        // var_dump($this->db->last_query());

        if ($query->num_rows() > 0)
            return $query;
        else
            return false;
    }

    public function insertOrdenTrabajo($tabla, $data)
    {
        $query = $this->db->insert($tabla, $data);
        if ($query)
            return $this->db->insert_id();
        else
            return false;
    }
    
    public function updateOrdenTrabajo($tabla, $comparar, $datos, $id)
    {
        $this->db->where($comparar, $id);
        $result = $this->db->update($tabla, $datos);
        if ($result)
            return true;
        else
            return false;
    }

}
