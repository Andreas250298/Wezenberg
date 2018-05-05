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
     * Een supplementPerZwemmer ophlane uit de database
     * @param id Het id van supplementPerZwemmer
     */
    public function get($id){
        $this->db->where('id', $id);
        $supplementPerZwemmer = $this->db->get('supplementPerZwemmer')->row();
        $supplementPerZwemmer->supplement = $this->supplement_model->get($supplementPerZwemmer->supplementId);
        $supplementPerZwemmer->zwemmer = $this->gebruiker_model->get($supplementPerZwemmer->gebruikerIdZwemmer);
        
        return $supplementPerZwemmer;
    }

    /**
    ** Opvragen van supplementen volgens id zwemmer
    * @param $id Het ID van de zwemmer
    */
    public function getSupplementenPerZwemmer($id)
    {
        $this->db->where('gebruikerIdZwemmer', $id);
        $query = $this->db->get('supplementPerZwemmer')->result();

        $supplementenPerZwemmer = [];
         
        foreach($query as $q){
            if ($q->datumInname > date('Y-m-d')){
                array_push($supplementenPerZwemmer, $q);
            }
        }

        if ($supplementenPerZwemmer == null) {
            return null ;
        } else {
            $this->load->model('supplement_model');
            foreach ($supplementenPerZwemmer as $supplementPerZwemmer) {
                $supplementPerZwemmer->supplement= $this->supplement_model->get($supplementPerZwemmer->supplementId);
                $supplementPerZwemmer->zwemmer = $this->gebruiker_model->get($supplementPerZwemmer->gebruikerIdZwemmer);
            }
            return $supplementenPerZwemmer;
        }
    }

    /**
    ** Opvragen van supplementen voor alle zwemmers
    *\see Supplement_model::get
    *\see Gebruiker_model::get
    *\return de supplementen voor alle zwemmers
    */
    public function getSupplementenPerAlleZwemmers()
    {
        $this->db->order_by('datumInname ASC, tijdstipInname ASC');
        $query = $this->db->get('supplementPerZwemmer')->result();
        $supplementenPerAlleZwemmers = [];
         
        foreach($query as $q){
            if ($q->datumInname > date('Y-m-d')){
                array_push($supplementenPerAlleZwemmers, $q);
            }
        }

        if ($supplementenPerAlleZwemmers == null) {
            return null ;
        } else {
            $this->load->model('supplement_model');
            $this->load->model('gebruiker_model');
            foreach ($supplementenPerAlleZwemmers as $supplementPerZwemmer) {
                $supplementPerZwemmer->supplement = $this->supplement_model->get($supplementPerZwemmer->supplementId);
                $supplementPerZwemmer->zwemmer = $this->gebruiker_model->get($supplementPerZwemmer->gebruikerIdZwemmer);
            }
            return $supplementenPerAlleZwemmers;
        }
    }

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
        $this->db->where('datumInname >=', $maandag->format('Y-m-d'));
        $this->db->where('datumInname <=', $zondag->format('Y-m-d'));
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
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
        if ($supplementenInWeek != null) {
            foreach ($supplementenInWeek as $supplement) {
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
        if ($supplementen != null) {
            $this->load->model('supplement_model');

            foreach ($supplementen as $supplement) {
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

    /**
    *Voegt een nieuw supplementPerZwemmer toevoegen
    * @param supplementPerZwemmer supplement per zwemmer
    */
    public function insert($supplementPerZwemmer)
    {
        $this->db->insert('supplementPerZwemmer', $supplementPerZwemmer);
        return $this->db->insert_id();
    }

     /**
     * Een supplementPerZwemmer wijzigen in de database
     * @param supplementPerZwemmer Het supplementPerZwemmer dat moet gewijzigd worden
     */
    public function update($supplementPerZwemmer)
    {
        $this->db->where('id', $supplementPerZwemmer->id);
        $this->db->update('supplementPerZwemmer', $supplementPerZwemmer);
    }

    /**
     * Een supplementPerZwemmer verwijderen uit de database
     * @param id Het id van het supplementPerZwemmer dat moet verwijderd worden
     */
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('supplementPerZwemmer');
    }
}
