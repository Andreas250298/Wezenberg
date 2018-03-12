<?php

class Nieuws_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('nieuwsArtikel');
    }
    
    public function getAllNieuwsArtikels(){
        $this->db->order_by('datumAangemaakt', 'desc');
        $query = $this->db->get('nieuwsArtikel');
        return $query->result();
    }
    
    public function insert($nieuwsArtikel){
        $this->db->insert('nieuwsArtikel', $nieuwsArtikel);
        return $this->db->insert_id();
    }
}
