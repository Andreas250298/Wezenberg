<?php

/**
 * @class SupplementPerZwemmer_model
 * @brief Model-klasse voor supplementen per zwemmer
 *
 * Model-klasse die alle methodes bevat om te interageren met de supplementenPerZwemmer tabel
 */
class SupplementPerZwemmer_model extends CI_Model
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
    ** Opvragen van supplementen volgens id zwemmer
    * @param $id Het ID van de zwemmer
    */
    public function toonSupplementenPerZemmer($id)
    {
        $this->db->where('gebruikerIdZwemmer', $id);
        $supplementenPerZwemmer = $this->db->get('supplementPerZwemmer')->result();

        if ($supplementenPerZwemmer == null) {
            return null ;
        } else {
            $this->load->model('supplement_model');
            foreach ($supplementenPerZwemmer as $supplementPerZwemmer) {
                $supplementPerZwemmer->supplement= $this->supplement_model->get($supplementPerZwemmer->supplementId);
            }
            return $supplementenPerZwemmer;
        }
    }
}
