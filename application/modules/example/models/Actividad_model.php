<?php

class Actividad_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getDataActividad($where = "", $clauses = [], $orderby = "", $limit = "")
    {
        $sql = "SELECT 
        A.ID_ACTIVIDAD AS ID,
        A.CAMPO AS ACTIVIDAD_NOMBRE
        FROM ACTIVIDAD A
            WHERE A.ESTADO=1 $where
            $orderby $limit";

        $query = $this->db->query($sql, $clauses);
        //var_dump($this->db->last_query());
        if ($query->num_rows() > 0)
            return $query;
        else
            return false;
    }
    public function getActividad($where = "", $clauses = [])
    {
        $sql = "SELECT 
        A.ID_ACTIVIDAD AS ID,
        A.CAMPO AS ACTIVIDAD_NOMBRE
        FROM ACTIVIDAD A
            WHERE A.ESTADO=1 $where";

        $query = $this->db->query($sql, $clauses);
        //print_r($this->db->last_query());
        if ($query->num_rows() > 0)
            return $query;
        else
            return false;
    }

    public function insertar_actividad_area($id_area, $id_actividad, $fecha)
    {
        $sql = "INSERT INTO ACTIVIDAD_AREA (ID_AREA, ID_ACTIVIDAD, FECHACREACION, ESTADO) VALUES ($id_area, $id_actividad, $fecha, 1)";
        $query = $this->db->query($sql);
        //print_r($this->db->last_query());
        if ($query->num_rows() > 0)
            return $query;
        else
            return false;
    }

    public function get_area($id_actividad)
    {
        $sql = "SELECT 
        A.ID_AREA AS ID_AREA,
        A.CAMPO AS NOMBRE_AREA,
        AA.ID_ACT_AREA AS ID_ACTIVIDAD_AREA
        FROM AREA A
        LEFT JOIN ACTIVIDAD_AREA AA ON AA.ID_AREA=A.ID_AREA AND AA.ESTADO=1
            WHERE A.ESTADO=1 $id_actividad GROUP BY AA.ID_AREA";
        $query = $this->db->query($sql);
        //print_r($this->db->last_query());

        if ($query->num_rows() > 0)
            return $query;
        else
            return false;
    }



}
