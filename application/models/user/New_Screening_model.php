<?php defined('BASEPATH') OR exit('No direct script access allowed');

class New_Screening_model extends CI_Model
{
    // INSERT project
    public function insert_project($data)
    {
        $this->db->insert('projects', $data);
        return $this->db->insert_id();
    }

    // INSERT patient
    public function insert_patient($data)
    {
        $this->db->insert('patients', $data);
        return $this->db->insert_id();
    }

    // INSERT general
    public function insert_general($data)
    {
        return $this->db->insert('general_check', $data);
    }

    // INSERT gp
    public function insert_gp($data)
    {
        return $this->db->insert('gp_check', $data);
    }

    // INSERT special
    public function insert_special($data)
    {
        return $this->db->insert('specialty_check', $data);
    }

    // INSERT lab
    public function insert_lab($data)
    {
        return $this->db->insert('lab_reports', $data);
    }

    // INSERT Report
   public function insert_report($data)
{
    return $this->db->insert('screenings', $data);
}


// GET Patient by Id
public function get_patient_by_id($id)
    {
        return $this->db->get_where('patients', ['id' => $id])->row();
    }

    // UPDATE Patient 
    public function update_patient($id, $data)
{
    $this->db->where('id', $id);
    return $this->db->update('patients', $data);
}

}