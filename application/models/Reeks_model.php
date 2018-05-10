<?php
/**
 * @class Reeks_model
 * @brief Model-klasse voor reeksen
 *
 * Model-klasse die alle methodes bevat om te interageren met de reeks tabel
 */
class Reeks_model extends CI_Model
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Een reeks ophalen uit de database
     * @param id Het id van de reeks waar de slag aan gekoppeld is
     * @return De opgevraagde record
     */
    public function get($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('reeks');
        return $query->row();
    }

    /**
     * Een afstanden ophalen uit de database voor een keuzenlijst
     * @return Alle bestaande afstanden uit de database
     */
    public function getAllReeksen()
    {
        $query = $this->db->get('reeks');
        return $query->result();
    }

    /**
    * Opvragen van reeksen in een opgegeven week
    * @param maandag Datum van maandag
    * @param zondag Datum van zondag
    * @return De opgevraagde reeksen.
    */
    public function getReeksenInWeek($maandag, $zondag)
    {
        $this->db->select('id');
        $this->db->from('reeks');
        $this->db->where('datum >=', $maandag->format('Y-m-d'));
        $this->db->where('datum <=', $zondag->format('Y-m-d'));
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return null;
        } else {
            return $query->result();
        }
    }
    /**
    * Opvragen van reeksen vanaf vandaag
    * @param maandag Datum van maandag
    * @param zondag Datum van zondag
    * @return De opgevraagde reeksen.
    */
    public function getReeksenVoorOfNaVandaag($voor)
    {
        $this->db->select('id');
        $this->db->from('reeks');
        if ($voor) {
          $this->db->order_by('datum', 'ASC');
          $this->db->where('datum <', date('Y-m-d'));
        } else {
          $this->db->order_by('datum', 'DESC');
          $this->db->where('datum >=', date('Y-m-d'));
        }
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return null;
        } else {
            return $query->result();
        }
    }
    /**
     * Een afstand van een reeks opvragen
     * @param id De id van de wedstrijd die reeksen heeft
     * @return De afstand van de reeks
     */
    public function getAfstandenPerReeks($id)
    {
        $this->db->where('wedstrijdId', $id);
        $reeks = $this->db->get('reeks')->row();
        $this->load->model('afstand_model');
        if (isset($reeks->afstandId)) {
            $reeks->afstand = $this->afstand_model->get($reeks->afstandId);
        }

        return $reeks;
    }

    /**
     * Een slag van een reeks opvragen
     * @param id Het id van de wedstrijd die reeksen heeft
     * @return De slag van de reeks
     */
    public function getSlagenPerReeks($id)
    {
        $this->db->where('wedstrijdId', $id);
        $reeks = $this->db->get('reeks')->row();
        $this->load->model('slag_model');
        if (isset($reeks->slagId)) {
            $reeks->slag= $this->slag_model->get($reeks->slagId);
        }

        return $reeks;
    }

    /**
     * Een reeks toevoegen aan de database
     * @param reeks De reeks die moet toegevoegd worden
     * @return Het insert id van de wedstrijd
     */
    public function insert($reeks)
    {
        $this->db->insert('reeks', $reeks);
        return $this->db->insert_id();
    }

    /**
     * Een reeks wijzigen in de database
     * @param reeks De reeks die moet gewijzigd worden
     */
    public function update($reeks)
    {
        $this->db->where('id', $reeks->id);
        $this->db->update('reeks', $reeks);
    }

    /**
     * Een reeks verwijderen uit de database
     * @param id Het id van de reeks die moet verwijderd worden
     */
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('reeks');
    }
}
