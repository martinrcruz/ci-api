<?php

class Pago_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getLastId()
    {
        $sql = "SELECT MAX(id_pago) as LAST_ID
        FROM pago;";
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0)
            return $query;
        else
            return false;
    }

    public function getPago($where = '')
    {
        $sql = "SELECT *
                 FROM pago p
                 WHERE p.ESTADO=1 $where
                 ORDER BY p.id_pago DESC;";
        $query = $this->db->query($sql);
        // var_dump($this->db->last_query());

        if ($query->num_rows() > 0)
            return $query;
        else
            return false;
    }

    public function getPagoByOrden($where = '')
    {
        $sql = "SELECT *,
                u.first_name as nombre_trabajador,
                fp.nombre as tipo_pago
                 FROM pago p
                 LEFT JOIN orden_trabajo ot ON p.id_orden_trabajo=ot.id_orden_trabajo
                 JOIN users u ON u.id=p.ID_TRABAJADOR
                 LEFT JOIN forma_pago fp ON fp.id_forma_pago=p.id_tipo_pago
                 WHERE p.ESTADO=1 $where
                 ORDER BY p.id_pago DESC;";
        $query = $this->db->query($sql);
        // var_dump($this->db->last_query());

        if ($query->num_rows() > 0)
            return $query;
        else
            return false;
    }

    public function insertPago($tabla, $data)
    {
        $query = $this->db->insert($tabla, $data);
        if ($query)
            return $this->db->insert_id();
        else
            return false;
    }


    public function updatePago($tabla, $comparar, $datos, $id)
    {
        $this->db->where($comparar, $id);
        $result = $this->db->update($tabla, $datos);
        if ($result)
            return true;
        else
            return false;
    }
}
