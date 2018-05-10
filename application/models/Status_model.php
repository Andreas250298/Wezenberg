<?php
/**
* @class Status_model
* @brief Model-klasse voor Status
*
* Model-klasse die alle methodes bevat om te interageren met de Status tabel.
*/
class Status_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * haalt een bepaalde status uit de databank
     * @return het opgevraagde status
     */
    public function get($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('status');
        return $query->row();
    }
    /**
     * haalt alle statussen terug uit de databank
     * @return status Alle statussen uit de databank
     */
    public function getAll(){
      $query = $this->db->get('status');
      return $query->result();
    }
}
