<?php

/**
 * @class Wedstrijd_model
 * @brief Model-klasse voor wedstrijden
 *
 * Model-klasse die alle methodes bevat om te interageren met de wedstrijd tabel
 */
class Wedstrijd_model extends CI_Model
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Een wedstrijd ophalen uit de database
     * @param $id Het id van de wedstrijd die opgevraagd wordt
     * @return De opgevraagde record
     */
    public function get($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('wedstrijd');
        return $query->row();
    }

    /**
     * Opvragen van alle wedstrijden uit de database, oplopend gesorteerd
     * @return De opgevraagde records
     */
    public function toonWedstrijdenASC()
    {
        $this->db->order_by('beginDatum', 'asc');
        $query = $this->db->get('wedstrijd');
        return $query->result();
    }

    /**
     * Opvragen van alle nieuws artikels uit de database, aflopend gesorteerd
     * @return De opgevraagde records
     */
    public function toonWedstrijdenDESC()
    {
        $this->db->order_by('beginDatum', 'desc');
        $query = $this->db->get('wedstrijd');
        return $query->result();
    }

    /**
     * Afstanden uit de database ophalen
     * @return De opgevraagde record
     */
    public function getAfstanden()
    {
        $query = $this->db->get('afstand');
        return $query->result();
    }

    public function getReeksen($id)
    {
        $this->db->where('wedstrijdId', $id);
        $query = $this->db->get('reeks');
        return $query->row();
    }

    /**
     * Slagen uit de database ophalen
     * @return De opgevraagde record
     */
    public function getSlagen()
    {
        $query = $this->db->get('slag');
        return $query->result();
    }

    /**
     * Reeks behorende bij een deelname uit de database ophalen
     * @param $id Het id van de deelname waar de reeks aan gekoppeld is
     * @return De opgevraagde record
     */
    public function getReeksenPerWedstrijd($id)
    {
        $this->db->where('wedstrijdId', $id);
        $query = $this->db->get('reeks');
        return $query->result();
    }

    public function getSlagenPerWedstrijd($id)
    {
        /*$this->db->where('wedstrijdId', $id);
        $query = $this->db->get('reeks');
        $reeks =  $query->row();

        $this->load->model('slag_model');
        if (isset($reeks)) {
            $reeks->slag = $this->slag_model->getSlag($reeks->slagId);
        }

        return $reeks;*/
        $this->db->where('id', $id);
        $query = $this->db->get('slag');
        return $query->result();
    }

    /**
     * Een wedstrijd toevoegen aan de database
     * @param $wedstrijd De wedstrijd die moet toegevoegd worden
     * @return De insert functie van de wedstrijd
     */
    public function insert($wedstrijd)
    {
        $this->db->insert('wedstrijd', $wedstrijd);
        return $this->db->insert_id();
    }

    /**
     * Een wedstrijd wijzigen in de database
     * @param $wedstrijd De wedstrijd die moet gewijzigd worden
     */
    public function update($wedstrijd)
    {
        $this->db->where('id', $wedstrijd->id);
        $this->db->update('wedstrijd', $wedstrijd);
    }

    /**
     * Een wedstrijd verwijderen uit de database
     * @param $id Het id van de wedstrijd die moet verwijderd worden
     */
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('wedstrijd');
    }

    /**
    * Opvragen van de aanstaande wedstrijden van een zwemmer
    *\see wedstrijd_model::getDeelnames()
    *\see wedstrijd_model::getReeks()
    *\see wedstrijd_model::getAfstand()
    *\see wedstrijd_model::getSlag()
    *\see wedstrijd_model::getWedstrijd()
    * @param id ID van de zwemmer in kwestie
    * @return De opgevraagde wedstrijden.
    */
    public function getWedstrijdInformatieZwemmer($id)
    {
      $this->load->model('deelname_model');
      $this->load->model('slag_model');
      $this->load->model('afstand_model');
      $this->load->model('reeks_model');
      $deelname = $this->deelname_model->getDeelnamesPerZwemmer($id);

      if ($deelnames == null)
      {
        return null ;
      }
      else
      {
        $i = 0;
        $output[] = "";

        foreach($deelnames as $deelname)
        {
          $reeksen[$i] = $this->reeks_model->get($deelname->reeksId);
          $afstanden[$i] = $this->afstand_model->get($reeksen[$i]->afstandId);
          $slagen[$i] = $this->slag_model->get($reeksen[$i]->slagId);
          $wedstrijden[$i] = $this->wedstrijd_model->get($reeksen[$i]->wedstrijdId);
          $tijdstip = (string) $reeksen[$i]->tijdstip;

          $output[$i] = array("datum" => $reeksen[$i]->datum, "tijdstip" => $tijdstip, "beginUur" => verkortTijdstip($tijdstip),
                        "afstand" => $afstanden[$i]->afstand, "slag" => $slagen[$i]->soort, "wedstrijd" => $wedstrijden[$i]->naam, "plaats" => $wedstrijden[$i]->plaats, "beschrijving" => $wedstrijden[$i]->beschrijving, "reeksId" => $reeksen[$i]->id);

          $i++;
        }

        return $output;

      }
    }

    /**
    * Vergelijken van wedstrijden in een week met wedstrijden van een zwemmer
    *\see wedstrijd_model::getReeksenInWeek()
    *\see wedstrijd_model::getWedstrijdenZwemmer()
    * @param id ID van de zwemmer in kwestie
    * @return Wedstrijden in opgegeven week van opgegeven zwemmer.
    */
     public function getWedstrijdenInWeek($id, $week, $jaar)
     {
         $this->load->model('reeks_model');

         $maandag = new DateTime;
         $maandag->setISODate(intval($jaar), intval($week));
         $zondag = clone $maandag;
         $zondag->modify('+6 day');
         $reeksenInWeek = $this->reeks_model->getReeksenInWeek($maandag, $zondag);
         $zwemmerWedstrijden = $this->wedstrijd_model->getWedstrijdenZwemmer($id);
         $wedstrijdenInWeek = array();
         $i = 0;

         foreach ($zwemmerWedstrijden as $wedstrijd) {
             foreach ($reeksenInWeek as $reeks) {
                 if ($reeks->id == $wedstrijd['reeksId']) {
                     $wedstrijd["tijdstip"] = substr($wedstrijd["tijdstip"], 0, 2);
                     $wedstrijdenInWeek[$i] = $wedstrijd;
                     $i++;
                 }
             }
         }

         return $wedstrijdenInWeek;
     }
}
