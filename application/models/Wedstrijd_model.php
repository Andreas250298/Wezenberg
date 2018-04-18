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
     * Deelname(s) van een zwemmer ophalen uit de database
     * @param $id Het id van de zwemmer waar de deelnames aan gekoppeld zijn
     * @return De opgevraagde record(s)
     */
    public function getDeelnames($id)
    {
      $this->db->where('statusId', '2');
      $this->db->where('gebruikerIdZwemmer', $id);
      $query = $this->db->get('deelname');

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
            $deelnames[$i] = $query->row($i);
            $i++;
          }
          return $deelnames;
        }
    }

    /**
     * Reeks behorende bij een deelname uit de database ophalen
     * @param $id Het id van de deelname waar de reeks aan gekoppeld is
     * @return De opgevraagde record
     */
    public function getReeks($id)
    {
      $this->db->where('id', $id);
      $query = $this->db->get('reeks');
      return $query->row();
    }

    /**
     * Afstand behorende bij een reeks uit de database ophalen
     * @param $id Het id van de reeks waar de afstand aan gekoppeld is
     * @return De opgevraagde record
     */
    public function getAfstand($id)
    {
      $this->db->where('id', $id);
      $query = $this->db->get('afstand');
      return $query->row();
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

    /**
     * Wedstrijd behorende bij een reeks uit de database ophalen
     * @param $id Het id van de reeks waar de wedstrijd aan gekoppeld is
     * @return De opgevraagde record
     */
    public function getWedstrijd($id)
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
    * @param zwemmerId ID van de getoonde zwemmer
    * @return De opgevraagde wedstrijden
    */
    public function getWedstrijdenZwemmer($id)
    {
      $deelnames = $this->wedstrijd_model->getDeelnames($id);

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
          $reeksen[$i] = $this->wedstrijd_model->getReeks($deelname->reeksId);
          $afstanden[$i] = $this->wedstrijd_model->getAfstand($reeksen[$i]->afstandId);
          $slagen[$i] = $this->wedstrijd_model->getSlag($reeksen[$i]->slagId);
          $wedstrijden[$i] = $this->wedstrijd_model->getWedstrijd($reeksen[$i]->wedstrijdId);
          $einduur = verhoogUur($reeksen[$i]->tijdstip);

          $output[$i] = array("datum" => $reeksen[$i]->datum, "tijdstip" => verkortTijdstip($reeksen[$i]->tijdstip),
                        "afstand" => $afstanden[$i]->afstand, "slag" => $slagen[$i]->soort, "wedstrijd" => $wedstrijden[$i]->naam, "plaats" => $wedstrijden[$i]->plaats, "beschrijving" => $wedstrijden[$i]->beschrijving, "reeksId" => $reeksen[$i]->id);

          $i++;
        }

        return $output;

      }
    }

    public function getReeksenInWeek($maandag, $zondag)
    {
        $this->db->where('datum >=', $maandag->format('Y-m-d') );
        $this->db->where('datum <=', $zondag->format('Y-m-d') );
        $query = $this->db->get('reeks');
        return $query->result();
    }

    /**
     * Haalt wedstrijden in opgegeven week op
     *
     *
     */
     public function getWedstrijdenInWeek($id, $week, $jaar)
     {
         $maandag = new DateTime;
         $maandag->setISODate(intval($jaar), intval($week));
         $zondag = clone $maandag;
         $zondag->modify('+6 day');
         $reeksenInWeek = $this->wedstrijd_model->getReeksenInWeek($maandag, $zondag);
         $zwemmerWedstrijden = $this->wedstrijd_model->getWedstrijdenZwemmer($id);
         $wedstrijdenInWeek = array();
         $i = 0;

         foreach ($zwemmerWedstrijden as $wedstrijd) {
             foreach ($reeksenInWeek as $reeks) {
                 if ($reeks->id == $wedstrijd['reeksId']) {
                     $wedstrijd["tijdstip"] = verwijderDubbelpunt($wedstrijd["tijdstip"]);
                     $wedstrijdenInWeek[$i] = $wedstrijd;
                     $i++;
                 }
             }
         }

         return $wedstrijdenInWeek;
     }
}
