<?php

/**
 * @class AndereActiviteit_model
 * @brief Model-klasse voor activiteiten
 *
 * Model-klasse die alle methodes bevat om te interageren met de andereActiviteit tabel
 */
class AndereActiviteit_model extends CI_Model
{
  /**
   * Constructor
   */
  public function __construct()
  {
      parent::__construct();
  }
  /**
   * Een supplement ophalen uit de database
   * @param $id Het id van het supplement dat opgevraagd wordt
   * @return De opgevraagde records
   */
  public function get($id)
  {
      $this->db->where('id', $id);
      $query = $this->db->get('andereActiviteit');

      $this->model->load('soort_model');
      $this->db->where('id' == $query->soortId);
      $query->soort = $this->db->get('soort');

      return $query->row();
  }
  /**
   * Een supplement toevoegen aan de database
   * @param $supplement Het supplement dat moet toegevoegd worden
   * @return De insert functie van het supplement
   */
  public function insert($activiteit)
  {
      $this->db->insert('andereActiviteit', $activiteit);
      return $this->db->insert_id();
  }
  /**
   * Een supplement wijzigen in de database
   * @param $supplement Het supplement dat moet gewijzigd worden
   */
  public function update($activiteit)
  {
      $this->db->where('id', $activiteit->id);
      $this->db->update('andereActiviteit', $activiteit);
  }
  /**
   * Een supplement verwijderen uit de database
   * @param $id Het id van het supplement dat moet verwijderd worden
   */
  public function delete($id)
  {
      $this->db->where('id', $id);
      $this->db->delete('andereActiviteit');
  }

  /**
  * Opvragen van activiteiten in een opgegeven week
  * @param maandag Datum van maandag
  * @param zondag Datum van zondag
  * @return De opgevraagde activiteiten.
  */
  public function getActiviteitenInWeek($maandag, $zondag)
  {
      $this->db->select('id');
      $this->db->from('andereActiviteit');
      $this->db->where('beginDatum >=', $maandag->format('Y-m-d') );
      $this->db->where('beginDatum <=', $zondag->format('Y-m-d') );
      $query = $this->db->get();
      if ($query->num_rows() == 0)
      {
        return null;
      } else {
        return $query->result();
      }
  }
}
