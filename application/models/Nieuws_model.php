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
        return $query->row();
    }

    /**
    * Opvragen van alle nieuws artikels uit de database.
    * \return De opgevraagde records
    */
    public function getAllNieuwsArtikels(){
        $this->db->order_by('datumAangemaakt', 'desc');
        $query = $this->db->get('nieuwsArtikel');
        return $query->result();
    }

    public function insert($nieuwsArtikel){
        $this->db->insert('nieuwsArtikel', $nieuwsArtikel);
        return $this->db->insert_id();
    }

    public function update($nieuwsArtikel){
        $this->db->where('id', $nieuwsArtikel->id);
        $this->db->update('nieuwsArtikel', $nieuwsArtikel);
    }

    public function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('nieuwsArtikel');
    }
}
