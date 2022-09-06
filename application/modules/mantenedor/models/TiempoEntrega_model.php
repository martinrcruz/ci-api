<?php

class TiempoEntrega_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getTiempoEntrega($where = '')
    {
        $sql = "SELECT * FROM tiempo_entrega WHERE estado=1 $where ORDER BY ID_TIEMPO_ENTREGA asc;";
        $query = $this->db->query($sql);
        // var_dump($this->db->last_query());

        if ($query->num_rows() > 0)
            return $query;
        else
            return false;
    }

    public function insertTiempoEntrega($tabla, $data)
    {
        $query = $this->db->insert($tabla, $data);
        if ($query)
            return $this->db->insert_id();
        else
            return false;
    }
    public function updateTiempoEntrega($tabla, $comparar, $datos, $id)
    {
        $this->db->where($comparar, $id);
        $result = $this->db->update($tabla, $datos);
        if ($result)
            return true;
        else
            return false;
    }
}
