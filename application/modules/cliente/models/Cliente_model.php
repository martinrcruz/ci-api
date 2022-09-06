<?php

class Cliente_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getLastId()
    {
        $sql = "SELECT MAX(id_cliente) as LAST_ID
        FROM cliente;";
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0)
            return $query;
        else
            return false;
    }

    public function getCliente($where='')
    {
        $sql = "SELECT
                c.ID_CLIENTE as id_cliente,
                c.RUT,
                c.CORREO,
                c.ID_EMPRESA as id_empresa,
                e.NOMBRE as nombre_empresa,
                e.RUT as rut_empresa,
                e.GIRO as giro_empresa,
                e.DIRECCION as direccion_empresa,
                c.TIPO_CLIENTE as tipo_cliente,
                c.NOMBRE as nombre_cliente,
                c.CELULAR,
                c.TELEFONO,
                c.DIRECCION as direccion,
                c.SITIO_WEB as sitio_web,
                c.OBSERVACION

                 FROM cliente c
                 LEFT JOIN empresa e ON c.ID_EMPRESA=e.ID_EMPRESA
                 WHERE c.ESTADO=1 $where
                 ORDER BY c.id_cliente DESC;";
        $query = $this->db->query($sql);
        // var_dump($this->db->last_query());

        if ($query->num_rows() > 0)
            return $query;
        else
            return false;
    }

    public function getClienteBox($where='')
    {
        $sql = "SELECT c.ID_CLIENTE as id_cliente,
                c.RUT,
                c.CORREO,
                c.ID_EMPRESA as id_empresa,
                e.NOMBRE as nombre_empresa,
                e.RUT as rut_empresa,
                e.GIRO as giro_empresa,
                e.DIRECCION as direccion_empresa,
                c.TIPO_CLIENTE as tipo_cliente,
                c.NOMBRE as nombre_cliente,
                c.CELULAR,
                c.TELEFONO,
                c.DIRECCION as direccion,
                c.SITIO_WEB as sitio_web,
                c.OBSERVACION,
                DATE_FORMAT(MAX(co.FECHA_COTIZACION), '%d/%m/%Y - %H:%i') as ultima_cotizacion,
                MAX(co.FECHA_COTIZACION) as ultima_cotizacion_date
                FROM cliente c
                LEFT JOIN empresa e ON c.ID_EMPRESA=e.ID_EMPRESA
                LEFT JOIN cotizacion co ON co.ID_CLIENTE=c.ID_CLIENTE
                WHERE c.ESTADO=1 $where
                GROUP BY c.ID_CLIENTE
                 ORDER BY c.id_cliente DESC;";
        $query = $this->db->query($sql);
        // var_dump($this->db->last_query());

        if ($query->num_rows() > 0)
            return $query;
        else
            return false;
    }


    public function insertCliente($tabla, $data)
    {
        $query = $this->db->insert($tabla, $data);
		if ($query)
			return $this->db->insert_id();
		else
			return false;
    }


    public function updateCliente($tabla, $comparar, $datos, $id)
    {
    	$this->db->where($comparar, $id);
		$result = $this->db->update($tabla, $datos);
		if ($result)
			return true;
		else
			return false;
    }


}
