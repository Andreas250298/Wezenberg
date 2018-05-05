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
     * Een activiteit per gebruiker toevoegen aan de database
     * @param activiteit Het supplement dat moet toegevoegd worden
     * @return De insert functie van het supplement
     */
    public function insert($activiteit)
    {
        $this->db->insert('activiteitPerGebruiker', $activiteit);
        return $this->db->insert_id();
    }

    /**
     * De gebruikers horende bij een activiteit ophalen uit de database
     * @param activiteitId Het id van de activiteit waar de zwemmers aan gekoppeld zijn
     * @return De insert functie van het supplement
     */
    public function getZwemmersBijActiviteit($activiteitId)
    {
        $this->db->select('gebruikerIdZwemmer');
        $this->db->from('activiteitPerGebruiker');
        $this->db->where('andereActiviteitId', $activiteitId);
        $query = $this->db->get();

        if ($query->num_rows() != 0)
        {
          return $query->result();;
        } else {
          return null;
        }
    }

    public function deleteZwemmersBijActiviteit($id)
    {
      $this->db->where('andereActiviteitId', $id);
      $this->db->delete('activiteitPerGebruiker');
    }

    /**
    * Haalt activiteiten in week op van bepaalde zwemmer
    *\see reeks_model::getReeksenInWeek()
    * @param id ID van de zwemmer in kwestie
    * @param week Week in de agenda
    * @param jaar Jaar in de agenda
    * @return query Deelnames die week van opgegeven zwemmer.
    */
     public function getActiviteitenInWeekVoorZwemmer($id, $week, $jaar)
     {
       $maandag = new DateTime;
       $maandag->setISODate(intval($jaar), intval($week));
       $zondag = clone $maandag;
       $zondag->modify('+6 day');

       $this->load->model('gebruiker_model');
       $gebruiker = $this->gebruiker_model->get($id);

       $this->load->model('andereActiviteit_model');
       $activiteitenInWeek = $this->andereActiviteit_model->getActiviteitenInWeek($maandag, $zondag);
       if ($activiteitenInWeek != null)
       {
         foreach ($activiteitenInWeek as $activiteit)
         {
           $ids[] = $activiteit->id;
         }

         if ($gebruiker->soort == "zwemmer") {
           $this->db->where('gebruikerIdZwemmer', $id);
           $this->db->where_in('andereActiviteitId', $ids);
           $query = $this->db->get('activiteitPerGebruiker')->result();
         } else {
           $this->db->where_in('andereActiviteitId', $ids);
           $query = $this->db->get('activiteitPerGebruiker')->result();
         }

         return $query;
       } else {
         return null;
       }
     }

    /**
    * Haalt informatie op van activiteit
    *\see deelname_model::getDeelnamesInWeekPerZwemmer()
    * @param id ID van de zwemmer in kwestie
    * @param week Week in de agenda
    * @param jaar Jaar in de agenda
    * @return deelnames Activiteiten die week van opgegeven zwemmer.
    */
    public function getInformatieActiviteiten($id, $week, $jaar)
    {
      $activiteiten = $this->activiteitPerGebruiker_model->getActiviteitenInWeekVoorZwemmer($id, $week, $jaar);
      $activiteitenInformatie = new stdClass();
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
