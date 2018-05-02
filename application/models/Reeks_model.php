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
     * @param $id Het id van de reeks waar de slag aan gekoppeld is
     * @return De opgevraagde record
     */
    public function get($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('reeks');
        return $query->row();
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
     * Een reeks toevoegen aan de database
     * @param $reeks De reeks die moet toegevoegd worden
     * @return De insert functie van de wedstrijd
     */
    public function insert($reeks)
    {
        $this->db->insert('reeks', $reeks);
        return $this->db->insert_id();
    }

    /**
     * Een reeks wijzigen in de database
     * @param $reeks De reeks die moet gewijzigd worden
     */
    public function update($reeks)
    {
        $this->db->where('id', $reeks->id);
        $this->db->update('reeks', $reeks);
    }

    /**
     * Een reeks verwijderen uit de database
     * @param $id Het id van de reeks die moet verwijderd worden
     */
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('reeks');
    }
}
