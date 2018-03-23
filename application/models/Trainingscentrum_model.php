<?php

class Trainingscentrum_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get()
    {
        $this->db->where('id', 1);
        $query = $this->db->get('trainingscentrum');
        return $query->row();
    }
    
    public function update(){
        $this->db->where('id', 1);
        $this->db->update('beschrijvingWelkom', $beschrijvingWelkom);
    }
}
