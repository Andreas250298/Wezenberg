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

    /**
    * Opvragen van de aanstaande activiteiten van een zwemmer
    *\see activiteit_model::getActiviteitenPerZwemmer()
    *\see activiteit_model::getSoort()
    * @param id ID van de zwemmer in kwestie
    * @return De opgevraagde activiteiten.
    */
    public function getAndereActiviteitenZwemmer($id)
    {
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
          $tijdstip = (string) $ander[$i]->tijdstip;

          $activiteiten[$i] = array('naam' => $ander[$i]->naam, 'beschrijving' => $ander[$i]->beschrijving, 'beginDatum' => $ander[$i]->beginDatum, 'eindDatum' => $ander[$i]->eindDatum,
                                    'tijdstip' => $tijdstip, 'plaats' => $ander[$i]->plaats, 'soort' => $soort[$i]->naam, 'anderId' => $ander[$i]->id);

          $i++;
        }
        return $activiteiten;
      }
    }

    /**
    * Opvragen van activiteiten in een opgegeven week
    * @param maandag Datum van maandag
    * @param zondag Datum van zondag
    * @return De opgevraagde activiteiten.
    */
    public function getActiviteitenInWeek($maandag, $zondag)
    {
        $this->db->where('beginDatum >=', $maandag->format('Y-m-d') )
                ->andWhere('beginDatum <=', $zondag->format('Y-m-d') );
        $this->db->orWhere('eindDatum >=', $maandag->format('Y-m-d') )
                ->andWhere('eindDatum <=', $zondag->format('Y-m-d') );
        $query = $this->db->get('anderactiviteit');
        return $query->result();
    }

    /**
    * Vergelijken van wedstrijden in een week met wedstrijden van een zwemmer
    *\see wedstrijd_model::getReeksenInWeek()
    *\see wedstrijd_model::getWedstrijdenZwemmer()
    * @param id ID van de zwemmer in kwestie
    * @return Wedstrijden in opgegeven week van opgegeven zwemmer.
    */
     public function getActiviteitenInWeekPerZwemmer($id, $week, $jaar)
     {
         $maandag = new DateTime;
         $maandag->setISODate(intval($jaar), intval($week));
         $zondag = clone $maandag;
         $zondag->modify('+6 day');
         $activiteitenInWeek = $this->activiteit_model->getActiviteitenInWeek($maandag, $zondag);
         $zwemmerActiviteiten = $this->activiteit_model->getAndereActiviteitenZwemmer($id);
         $activiteitenInWeekPerZwemmer = array();
         $i = 0;

         foreach ($zwemmerActiviteiten as $a) {
             foreach ($activiteitenInWeek as $b) {
                 if ($b->id == $a['reeksId']) {
                     $wedstrijd["tijdstip"] = substr($wedstrijd["tijdstip"], 0, 2);
                     $wedstrijdenInWeek[$i] = $wedstrijd;
                     $i++;
                 }
             }
         }

         return $wedstrijdenInWeek;
     }
}
