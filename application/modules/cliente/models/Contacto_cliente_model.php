<?php

class Contacto_cliente_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getLastId()
    {
        $sql = "SELECT MAX(id_contacto_cliente) as LAST_ID
        FROM contacto_cliente;";
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0)
            return $query;
        else
            return false;
    }

    public function getContactoCliente($where = '')
    {
        $sql = "SELECT *
                 FROM contacto_cliente c
                 WHERE c.ESTADO=1 $where
                 ORDER BY id_contacto_cliente DESC;";
        $query = $this->db->query($sql);
        // var_dump($this->db->last_query());

        if ($query->num_rows() > 0)
            return $query;
        else
            return false;
    }



    public function insertContactoCliente($tabla, $data)
    {
        $query = $this->db->insert($tabla, $data);
        if ($query)
            return $this->db->insert_id();
        else
            return false;
    }


    public function updateContactoCliente($tabla, $comparar, $datos, $id)
    {
        $this->db->where($comparar, $id);
        $result = $this->db->update($tabla, $datos);
        if ($result)
            return true;
        else
            return false;
    }
}
