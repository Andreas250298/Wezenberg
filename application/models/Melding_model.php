<?php
/**
* @class Melding_model
* @brief Model-klasse voor meldingen
*
* Model-klasse die alle methodes bevat om te interageren met de model tabel
*/
class Melding_model extends CI_Model
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Retouneert een melding met het meegegeven id uit de tabel melding.
     * @param id het id van het record dat opgevraagd wordt
     * @return het opgevraagde record
     */
    public function get($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('melding');
        return $query->row();
    }

    public function getOrderdByVerzondenDatum($id)
    {
        $this->db->order_by('verzondenDatum', 'asc');
        $this->db->where('id', $id);
        $query = $this->db->get('melding');
        return $query->row();
    }

    /**
    * Opvragen van alle meldingen van een bepaalde gebruiker uit de database
    * @return De opgevraagde meldingen
    */
    public function getAll(){
        /*$this->db->where('id', $gebruikerId);*/
        $query = $this->db->get('melding');
        return $query->result();
    }

    /**
     * Creeërt een nieuwe melding en voegt die toe aan de databank
     * @param $melding een melding object
     * @return het id van het juist aangemaakte melding
     */
    public function insert($melding){
        $this->db->insert('melding', $melding);
        return $this->db->insert_id();
    }

    /**
     * Voert de aanpassingen aan een bepaalde melding door aan de databank
     * @param type $melding een melding object
     */
    public function update($melding){
        $this->db->where('id', $melding->id);
        $this->db->update('melding', $melding);
    }
    /**
     * Verwijdert een melding uit de databank
     * @param $id van de melding dat moet worden verwijderd
     */
    public function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('melding');
    }
}
