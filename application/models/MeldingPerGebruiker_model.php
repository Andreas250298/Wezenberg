<?php
/**
* @class MeldingPerGebruiker_model
* @brief Model-klasse voor MeldingPerGebruiker
*
* Model-klasse die alle methodes bevat om te interageren met de MeldingPerGebruiker tabel
*/
class MeldingPerGebruiker_model extends CI_Model
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Retouneert een melding met het meegegeven id uit de tabel melding
     * @param $id het id van het record dat opgevraagd wordt
     * @return het opgevraagde record
     */
    public function get($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('meldingPerGebruiker');
        return $query->row();
    }

    /**
    * Opvragen van alle meldingen van een bepaalde gebruiker uit de database
    * @param $gebruikerId een gebruiker object
    * @return De opgevraagde meldingen
    */
    public function getAllPerGebruiker($gebruikerId){
        $this->db->where('gebruikerId', $gebruikerId);
        $this->db->where('gezien', 0);
        $query = $this->db->get('meldingPerGebruiker');

        $meldingenPerGebruiker = $query->result();

        $this->load->model('melding_model');

        foreach ($meldingenPerGebruiker as $meldingPerGebruiker) {
            $meldingPerGebruiker->melding = $this->melding_model->get($meldingPerGebruiker->meldingId);
        }

        return $meldingenPerGebruiker;
    }

    /**
     * Creeërt een nieuwe melding en voegt die toe aan de databank
     * @param $melding een melding object
     * @return id Het id van het juist aangemaakte melding.
     */
    public function insert($melding){
        $this->db->insert('meldingPerGebruiker', $melding);
        return $this->db->insert_id();
    }

    /**
     * Voert de aanpassingen aan een bepaalde melding door aan de databank.
     * @param type $meldingPerGebruiker een melding object
     */
    public function update($meldingPerGebruiker){
        $this->db->where('id', $meldingPerGebruiker->id);
        $this->db->update('meldingPerGebruiker', $meldingPerGebruiker);
    }
    /**
     * Verwijdert een melding uit de databank.
     * @param id Het id van de melding dat moet worden verwijderd
     */
    public function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('meldingPerGebruiker');
    }
}
