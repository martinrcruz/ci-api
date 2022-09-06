<?php

class Cotizacion_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getCotizacion($where = '')
    {
        $sql = "SELECT *,
        te.nombre as tiempo_entrega,
        ti.nombre as tipo_impuesto
        FROM cotizacion c
        JOIN  tiempo_entrega te ON c.ID_TIEMPO_ENTREGA=te.ID_TIEMPO_ENTREGA
        JOIN tipo_impuesto ti ON c.ID_TIPO_IMPUESTO=ti.ID_TIPO_IMPUESTO
        WHERE c.ESTADO=1 $where
        ORDER BY id_cotizacion DESC;";
        $query = $this->db->query($sql);
        // var_dump($this->db->last_query());

        if ($query->num_rows() > 0)
            return $query;
        else
            return false;
    }

    public function getCotizacionTabla($where = '')
    {
        $sql = "SELECT c.id_cotizacion as ID_COTIZACION,
        cl.id_cliente as ID_CLIENTE,
        cl.nombre as NOMBRE_CLIENTE,
        cl.correo as EMAIL_CLIENTE,
        em.rut as RUT_EMPRESA,
        em.nombre as NOMBRE_EMPRESA,
        DATE_FORMAT(C.FECHA_CREACION, '%d/%m/%Y') as FECHA_COTIZACION,
        COUNT(dc.ID_PRODUCTO) as NRO_ITEM,
        SUM(dc.CANTIDAD) as NRO_CANTIDAD,
        c.id_tipo_impuesto as ID_TIPO_IMPUESTO,
        ti.nombre as TIPO_IMPUESTO,
        c.id_forma_pago as ID_FORMA_PAGO,
        fp.nombre as FORMA_PAGO,
        c.enviado_correo AS ENVIADO_CORREO,
        c.TOTAL_NETO as TOTAL_NETO,
        c.TOTAL_IVA as TOTAL_IVA,
        c.TOTAL as TOTAL,
        c.id_tiempo_entrega as ID_TIEMPO_ENTREGA,
        te.nombre as TIEMPO_ENTREGA

        FROM cotizacion c
        JOIN tiempo_entrega te ON c.ID_TIEMPO_ENTREGA=te.ID_TIEMPO_ENTREGA
        JOIN tipo_impuesto ti ON c.ID_TIPO_IMPUESTO=ti.ID_TIPO_IMPUESTO
        JOIN cliente cl ON cl.ID_CLIENTE=c.ID_CLIENTE
        JOIN empresa em ON em.ID_EMPRESA=cl.ID_EMPRESA
        JOIN detalle_cotizacion dc ON dc.ID_COTIZACION=c.ID_COTIZACION
        JOIN forma_pago fp ON fp.ID_FORMA_PAGO=c.ID_FORMA_PAGO
        WHERE c.ESTADO=1 $where
        GROUP BY c.id_cotizacion
        ORDER BY c.id_cotizacion DESC;";
        $query = $this->db->query($sql);
        // var_dump($this->db->last_query());

        if ($query->num_rows() > 0)
            return $query;
        else
            return false;
    }

    public function getCotizacionDataFiltro($where = '')
    {
        $sql = "SELECT
        c.ID_COTIZACION,
        SUM(c.TOTAL_NETO) as TOTAL_NETO,
        SUM(c.TOTAL_IVA) as TOTAL_IVA,
        SUM(c.TOTAL) as TOTAL

        FROM cotizacion c
        WHERE c.ESTADO=1 $where
        GROUP BY c.id_cotizacion
        ORDER BY c.id_cotizacion DESC;";
        $query = $this->db->query($sql);
        // var_dump($this->db->last_query());

        if ($query->num_rows() > 0)
            return $query;
        else
            return false;
    }

    public function getCotizacionById($where = '')
    {
        $sql = "SELECT c.id_cotizacion as ID_COTIZACION,
        c.OBSERVACION as OBSERVACION,
        c.descuento as descuento,
        cl.id_cliente as ID_CLIENTE,
        cl.nombre as NOMBRE_CLIENTE,
        cl.correo as EMAIL_CLIENTE,
        em.rut as RUT_EMPRESA,
        em.nombre as NOMBRE_EMPRESA,
        DATE_FORMAT(C.FECHA_CREACION, '%d/%m/%Y') as FECHA_COTIZACION,
        COUNT(dc.ID_PRODUCTO) as NRO_ITEM,
        SUM(dc.CANTIDAD) as NRO_CANTIDAD,
        c.id_tipo_impuesto as ID_TIPO_IMPUESTO,
        ti.nombre as TIPO_IMPUESTO,
        c.id_forma_pago as ID_FORMA_PAGO,
        fp.nombre as FORMA_PAGO,
        fp.descripcion as DESCRIPCION_FORMA_PAGO,
        c.enviado_correo AS ENVIADO_CORREO,
        c.TOTAL_NETO as TOTAL_NETO,
        c.TOTAL_IVA as TOTAL_IVA,
        c.TOTAL as TOTAL,
        c.id_tiempo_entrega as ID_TIEMPO_ENTREGA,
        te.nombre as TIEMPO_ENTREGA,
        te.descripcion as DESCRIPCION_TIEMPO_ENTREGA

        FROM cotizacion c
        JOIN tiempo_entrega te ON c.ID_TIEMPO_ENTREGA=te.ID_TIEMPO_ENTREGA
        JOIN tipo_impuesto ti ON c.ID_TIPO_IMPUESTO=ti.ID_TIPO_IMPUESTO
        JOIN cliente cl ON cl.ID_CLIENTE=c.ID_CLIENTE
        JOIN empresa em ON em.ID_EMPRESA=cl.ID_EMPRESA
        JOIN detalle_cotizacion dc ON dc.ID_COTIZACION=c.ID_COTIZACION
        JOIN forma_pago fp ON fp.ID_FORMA_PAGO=c.ID_FORMA_PAGO
        WHERE c.ESTADO=1 $where
        GROUP BY c.id_cotizacion
        ORDER BY c.id_cotizacion DESC;";
        $query = $this->db->query($sql);
        // var_dump($this->db->last_query());

        if ($query->num_rows() > 0)
            return $query;
        else
            return false;
    }

    public function getLastId()
    {
        $sql = "SELECT MAX(id_cotizacion) as LAST_ID
        FROM cotizacion;";
        $query = $this->db->query($sql);
        // var_dump($this->db->last_query());

        if ($query->num_rows() > 0)
            return $query;
        else
            return false;
    }

    public function insertCotizacion($tabla, $data)
    {
        $query = $this->db->insert($tabla, $data);
        if ($query)
            return $this->db->insert_id();
        else
            return false;
    }
    public function updateCotizacion($tabla, $comparar, $datos, $id)
    {
        $this->db->where($comparar, $id);
        $result = $this->db->update($tabla, $datos);
        if ($result)
            return true;
        else
            return false;
    }
}
