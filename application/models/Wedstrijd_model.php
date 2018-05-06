<?php

/**
 * @class Wedstrijd_model
 * @brief Model-klasse voor wedstrijden
 *
 * Model-klasse die alle methodes bevat om te interageren met de wedstrijd tabel
 */
class Wedstrijd_model extends CI_Model
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Een wedstrijd ophalen uit de database
     * @param $id Het id van de wedstrijd die opgevraagd wordt
     * @return De opgevraagde record
     */
    public function get($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('wedstrijd');
        return $query->row();
    }

    /**
      * opvragen van het aantal records.
      */
    public function getCountAll()
    {
        return $this->db->count_all('wedstrijd');
    }

    /**
     * Opvragen van alle wedstrijden uit de database, oplopend gesorteerd
     * @return De opgevraagde records
     */
    public function toonWedstrijdenASC()
    {
        $this->db->order_by('beginDatum', 'asc');
        $query = $this->db->get('wedstrijd');
        return $query->result();
    }

    /**
     * Opvragen van alle wedstrijden uit de database, aflopend gesorteerd
     * @return De opgevraagde records
     */
    public function toonWedstrijdenDESC()
    {
        $this->db->order_by('beginDatum', 'desc');
        $query = $this->db->get('wedstrijd');
        return $query->result();
    }

    /**
     * Opvragen van een aantal wedstrijden uit de database voor paging, aflopend gesorteerd
     * @return De opgevraagde records
     */
    public function getAllWedstrijdPaging($aantal, $startrij)
    {
        $this->db->order_by('beginDatum', 'asc');
        $query = $this->db->get('wedstrijd', $aantal, $startrij);
        return $query->result();
    }

    /**
     * Een wedstrijd toevoegen aan de database
     * @param $wedstrijd De wedstrijd die moet toegevoegd worden
     * @return De insert functie van de wedstrijd
     */
    public function insert($wedstrijd)
    {
        $this->db->insert('wedstrijd', $wedstrijd);
        return $this->db->insert_id();
    }

    /**
     * Reeks behorende bij een deelname uit de database ophalen
     * @param $id Het id van de deelname waar de reeks aan gekoppeld is
     * @return De opgevraagde record
     */
    public function getReeksenPerWedstrijd($id)
    {
        $this->db->where('wedstrijdId', $id);
        $query = $this->db->get('reeks');
        return $query->result();
    }

    public function getSlagenPerWedstrijd($id)
    {
        $this->db->where('wedstrijdId', $id);
        $query = $this->db->get('reeks');
        $reeksen =  $query->result();
        $this->load->model('slag_model');
        foreach ($reeksen as $reeks) {
            $reeks->slag = $this->slag_model->get($reeks->slagId);
        }
        return $reeksen;
    }

    public function getAfstandenPerWedstrijd($id)
    {
        $this->db->where('wedstrijdId', $id);
        $query = $this->db->get('reeks');
        $reeksen =  $query->result();
        $this->load->model('afstand_model');
        foreach ($reeksen as $reeks) {
            $reeks->slag = $this->afstand_model->get($reeks->afstandId);
        }
        return $reeksen;
    }

    /**
     * Een wedstrijd wijzigen in de database
     * @param $wedstrijd De wedstrijd die moet gewijzigd worden
     */
    public function update($wedstrijd)
    {
        $this->db->where('id', $wedstrijd->id);
        $this->db->update('wedstrijd', $wedstrijd);
    }

    /**
     * Een wedstrijd verwijderen uit de database
     * @param $id Het id van de wedstrijd die moet verwijderd worden
     */
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('wedstrijd');
    }
}
