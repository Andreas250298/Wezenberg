<?php

class Supplement_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('supplement');
        return $query->row();
    }

    public function toonSupplementen()
    {
        $this->db->order_by('naam', 'asc');
        $query = $this->db->get('supplement');
        return $query->result();
    }

    public function insert($supplement)
    {
        $this->db->insert('supplement', $supplement);
        return $this->db->insert_id();
    }

    public function update($supplement)
    {
        $this->db->where('id', $supplement->id);
        $this->db->update('supplement', $supplement);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('supplement');
    }
}
