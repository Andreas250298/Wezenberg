<?php

/**
 * @class ActiviteitPerGebruiker_model
 * @brief Model-klasse voor activiteiten per gebruiker
 *
 * Model-klasse die alle methodes bevat om te interageren met de activiteitPerGebruiker tabel
 */
class ActiviteitPerGebruiker_model extends CI_Model
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
    public function getAndereActiviteitenPerZwemmer($id)
    {
      $this->db->where('gebruikerIdZwemmer', $id);
      $activiteitenPerZwemmer = $this->db->get('activiteitPerGebruiker')->result();
      if ($activiteitenPerZwemmer == null)
      {
          return null;
      } else {
          $this->load->model('activiteit_model');
          $this->load->model('soort_model');
          foreach ($activiteitenPerZwemmer as $activiteit)
          {
              $activiteit->activiteit = $this->activiteit_model->get($activiteit->andereActiviteitId);
              $activiteit->activiteit->soort = $this->soort_model->get($activiteit->activiteit->soortId);
          }
          return $activiteitenPerZwemmer;
      }
    }

    // /**
    // * Opvragen van activiteiten in een opgegeven week
    // * @param maandag Datum van maandag
    // * @param zondag Datum van zondag
    // * @return De opgevraagde activiteiten.
    // */
    // public function getActiviteitenInWeek($maandag, $zondag)
    // {
    //     $this->db->group_start()
    //               ->where('beginDatum >=', $maandag->format('Y-m-d') )
    //               ->where('beginDatum <=', $zondag->format('Y-m-d') )
    //                 ->or_group_start()
    //                 ->where('eindDatum >=',  $maandag->format('Y-m-d') )
    //                 ->where('eindDatum <=',  $zondag->format('Y-m-d') )
    //                 ->group_end()
    //               ->group_end();
    //
    //     $query = $this->db->get('andereactiviteit');
    //     return $query->result();
    // }

    /**
    * Vergelijken van wedstrijden in een week met wedstrijden van een zwemmer
    *\see wedstrijd_model::getReeksenInWeek()
    *\see wedstrijd_model::getWedstrijdenZwemmer()
    * @param id ID van de zwemmer in kwestie
    * @return Wedstrijden in opgegeven week van opgegeven zwemmer.
    */
     public function awelNee($id, $week, $jaar)
     {
         $maandag = new DateTime;
         $maandag->setISODate(intval($jaar), intval($week));
         $zondag = clone $maandag;
         $zondag->modify('+6 day');

         $activiteitenInWeek = $this->activiteitPerGebruiker_model->getActiviteitenInWeek($maandag, $zondag);
         $zwemmerActiviteiten = $this->activiteitPerGebruiker_model->getAndereActiviteitenPerZwemmer($id);

         $activiteiten = new stdClass;

         foreach ($zwemmerActiviteiten as $activiteit)
         {
             foreach ($activiteitenInWeek as $week)
             {
                 if ($week->id == $activiteit->andereActiviteitId)
                 {
                   $tijdstip = (string) $activiteit->activiteit->tijdstip;
                   $activiteiten->dezeWeek = $activiteit;
                   $activiteiten->dezeWeek->uur = verkortTijdstip($tijdstip);
                   $activiteiten->dezeWeek->tijdstip = substr($tijdstip, 0, 2);
                   $activiteiten->dezeWeek->isDezeWeek = 1;
                 }
             }
         }
         return $activiteiten;
     }



      /**
      * Haalt deelnames in week op van bepaalde zwemmer
      *\see reeks_model::getReeksenInWeek()
      * @param id ID van de zwemmer in kwestie
      * @param week Week in de agenda
      * @param jaar Jaar in de agenda
      * @return query Deelnames die week van opgegeven zwemmer.
      */
       public function getActiviteitenInWeekPerZwemmer($id, $week, $jaar)
       {
         $maandag = new DateTime;
         $maandag->setISODate(intval($jaar), intval($week));
         $zondag = clone $maandag;
         $zondag->modify('+6 day');

         $this->load->model('andereActiviteit_model');
         $activiteitenInWeek = $this->andereActiviteit_model->getActiviteitenInWeek($maandag, $zondag);
         if ($activiteitenInWeek != null)
         {
           foreach ($activiteitenInWeek as $activiteit)
           {
             $ids[] = $activiteit->id;
           }

           $this->db->where('gebruikerIdZwemmer', $id);
           $this->db->where_in('andereActiviteitId', $ids);
           $query = $this->db->get('activiteitPerGebruiker')->result();

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
       public function getInformatieActiviteiten($id, $week, $jaar)
       {
         $activiteiten = $this->activiteitPerGebruiker_model->getActiviteitenInWeekPerZwemmer($id, $week, $jaar);
         if ($activiteiten != null)
         {
           $this->load->model('andereActiviteit_model');
           $this->load->model('soort_model');

           foreach ($activiteiten as $activiteit)
           {
             $activiteit->andereActiviteit = $this->andereActiviteit_model->get($activiteit->andereActiviteitId);
             $tijdstip = (string) $activiteit->andereActiviteit->tijdstip;
             $activiteit->andereActiviteit->uur = verkortTijdstip($tijdstip);
             $activiteit->andereActiviteit->tijdstip = substr($tijdstip, 0, 2);
             $activiteit->andereActiviteit->soort = $this->soort_model->get($activiteit->andereActiviteit->soortId);
           }

           return $activiteiten;
         } else {
           return null;
         }

       }
}
