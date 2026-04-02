<?php defined('BASEPATH') OR exit('No direct script access allowed');

class New_Screening_model extends CI_Model
{
    // --------------------------INSERT----------------------------------------------
    // INSERT project
    public function add_project($data)
    {
        $this->db->insert('projects', $data);
        return $this->db->insert_id();

    }

    // INSERT patient
    public function add_patient($data)
    {
        $this->db->insert('patients', $data);
        return $this->db->insert_id();
    }

    // INSERT Screening 
    public function add_screening($data)
    {
        $this->db->insert('screenings', $data);
        return $this->db->insert_id();
    }

    // INSERT general
    public function add_general($data)
    {
        $this->db->insert('general_check', $data);
        return $this->db->insert_id();
    }

    // INSERT gp
    public function add_gp($data)
    {
        $this->db->insert('gp_check', $data);
        return $this->db->insert_id();
    }

    // INSERT special
    public function add_special($data)
    {
        $this->db->insert('specialty_check', $data);
        return $this->db->insert_id();
    }

    // INSERT lab
    public function add_lab($data)
    {
        $this->db->insert('lab_reports', $data);
        return $this->db->insert_id();
    }

      // INSERT patients Report
    public function add_patient_report($data)
    {
        $this->db->insert('patient_reports', $data);
    }


    // --------------------------GET----------------------------------------------

    //GET Project By Id
    public function get_project_by_id($id)
    {
        return $this->db->get_where('projects', ['id' => $id])->row();
    }

    public function get_project_names()
    {
        return $this->db
            ->select('id, project_name')
            ->from('project_master')
            ->where('status', 1)
            ->order_by('project_name', 'ASC')
            ->get()
            ->result();
    }


    // GET Patient by Id
    public function get_patient_by_id($id)
    {
        return $this->db->get_where('patients', ['id' => $id])->row();
    }

    // Generate report Id
    public function generate_report_id()
    {
        $year = date('Y');

        $this->db->select('report_id');
        $this->db->like('report_id', "UPH-$year", 'after');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);

        $query = $this->db->get('patient_reports');

        if ($query->num_rows() > 0) {
            $last = $query->row()->report_id;

            $parts = explode('-', $last);
            $seq = (int) $parts[2] + 1;
        } else {
            $seq = 1;
        }

        $seq = str_pad($seq, 3, '0', STR_PAD_LEFT);

        return "UPH-$year-$seq";
    }

// ---------------------------------update-------------------------------------------------

    public function update_general($id, $data)
    {
        return $this->db->where('id', $id)->update('general_check', $data);
    }

    public function update_gp($id, $data)
    {
        return $this->db->where('id', $id)->update('gp_check', $data);
    }

    public function update_special($id, $data)
    {
        return $this->db->where('id', $id)->update('specialty_check', $data);
    }

    public function update_lab($id, $data)
    {
        return $this->db->where('id', $id)->update('lab_reports', $data);
    }
       // UPDATE Patient 
    public function update_patient($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('patients', $data);
    }

}