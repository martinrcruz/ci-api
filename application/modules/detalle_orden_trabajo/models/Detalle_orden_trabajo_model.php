<?php

class Detalle_orden_trabajo_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getLastId()
    {
        $sql = "SELECT MAX(id_detalle_orden_trabajo) as LAST_ID
        FROM detalle_orden_trabajo;";
        $query = $this->db->query($sql);
        // var_dump($this->db->last_query());

        if ($query->num_rows() > 0)
            return $query;
        else
            return false;
    }


    public function getDetalleOrdenTrabajo($where='')
    {
        $sql = "SELECT dot.*,
        dot.id_detalle_orden_trabajo,
        p.nombre as PRODUCTO,
        p.imagen,
        p.descripcion as descripcion_producto
        FROM detalle_orden_trabajo dot
        LEFT JOIN producto p ON p.id_producto=dot.id_producto
        WHERE dot.ESTADO=1 $where
        ORDER BY id_detalle_orden_trabajo ASC;";
        $query = $this->db->query($sql);
        // var_dump($this->db->last_query());

        if ($query->num_rows() > 0)
            return $query;
        else
            return false;
    }

    public function getTerminacionesByDetalle($where='')
    {
        $sql = "SELECT dot.*,
        ot.descuento,
        dot.id_detalle_orden_trabajo,
        p.nombre as PRODUCTO,
        p.imagen as IMAGEN,
        p.descripcion as descripcion_producto,
        tv.NOMBRE as TIPO_VALOR,
        GROUP_CONCAT(DISTINCT t.nombre separator ', ') as terminaciones
        
        FROM detalle_orden_trabajo dot
        LEFT JOIN orden_trabajo ot ON ot.id_orden_trabajo=dot.id_detalle_orden_trabajo
        LEFT JOIN producto p ON p.id_producto=dot.id_producto
        LEFT JOIN terminacion_orden_trabajo tot ON tot.id_detalle_orden_trabajo=dot.id_detalle_orden_trabajo AND tot.ESTADO=1
        LEFT JOIN terminacion t ON t.id_terminacion=tot.id_terminacion AND tot.ESTADO=1
        JOIN tipo_valor tv ON tv.id_producto=p.id_producto
        WHERE dot.ESTADO=1 $where
        GROUP BY dot.id_detalle_orden_trabajo
        ORDER BY id_detalle_orden_trabajo desc;";
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0)
            return $query;
        else
            return false;
    }

    public function insertDetalleOrdenTrabajo($tabla, $data)
    {
        $query = $this->db->insert($tabla, $data);
		if ($query)
			return $this->db->insert_id();
		else
			return false;
    }
    public function updateDetalleOrdenTrabajo($tabla, $comparar, $datos, $id)
    {
    	$this->db->where($comparar, $id);
		$result = $this->db->update($tabla, $datos);
		if ($result)
			return true;
		else
			return false;
    }

    public function deleteDetalles($where, $fecha){

      $sql = "UPDATE detalle_orden_trabajo SET ESTADO=0, FECHA_BAJA ='$fecha' WHERE ESTADO=1 $where";
      $query = $this->db->query($sql);
      // var_dump($this->db->last_query());

      if ($query)
          return true;
      else
          return false;
    }

}
