<?php

class Deelname_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('deelname');
        return $query->row();
    }

    public function getStatusPerGebruiker($id)
    {
      $this->db->where('gebruikerIdZwemmer', $id);
      $query = $this->db->get('deelname');
      $deelname = $query->row();

      $this->load->model('status_model');
      $deelname->status = $this->status_model->get($deelname->statusId);
      return $deelname;
    }
}
