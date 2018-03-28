<?php

class Nieuws_model extends CI_Model
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Retouneert het nieuwsartikel met het meegegeven id uit de tabel nieuwsArtikel.
     * @param $id het id van het record dat opgevraagd wordt
     * @return het opgevraagde record
     */
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

    /**
     * Creeërt een nieuw nieuwsartikel en voegt die toe aan de databank.
     * @param $nieuwsArtikel een nieuwsartikel object
     * @return het id van het juist aangemaakte nieuwsartikel.
     */
    public function insert($nieuwsArtikel){
        $this->db->insert('nieuwsArtikel', $nieuwsArtikel);
        return $this->db->insert_id();
    }

    /**
     * Voert de aanpassingen aan een bepaald artikel door aan de databank.
     * @param type $nieuwsArtikel een nieuwsartikel object
     */
    public function update($nieuwsArtikel){
        $this->db->where('id', $nieuwsArtikel->id);
        $this->db->update('nieuwsArtikel', $nieuwsArtikel);
    }
    /**
     * Verwijdert een nieuwsartikel uit de databank.
     * @param $id van het artikel dat moet worden verwijderd
     */
    public function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('nieuwsArtikel');
    }
}
