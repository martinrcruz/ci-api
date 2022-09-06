<?php

class Proveedor_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getProveedor($where='')
    {
        $sql = "SELECT id_proveedor,
                nombre,
                descripcion,
                rubro,
                correo,
                celular,
                telefono,
                nombre_contacto,
                rut_empresa,
                direccion_sucursal,
                ciudad_sucursal,
                fecha_creacion,
                estado
         FROM proveedor
         WHERE ESTADO=1 $where ORDER BY id_proveedor DESC;";
        $query = $this->db->query($sql);
        // var_dump($this->db->last_query());
        if ($query->num_rows() > 0)
            return $query;
        else
            return false;
    }

    public function insertProveedor($tabla, $data)
    {
        $query = $this->db->insert($tabla, $data);
        if ($query)
            return $this->db->insert_id();
        else
            return false;
    }
    public function updateProveedor($tabla, $comparar, $datos, $id)
    {
        $this->db->where($comparar, $id);
        $result = $this->db->update($tabla, $datos);
        if ($result)
            return true;
        else
            return false;
    }
}
