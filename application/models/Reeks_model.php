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
        $this->db->where('datum >=', $maandag->format('Y-m-d') );
        $this->db->where('datum <=', $zondag->format('Y-m-d') );
        $query = $this->db->get();
        if ($query->num_rows() == 0)
        {
          return null;
        } else {
          return $query->result();
        }
    }
}
