<?php
/**
 * @class Slag_model
 * @brief Model-klasse voor slagen
 *
 * Model-klasse die alle methodes bevat om te interageren met de slag tabel
 */
class RondeResultaat_model extends CI_Model
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Een slag ophalen uit de database
     * @param id Het id van de reeks waar de slag aan gekoppeld is
     * @return De opgevraagde record
     */
    public function get($id)
    {
        $this->db->where('deelnameId', $id);
        $query = $this->db->get('rondeResultaat');
        return $query->row();
    }

    /**
    * geeft de resultaten terug per een bepaalde deelname.
    * @return query De opgevraagde record(s)
    */
    public function getResultatenPerDeelname($id)
    {
        $this->db->where('deelnameId', $id);
        $query = $this->db->get('rondeResultaat');
        if ($query->num_rows() == 0) {
            return null;
        } else {
            return $query->result();
        }
    }
}
