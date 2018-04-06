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
}
