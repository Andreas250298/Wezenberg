<?php

/**
 * @class Soort_model
 * @brief Model-klasse voor soorten activiteiten
 *
 * Model-klasse die alle methodes bevat om te interageren met de soort tabel
 */
class Soort_model extends CI_Model
{
  /**
   * Constructor
   */
  public function __construct()
  {
      parent::__construct();
  }
  /**
   * Een soort ophalen uit de database
   * @param $id Het id van de soort die opgevraagd wordt
   * @return De opgevraagde record
   */
  public function get($id)
  {
      $this->db->where('id', $id);
      $query = $this->db->get('soort');
      return $query->row();
  }
}
