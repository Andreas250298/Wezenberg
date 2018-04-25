<?php
<<<<<<< HEAD

/**
 * @class Slag_model
 * @brief Model-klasse voor slagen
 *
 * Model-klasse die alle methodes bevat om te interageren met de slag tabel
 */
=======
>>>>>>> 503ea392d0202db6fc3d1317569532d51b2f12b9
class Slag_model extends CI_Model
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
    }
<<<<<<< HEAD

    /**
     * Een slag ophalen uit de database
     * @param $id Het id van de reeks waar de slag aan gekoppeld is
     * @return De opgevraagde record
     */
    public function get($id)
    {
          $this->db->where('id', $id);
          $query = $this->db->get('slag');
          return $query->row();
=======
    /**
         * Slag behorende bij een reeks uit de database ophalen
         * @param $id Het id van de reeks waar de slag aan gekoppeld is
         * @return De opgevraagde record
         */
    public function getSlag($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('slag');
        return $query->row();
>>>>>>> 503ea392d0202db6fc3d1317569532d51b2f12b9
    }
}
