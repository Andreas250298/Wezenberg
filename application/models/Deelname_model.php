<?php

class Deelname_model extends CI_Model
{
    public function __construct()
    {
      /**
       * Constructor
       */
        parent::__construct();
    }
    /**
     * Een deelname ophalen uit de database
     * @param $id Het id van de deelname die opgevraagd wordt
     * @return De opgevraagde record
     */
    public function get($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('deelname');
        return $query->row();
    }

    /**
     * Een status ophalen uit de database
     * @param $id Het id van de gebruiker waarvan de status opgevraagd wordt
     * @return De opgevraagde record
     */
    public function getStatusPerGebruiker($id)
    {
      $this->db->where('id', $id);
      $query = $this->db->get('deelname');
      $deelname = $query->row();

      $this->load->model('status_model');
      $deelname->status = $this->status_model->get($deelname->id);
      return $deelname;
    }
}
