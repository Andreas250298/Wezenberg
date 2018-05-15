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
     * Een deelname ophalen uit de database
     * @param id Het id van de deelname
     * @return Het opgevraagde record
     */
    public function get($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('deelname');
        return $query->row();
    }

    /**
     * past een deelname aan in de database
     * @param deelname de toe te voegen deelname
     */
    public function update($deelname)
    {
        $this->db->where('id', $deelname->id);
        $this->db->update('deelname', $deelname);
    }

    /**
     * Keurt een deelname aan in de database
     * @param deelname de toe te voegen deelname
     */
    public function behandelInschrijving($id, $goed)
    {
        $deelname = $this->deelname_model->get($id);
        if ($goed) {
            $deelname->statusId = 2;
        } else {
            $deelname->statusId = 3;
        }

        $this->deelname_model->update($deelname);
    }

    /**
     * Alle deelnames ophalen uit de database gesorteerd op soort
     * @param id Het id van de deelname
     * @return deelnames Alle deelnames met hun informatie
     */
    public function getDeelnamesMetStatus()
    {
        $ids = array(1, 2, 3);

        $this->db->where_in('statusId', $ids);
        $this->db->order_by("statusId", "asc");
        $deelnames = $this->db->get('deelname')->result();

        $this->load->model('gebruiker_model');
        $this->load->model('status_model');
        $this->load->model('reeks_model');
        $this->load->model('wedstrijd_model');
        $this->load->model('slag_model');
        $this->load->model('afstand_model');

        foreach ($deelnames as $deelname) {
            $deelname->zwemmer = $this->gebruiker_model->get($deelname->gebruikerIdZwemmer);
            $deelname->status = $this->status_model->get($deelname->statusId);
            $deelname->reeks = $this->reeks_model->get($deelname->reeksId);
            $deelname->reeks->wedstrijd = $this->wedstrijd_model->get($deelname->reeks->wedstrijdId);
            $deelname->reeks->slag = $this->slag_model->get($deelname->reeks->slagId);
            $deelname->reeks->afstand = $this->afstand_model->get($deelname->reeks->afstandId);
            if ($deelname->reeks->wedstrijd->beginDatum > date('Y-m-d')) {
                $deelname->tijd = "na";
            } else {
                $deelname->tijd = "voor";
            }
        }

        return $deelnames;
    }

    /**
     * Een deelname toevoegen aan de database
     * @param deelname De deelname die moet toegevoegd worden
     * @return Het insert id van de deelname
     */
    public function insert($deelname)
    {
        $this->db->insert('deelname', $deelname);
        return $this->db->insert_id();
    }

    /**
     * Deelname(s) van een zwemmer ophalen uit de database
     * @param id Het id van de zwemmer waar de deelnames aan gekoppeld zijn
     * @return De opgevraagde record(s)
     */
    public function getDeelnamesPerZwemmer($id)
    {
        $this->db->where('statusId', '2');
        $this->db->where('gebruikerIdZwemmer', $id);
        $query = $this->db->get('deelname');

        if ($query->num_rows() == 0) {
            return null;
        } else {
            return $query->result();
        }
    }

    /**
     * Deelname(s) van een zwemmer aan een wedstrijd ophalen uit de database
     * @see wedstrijd_model::getReeksenPerWedstrijd();
     * @see reeks_model::getReeksMetInfo();
     * @param wedstrijdId Het id van de wedstrijd waar de deelnames van opgehaald moeten worden
     * @param zwemmerId Het id van de zwemmer waar de deelnames aan gekoppeld zijn
     * @return De opgevraagde record(s)
     */
     public function getDeelnamesBijWedstrijd($wedstrijdId, $zwemmerId)
     {
         $this->load->model('wedstrijd_model');
         $reeksen = $this->wedstrijd_model->getReeksenPerWedstrijd($wedstrijdId);

         if ($reeksen != null) {
            foreach ($reeksen as $reeks) {
                 $ids[] = $reeks->id;
             }
             $this->db->where('gebruikerIdZwemmer', $zwemmerId);
             $this->db->where_in('reeksId', $ids);
             $deelnames = $this->db->get('deelname')->result();

             $this->load->model('reeks_model');
             foreach ($deelnames as $deelname) {
                 $deelname->reeks = $this->reeks_model->getReeksMetInfo($deelname->reeksId);
             }
             return $deelnames;
        } else {
            return null;
        }
     }

    /**
    * Haalt deelnames in week op van bepaalde zwemmer
    * @see Reeks_model::getReeksenInWeek()
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
        if ($reeksenInWeek != null) {
            foreach ($reeksenInWeek as $reeks) {
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
    * Haalt deelnames in toekomst of verleden op van bepaalde zwemmer
    * @see Reeks_model::getReeksenVoorOfNaVandaag()
    * @param id ID van de zwemmer in kwestie
    * @return query Deelnames die week van opgegeven zwemmer.
    */
    public function getDeelnamesVoorOfNaVandaagPerZwemmer($id, $voor = False)
    {
        $this->load->model('reeks_model');
        $reeksen = $this->reeks_model->getReeksenVoorOfNaVandaag($voor);

        if ($reeksen != null) {
            foreach ($reeksen as $reeks) {
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
    * Haalt deelnames in verleden op van bepaalde zwemmer
    * @see Reeks_model::getReeksenVanafVandaag()
    * @param id ID van de zwemmer in kwestie
    * @return query Deelnames die week van opgegeven zwemmer.
    */
    public function getDeelnamesVoorVandaagPerZwemmer($id)
    {
        $this->load->model('reeks_model');
        $reeksen = $this->reeks_model->getReeksenVoorVandaag();
        if ($reeksen != null) {
            foreach ($reeksen as $reeks) {
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
     * Een status ophalen uit de database
     * @see Status_model::get()
     * @param id Het id van de gebruiker waarvan de status opgevraagd wordt
     * @return deelname De opgevraagde record
     */
    public function getStatusPerGebruiker($id)
    {
        $this->db->where('gebruikerIdZwemmer', $id);
        $query = $this->db->get('deelname');
        $deelname = $query->row();
        $this->load->model('status_model');
        if (isset($deelname)) {
            $deelname->status = $this->status_model->get($deelname->statusId);
        }

        return $deelname;
    }

    /**
    * Haalt informatie over bepaalde deelnames.
    * @see Deelname_model::getDeelnamesInWeekPerZwemmer()
    * @see Deelname_model::getDeelnamesVanafVandaagPerZwemmer()
    * @see Reeks_model::get()
    * @see Afstand_model::get()
    * @see Wedstrijd_model::get()
    * @see Slag_model::get()
    * @param id ID van de zwemmer in kwestie
    * @param voor Of er moet gekeken worden naar de deelnames voor of na vandaag
    * @param week Week in de agenda
    * @param jaar Jaar in de agenda
    * @return deelnames Wedstrijden die week van opgegeven zwemmer.
    */
    public function getInformatieDeelnames($id, $voor = false, $week = null, $jaar = null)
    {
      if (isset($week) && isset($jaar))
      {
        $deelnames = $this->deelname_model->getDeelnamesInWeekPerZwemmer($id, $voor, $week, $jaar);
      } else {
        $deelnames = $this->deelname_model->getDeelnamesVoorOfNaVandaagPerZwemmer($id, $voor);
      }
        if ($deelnames != null) {
            $this->load->model('wedstrijd_model');
            $this->load->model('slag_model');
            $this->load->model('afstand_model');
            $this->load->model('reeks_model');

            foreach ($deelnames as $deelname) {
                $deelname->reeks = $this->reeks_model->get($deelname->reeksId);
                $tijdstip = (string) $deelname->reeks->tijdstip;
                $deelname->reeks->uur = verkortTijdstip($tijdstip);
                $deelname->reeks->tijdstip = substr($tijdstip, 0, 2);
                $deelname->afstand = $this->afstand_model->get($deelname->reeks->afstandId);
                $deelname->slag = $this->slag_model->get($deelname->reeks->slagId);
                $deelname->wedstrijd = $this->wedstrijd_model->get($deelname->reeks->wedstrijdId);
                $deelname->reeks->tijdstip = (string) $deelname->reeks->tijdstip;
                if ($voor)
                {
                  $this->load->model('rondeResultaat_model');
                  $deelname->resultaat = $this->rondeResultaat_model->getResultatenPerDeelname($deelname->id);
                }
            }

            return $deelnames;
        } else {
            return null;
        }
    }
    /**
    * geeft de resultaten terug per een bepaalde deelname.
    * @return query De opgevraagde record(s)
    */
    public function getResultatenPerDeelname($id)
    {
        $this->db->where('deelnameId', $id);
        $query = $this->db->get('rondeResultaat');
        if ($query->num_rows() == 0) {
            return null;
        } else {
            return $query->result();
        }
    }
}
