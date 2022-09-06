<?php

class Terminacion_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getLastId()
    {
        $sql = "SELECT MAX(id_terminacion) as LAST_ID
        FROM terminacion
        WHERE ESTADO=1;";
        $query = $this->db->query($sql);
        // var_dump($this->db->last_query());

        if ($query->num_rows() > 0)
            return $query;
        else
            return false;
    }


    public function getTerminacion($where='')
    {
        $sql = "SELECT t.*, c.nombre FROM terminacion t JOIN categoria c ON c.id_categoria=t.id_categoria WHERE c.estado=1 $where ORDER BY ID_TERMINACION desc;";
        $query = $this->db->query($sql);
        // var_dump($this->db->last_query());

        if ($query->num_rows() > 0)
            return $query;
        else
            return false;
    }

    public function getTerminacionDetalle($where='')
    {
        $sql = "SELECT td.id_terminacion_detalle,
        td.id_terminacion,
        td.id_detalle,
        t.nombre,
        t.descripcion
        FROM terminacion_detalle td
        JOIN terminacion t ON td.id_terminacion=t.id_terminacion
        WHERE td.estado=1
        $where
        ORDER BY ID_TERMINACION_DETALLE ASC;";
        $query = $this->db->query($sql);
        // var_dump($this->db->last_query());

        if ($query->num_rows() > 0)
            return $query;
        else
            return false;
    }

    public function getTerminacionDetalleOT($where='')
    {
        $sql = "SELECT tot.id_terminacion_ot,
        tot.id_terminacion,
        tot.id_detalle_orden_trabajo,
        t.nombre,
        t.descripcion
        FROM terminacion_orden_trabajo tot
        JOIN terminacion t ON tot.id_terminacion=t.id_terminacion
        WHERE tot.estado=1
        $where
        ORDER BY ID_TERMINACION_OT ASC;";
        $query = $this->db->query($sql);
        // var_dump($this->db->last_query());

        if ($query->num_rows() > 0)
            return $query;
        else
            return false;
    }

    public function getTerminacionCategoria($where='')
    {
        $sql = "SELECT td.id_terminacion_detalle,
        td.id_terminacion,
        td.id_detalle,
        t.nombre,
        t.descripcion
        FROM terminacion_detalle td
        JOIN terminacion t ON td.id_terminacion=t.id_terminacion
        WHERE td.estado=1
        $where
        ORDER BY ID_TERMINACION_DETALLE ASC;";
        $query = $this->db->query($sql);
        // var_dump($this->db->last_query());

        if ($query->num_rows() > 0)
            return $query;
        else
            return false;
    }

    public function getTerminacionCategoriaOT($where='')
    {
        $sql = "SELECT tot.id_terminacion_orden_trabajo,
        tot.id_terminacion,
        tot.id_detalle,
        t.nombre,
        t.descripcion
        FROM terminacion_orden_trabajo tot
        JOIN terminacion t ON tot.id_terminacion=t.id_terminacion
        WHERE tot.estado=1
        $where
        ORDER BY ID_TERMINACION_ORDEN_TRABAJO ASC;";
        $query = $this->db->query($sql);
        // var_dump($this->db->last_query());

        if ($query->num_rows() > 0)
            return $query;
        else
            return false;
    }

    public function insertTerminacion($tabla, $data)
    {
        $query = $this->db->insert($tabla, $data);
		if ($query)
			return $this->db->insert_id();
		else
			return false;
    }

    public function updateTerminacion($tabla, $comparar, $datos, $id)
    {
    	$this->db->where($comparar, $id);
		$result = $this->db->update($tabla, $datos);
		if ($result)
			return true;
		else
			return false;
    }



}
