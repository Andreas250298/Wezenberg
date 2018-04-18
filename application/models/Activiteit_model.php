<?php

/**
 * @class Activiteit_model
 * @brief Model-klasse voor activiteiten
 *
 * Model-klasse die alle methodes bevat om te interageren met de actiiteit tabel
 */
class Activiteit_model extends CI_Model
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Activiteiten van een zwemmer ophalen uit de database
     * @param $id Het id van de zwemmer waar de activiteiten aan gekoppeld zijn
     * @return De opgevraagde record(s)
     */
    public function getActiviteitenPerZwemmer($id)
    {
      $this->db->where('gebruikerIdZwemmer', $id);
      $query = $this->db->get('activiteitpergebruiker');

        if ($query->num_rows() == 0)
        {
          return null;
        }

        else
        {
          $i = 0;
          $rijen = $query->num_rows();

          while ($i <= $rijen)
          {
            $activiteiten[$i] = $query->row($i);
            $i++;
          }
          return $activiteiten;
        }
    }

    /**
     * Informatie van een activiteit uitlezen uit de database
     * @param $id Het id van de activiteit waar de informatie aan gekoppeld is
     * @return De opgevraagde record
     */
    public function getActiviteitInformatie($id)
    {
      $this->db->where('id', $id);
      $query = $this->db->get('andereactiviteit');
      return $query->row();
    }

    /**
     * Soort van een activiteit ophalen uit de database
     * @param $id Het id van de reeks waar de afstand aan gekoppeld is
     * @return De opgevraagde record
     */
    public function getSoort($id)
    {
      $this->db->where('id', $id);
      $query = $this->db->get('soort');
      $soort = $query->row();
      return $soort->naam;
    }

    public function getAndereActiviteitenZwemmer($id)
    {
      $this->load->model('activiteit_model');
      $activiteitpergebruiker = $this->activiteit_model->getActiviteitenPerZwemmer($id);

      if ($activiteitpergebruiker == null)
      {
        return null;
      } else {
        $i = 0;
        foreach ($activiteitpergebruiker as $activiteit)
        {
          $ander[$i] = $this->activiteit_model->getActiviteitInformatie($activiteit->andereActiviteitId);
          $soort[$i] = $this->activiteit_model->getSoort($ander[$i]->soortId);

          $activiteiten[$i] = array('naam' => $ander[$i]->naam, 'beschrijving' => $ander[$i]->beschrijving, 'beginDatum' => $ander[$i]->beginDatum, 'eindDatum' => $ander[$i]->eindDatum,
                                    'tijdstip' => $ander[$i]->tijdstip, 'plaats' => $ander[$i]->plaat, 'soort' => $soort[$i]);

          $i++;
        }
        return $activiteiten;
      }
    }
}
