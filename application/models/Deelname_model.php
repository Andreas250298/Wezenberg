<?php

<<<<<<< HEAD
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
=======
class Deelname_model extends CI_Model
{
    public function __construct()
    {
      /**
       * Constructor
       */
        parent::__construct();
    }
    /**
     * Een deelname ophalen uit de database
     * @param $id Het id van de deelname die opgevraagd wordt
>>>>>>> 503ea392d0202db6fc3d1317569532d51b2f12b9
     * @return De opgevraagde record
     */
    public function get($id)
    {
<<<<<<< HEAD
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
        * Haalt deelnames in week op van bepaalde zwemmer
        *\see reeks_model::getReeksenInWeek()
        * @param id ID van de zwemmer in kwestie
        * @param week Week in de agenda
        * @param jaar Jaar in de agenda
        * @return query Deelnames die week van opgegeven zwemmer.
        */
         public function getDeelnamesInWeekPerZwemmer($id, $week, $jaar)
         {
           $maandag = new DateTime;
           $maandag->setISODate(intval($jaar), intval($week));
           $zondag = clone $maandag;
           $zondag->modify('+6 day');

           $this->load->model('reeks_model');
           $reeksenInWeek = $this->reeks_model->getReeksenInWeek($maandag, $zondag);
           if ($reeksenInWeek != null)
           {
             foreach ($reeksenInWeek as $reeks)
             {
               $ids[] = $reeks->id;
             }

             $this->db->where('statusId', '2');
             $this->db->where('gebruikerIdZwemmer', $id);
             $this->db->where_in('reeksId', $ids);
             $query = $this->db->get('deelname')->result();

             return $query;
           } else {
             return null;
           }

         }

         /**
         * Haalt informatie
         *\see deelname_model::getDeelnamesInWeekPerZwemmer()
         * @param id ID van de zwemmer in kwestie
         * @param week Week in de agenda
         * @param jaar Jaar in de agenda
         * @return deelnames Wedstrijden die week van opgegeven zwemmer.
         */
         public function getInformatieDeelnames($id, $week, $jaar)
         {
           $deelnames = $this->deelname_model->getDeelnamesInWeekPerZwemmer($id, $week, $jaar);
           if ($deelnames != null)
           {
             $this->load->model('wedstrijd_model');
             $this->load->model('slag_model');
             $this->load->model('afstand_model');
             $this->load->model('reeks_model');

             foreach ($deelnames as $deelname)
             {
               $deelname->reeks = $this->reeks_model->get($deelname->reeksId);
               $tijdstip = (string) $deelname->reeks->tijdstip;
               $deelname->reeks->uur = verkortTijdstip($tijdstip);
               $deelname->reeks->tijdstip = substr($tijdstip, 0, 2);
               $deelname->afstand = $this->afstand_model->get($deelname->reeks->afstandId);
               $deelname->slag = $this->slag_model->get($deelname->reeks->slagId);
               $deelname->wedstrijd = $this->wedstrijd_model->get($deelname->reeks->wedstrijdId);
               $deelname->reeks->tijdstip = (string) $deelname->reeks->tijdstip;
             }

             return $deelnames;
           } else {
             return null;
           }

         }
=======
        $this->db->where('id', $id);
        $query = $this->db->get('deelname');
        return $query->row();
    }

    /**
     * Een status ophalen uit de database
     * @param $id Het id van de gebruiker waarvan de status opgevraagd wordt
     * @return De opgevraagde record
     */
    public function getStatusPerGebruiker($id)
    {
      $this->db->where('id', $id);
      $query = $this->db->get('deelname');
      $deelname = $query->row();

      $this->load->model('status_model');
      $deelname->status = $this->status_model->get($deelname->id);
      return $deelname;
    }
>>>>>>> 503ea392d0202db6fc3d1317569532d51b2f12b9
}
