<?php
class Slag_model extends CI_Model
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
    }
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
    }
}
