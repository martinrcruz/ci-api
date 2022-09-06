<?php

class Home_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getIndicadores($where = "")
    {
        $sql = "SELECT
        COUNT() AS ORDEN_TRABAJO,
        COUNT() AS COTIZACION,
        COUNT() AS CLIENTES,
        COUNT() AS SERVICIOS_ACTIVOS,
        COUNT() AS SERVICIOS_PENDIENTES,
        COUNT() AS SERVICIOS_COMPLETADOS

        FROM COTIZACION
        JOIN ORDEN_TRABAJO
        JOIN CLIENTE";

        $query = $this->db->query($sql, $clauses);
        //var_dump($this->db->last_query());
        if ($query->num_rows() > 0)
            return $query;
        else
            return false;
    }




}
