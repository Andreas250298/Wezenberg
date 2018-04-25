<?php
<<<<<<< HEAD
=======

>>>>>>> 503ea392d0202db6fc3d1317569532d51b2f12b9
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
<<<<<<< HEAD
=======

>>>>>>> 503ea392d0202db6fc3d1317569532d51b2f12b9
    /**
    ** Opvragen van supplementen volgens id zwemmer
    * @param $id Het ID van de zwemmer
    */
<<<<<<< HEAD
    public function getSupplementenPerZemmer($id)
    {
        $this->db->where('gebruikerIdZwemmer', $id);
        $supplementenPerZwemmer = $this->db->get('supplementPerZwemmer')->result();
=======
    public function toonSupplementenPerZemmer($id)
    {
        $this->db->where('gebruikerIdZwemmer', $id);
        $supplementenPerZwemmer = $this->db->get('supplementPerZwemmer')->result();

>>>>>>> 503ea392d0202db6fc3d1317569532d51b2f12b9
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
<<<<<<< HEAD

    /**
    * Opvragen van reeksen in een opgegeven week
    * @param maandag Datum van maandag
    * @param zondag Datum van zondag
    * @return De opgevraagde reeksen.
    */
    public function getSupplementenInWeek($maandag, $zondag)
    {
        $this->db->select('id');
        $this->db->from('supplementPerZwemmer');
        $this->db->where('datumInname >=', $maandag->format('Y-m-d') );
        $this->db->where('datumInname <=', $zondag->format('Y-m-d') );
        $query = $this->db->get();
        if ($query->num_rows() == 0)
        {
          return null;
        } else {
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
      public function getSupplementenInWeekPerZwemmer($id, $week, $jaar)
      {
        $maandag = new DateTime;
        $maandag->setISODate(intval($jaar), intval($week));
        $zondag = clone $maandag;
        $zondag->modify('+6 day');

        $supplementenInWeek = $this->supplementPerZwemmer_model->getSupplementenInWeek($maandag, $zondag);
        if ($supplementenInWeek != null)
        {
          foreach ($supplementenInWeek as $supplement)
          {
            $ids[] = $supplement->id;
          }

          $this->db->where('gebruikerIdZwemmer', $id);
          $this->db->where_in('id', $ids);
          $query = $this->db->get('supplementPerZwemmer')->result();

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
      public function getInformatieSupplementen($id, $week, $jaar)
      {
        $supplementen = $this->supplementPerZwemmer_model->getSupplementenInWeekPerZwemmer($id, $week, $jaar);
        if ($supplementen != null)
        {
          $this->load->model('supplement_model');

          foreach ($supplementen as $supplement)
          {
            $tijdstip = (string) $supplement->tijdstipInname;
            $supplement->uur = verkortTijdstip($tijdstip);
            $supplement->tijdstip = substr($tijdstip, 0, 2);
            $supplement->informatie = $this->supplement_model->get($supplement->supplementId);
          }

          return $supplementen;
        } else {
          return null;
        }

      }
=======
>>>>>>> 503ea392d0202db6fc3d1317569532d51b2f12b9
}
