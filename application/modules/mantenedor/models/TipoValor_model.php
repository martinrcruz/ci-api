<?php

class TipoValor_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }



    public function getTipoValor($where='')
    {
        $sql = "SELECT * FROM tipo_valor WHERE estado=1 $where ORDER BY ID_TIPO_vALOR desc;";
        $query = $this->db->query($sql);
        // var_dump($this->db->last_query());

        if ($query->num_rows() > 0)
            return $query;
        else
            return false;
    }

    public function insertTipoValor($tabla, $data)
    {
        $query = $this->db->insert($tabla, $data);
		if ($query)
			return $this->db->insert_id();
		else
			return false;
    }
    public function updateTipoValor($tabla, $comparar, $datos, $id)
    {
    	$this->db->where($comparar, $id);
		$result = $this->db->update($tabla, $datos);
		if ($result)
			return true;
		else
			return false;
    }



}
