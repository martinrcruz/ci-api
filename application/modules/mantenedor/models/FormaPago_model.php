<?php

class FormaPago_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getFormaPago($where='')
    {
        $sql = "SELECT * FROM forma_pago WHERE estado=1 $where ORDER BY ID_FORMA_PAGO DESC;";
        $query = $this->db->query($sql);
        // var_dump($this->db->last_query());

        if ($query->num_rows() > 0)
            return $query;
        else
            return false;
    }

    public function insertFormaPago($tabla, $data)
    {
        $query = $this->db->insert($tabla, $data);
		if ($query)
			return $this->db->insert_id();
		else
			return false;
    }
    public function updateFormaPago($tabla, $comparar, $datos, $id)
    {
    	$this->db->where($comparar, $id);
		$result = $this->db->update($tabla, $datos);
		if ($result)
			return true;
		else
			return false;
    }



}
