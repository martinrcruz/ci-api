<?php

class Reporte_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getLastId()
    {
        $sql = "SELECT MAX(id_reporte) as LAST_ID
        FROM reporte;";
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0)
            return $query;
        else
            return false;
    }

    public function getReporte($where = '')
    {
        $sql = "SELECT *
                 FROM reporte r
                 WHERE r.ESTADO=1 $where
                 ORDER BY r.id_reporte DESC;";
        $query = $this->db->query($sql);
        // var_dump($this->db->last_query());

        if ($query->num_rows() > 0)
            return $query;
        else
            return false;
    }


    public function insertReporte($tabla, $data)
    {
        $query = $this->db->insert($tabla, $data);
        if ($query)
            return $this->db->insert_id();
        else
            return false;
    }


    public function updateReporte($tabla, $comparar, $datos, $id)
    {
        $this->db->where($comparar, $id);
        $result = $this->db->update($tabla, $datos);
        if ($result)
            return true;
        else
            return false;
    }
}
