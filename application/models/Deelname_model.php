<?php

/**
 * @class Deelname_model
 * @brief Model-klasse voor deelnames
 *
 * Model-klasse die alle methodes bevat om te interageren met de deelname tabel
 */
class Deelname_model extends CI_Model
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Een reeks ophalen uit de database
     * @param $id Het id van de reeks waar de slag aan gekoppeld is
     * @return De opgevraagde record
     */
    public function get($id)
    {
          $this->db->where('id', $id);
          $query = $this->db->get('deelname');
          return $query->row();
    }

    /**
     * Deelname(s) van een zwemmer ophalen uit de database
     * @param $id Het id van de zwemmer waar de deelnames aan gekoppeld zijn
     * @return De opgevraagde record(s)
     */
    public function getDeelnamesPerZwemmer($id)
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
          return $query->result();
        }
    }


        /**
        * Opvragen van de aanstaande deelnames van een zwemmer
        *\see wedstrijd_model::getDeelnames()
        *\see wedstrijd_model::getReeks()
        *\see wedstrijd_model::getAfstand()
        *\see wedstrijd_model::getSlag()
        *\see wedstrijd_model::getWedstrijd()
        * @param id ID van de zwemmer in kwestie
        * @return De opgevraagde wedstrijden.
        */
        public function getDeelnamesZwemmer($id)
        {
          $this->load->model('wedstrijd_model');
          $this->load->model('slag_model');
          $this->load->model('afstand_model');
          $this->load->model('reeks_model');
          $deelnames = $this->deelname_model->getDeelnamesPerZwemmer($id);

          if ($deelnames == null)
          {
            return null ;
          }
          else
          {
            foreach($deelnames as $deelname)
            {
                $deelname->reeks = $this->reeks_model->get($deelname->reeksId);
                $deelname->afstand = $this->afstand_model->get($deelname->reeks->afstandId);
                $deelname->slag = $this->slag_model->get($deelname->reeks->slagId);
                $deelname->wedstrijd = $this->wedstrijd_model->get($deelname->reeks->wedstrijdId);
                $deelname->reeks->tijdstip = (string) $deelname->reeks->tijdstip;
            }

            return $deelnames;

          }
        }

        /**
        * Vergelijken van deelnames in een week met deelnames van een zwemmer
        *\see reeks_model::getReeksenInWeek()
        *\see deelname_model::getDeelnamesZwemmer()
        * @param id ID van de zwemmer in kwestie
        * @param week Week in de agenda
        * @param jaar Jaar in de agenda
        * @return Wedstrijden in opgegeven week van opgegeven zwemmer.
        */
         public function getDeelnamesInWeek($id, $week, $jaar)
         {
             $this->load->model('reeks_model');

             $maandag = new DateTime;
             $maandag->setISODate(intval($jaar), intval($week));
             $zondag = clone $maandag;
             $zondag->modify('+6 day');

             $reeksenInWeek = $this->reeks_model->getReeksenInWeek($maandag, $zondag);
             $zwemmerWedstrijden = $this->deelname_model->getDeelnamesZwemmer($id);

             $wedstrijdenWeek = new stdClass;

             foreach ($zwemmerWedstrijden as $wedstrijd) {
                 foreach ($reeksenInWeek as $reeks) {
                     if ($reeks->id == $wedstrijd->reeks->id) {
                         $tijdstip = (string) $wedstrijd->reeks->tijdstip;
                         $wedstrijdenWeek->dezeWeek = $wedstrijd;                         
                         $wedstrijdenWeek->dezeWeek->reeks->beginUur = verkortTijdstip($tijdstip);
                         $wedstrijdenWeek->dezeWeek->reeks->tijdstip = substr($tijdstip, 0, 2);
                         $wedstrijdenWeek->dezeWeek->reeks->isDezeWeek = 1;
                     }
                 }
             }

             return $wedstrijdenWeek;
         }
}
