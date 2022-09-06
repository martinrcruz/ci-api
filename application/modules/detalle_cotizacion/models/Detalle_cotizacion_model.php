<?php

class Detalle_cotizacion_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getLastId()
    {
        $sql = "SELECT MAX(id_detalle_cotizacion) as LAST_ID
        FROM detalle_cotizacion;";
        $query = $this->db->query($sql);
        // var_dump($this->db->last_query());

        if ($query->num_rows() > 0)
            return $query;
        else
            return false;
    }


    public function getDetalleCotizacion($where='')
    {
        $sql = "SELECT dc.*,
        dc.id_detalle_cotizacion,
        p.nombre as PRODUCTO,
        p.imagen,
        p.descripcion as descripcion_producto
        FROM detalle_cotizacion dc
        LEFT JOIN producto p ON p.id_producto=dc.id_producto
        WHERE dc.ESTADO=1 $where
        ORDER BY id_detalle_cotizacion ASC;";
        $query = $this->db->query($sql);
        // var_dump($this->db->last_query());

        if ($query->num_rows() > 0)
            return $query;
        else
            return false;
    }

    public function getTerminacionesByDetalle($where='')
    {
        $sql = "SELECT dc.*,
        c.descuento,
        dc.id_detalle_cotizacion,
        p.nombre as PRODUCTO,
        p.imagen as IMAGEN,
        p.descripcion as descripcion_producto,
        tv.NOMBRE as TIPO_VALOR,
        GROUP_CONCAT(DISTINCT t.nombre separator ', ') as terminaciones
        
        FROM detalle_cotizacion dc
        LEFT JOIN cotizacion c ON c.id_cotizacion=dc.id_cotizacion
        LEFT JOIN producto p ON p.id_producto=dc.id_producto
        LEFT JOIN terminacion_detalle td ON td.id_detalle=dc.id_detalle_cotizacion AND td.ESTADO=1
        LEFT JOIN terminacion t ON t.id_terminacion=td.id_terminacion AND td.ESTADO=1
        JOIN tipo_valor tv ON tv.id_producto=p.id_producto
        WHERE dc.ESTADO=1 $where
        GROUP BY dc.id_detalle_cotizacion
        ORDER BY id_detalle_cotizacion desc;";
        $query = $this->db->query($sql);
        // var_dump($this->db->last_query());

        if ($query->num_rows() > 0)
            return $query;
        else
            return false;
    }

    public function insertDetalleCotizacion($tabla, $data)
    {
        $query = $this->db->insert($tabla, $data);
		if ($query)
			return $this->db->insert_id();
		else
			return false;
    }
    public function updateDetalleCotizacion($tabla, $comparar, $datos, $id)
    {
    	$this->db->where($comparar, $id);
		$result = $this->db->update($tabla, $datos);
		if ($result)
			return true;
		else
			return false;
    }

    public function deleteDetalles($where, $fecha){

      $sql = "UPDATE detalle_cotizacion SET ESTADO=0, FECHA_BAJA ='$fecha' WHERE ESTADO=1 $where";
      $query = $this->db->query($sql);
      // var_dump($this->db->last_query());

      if ($query)
          return true;
      else
          return false;
    }

}
