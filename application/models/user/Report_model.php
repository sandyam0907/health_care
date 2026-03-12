<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_camp_types()
    {
        $this->db->select('project_name');
        $this->db->from('projects');
        $this->db->group_by('project_name');

        $query = $this->db->get();

        return $query->result();
    }

    public function count_all()
    {
        return $this->db->count_all('screenings');
    }

    public function get_all_reports()
    {

        $this->db->select('
            screenings.id as report_id,
            projects.camp_date,
            projects.status,
            patients.first_name,
            patients.last_name,
            patients.age,
            patients.gender,
            ci_districts.district_name
        ');

        $this->db->from('screenings');

        $this->db->join('projects', 'projects.id = screenings.project_id');
        $this->db->join('patients', 'patients.id = screenings.patient_id');
        $this->db->join('ci_districts', 'ci_districts.id = projects.district_id');

        // Filters
        if ($this->input->post('district')) {
            $this->db->where('projects.district_id', $this->input->post('district'));
        }

        if ($this->input->post('from_date')) {
            $this->db->where('projects.camp_date >=', $this->input->post('from_date'));
        }

        if ($this->input->post('to_date')) {
            $this->db->where('projects.camp_date <=', $this->input->post('to_date'));
        }

        if ($this->input->post('status') !== "") {
            $this->db->where('projects.status', $this->input->post('status'));
        }

        if ($this->input->post('camp_type')) {
            $this->db->where('projects.project_name', $this->input->post('camp_type'));
        }
        if ($this->input->post('keyword')) {
            $keyword = $this->input->post('keyword');

            $this->db->group_start();
            $this->db->like('patients.mobile', $keyword);
            $this->db->or_like('patients.id', $keyword);
            $this->db->or_like('projects.id', $keyword);
            $this->db->group_end();
        }

        $query = $this->db->get();

        return $query->result();
    }



    public function get_reports()
    {

        $this->db->select('
            patient_reports.report_id,
            projects.camp_date,
            projects.status,
            patients.first_name,
            patients.last_name,
            patients.age,
            patients.gender,
            ci_districts.district_name
        ');

        $this->db->from('patient_reports');

        $this->db->join('projects', 'projects.id = patient_reports.project_id');
        $this->db->join('patients', 'patients.id = patient_reports.patient_id');
        $this->db->join('ci_districts', 'ci_districts.id = projects.district_id');

        // Filters
        if ($this->input->post('district')) {
            $this->db->where('projects.district_id', $this->input->post('district'));
        }

        if ($this->input->post('from_date')) {
            $this->db->where('projects.camp_date >=', $this->input->post('from_date'));
        }

        if ($this->input->post('to_date')) {
            $this->db->where('projects.camp_date <=', $this->input->post('to_date'));
        }

        if ($this->input->post('status') !== "") {
            $this->db->where('projects.status', $this->input->post('status'));
        }

        if ($this->input->post('camp_type')) {
            $this->db->where('projects.project_name', $this->input->post('camp_type'));
        }
        if ($this->input->post('keyword')) {
            $keyword = $this->input->post('keyword');

            $this->db->group_start();
            $this->db->like('patients.mobile', $keyword);
            $this->db->or_like('patients.id', $keyword);
            $this->db->or_like('projects.id', $keyword);
            $this->db->group_end();
        }
        $this->db->order_by('patient_reports.id', 'DESC');

        $query = $this->db->get();

        return $query->result();

    }


public function get_individual_report($report_id)
{
    $this->db->select('
        patient_reports.report_id,
        projects.project_name,
        projects.camp_date,
        projects.location,
        projects.pincode,

        ci_districts.district_name,
        ci_states.name,
        ci_taluks.taluk_name,

        patients.first_name,
        patients.last_name,
        patients.age,
        patients.gender,
        patients.mobile,

        general_check.*,
        gp_check.*,
        specialty_check.*,
        lab_reports.*
    ');

    $this->db->from('patient_reports');

    $this->db->join('projects', 'projects.id = patient_reports.project_id', 'left');
    $this->db->join('patients', 'patients.id = patient_reports.patient_id', 'left');

    $this->db->join('ci_districts', 'ci_districts.id = projects.district_id');
    $this->db->join('ci_states', 'ci_states.id = projects.state_id');
    $this->db->join('ci_taluks', 'ci_taluks.id = projects.taluk_id');

    $this->db->join('general_check', 'general_check.id = patient_reports.general_check_id', 'left');
    $this->db->join('gp_check', 'gp_check.id = patient_reports.gp_check_id', 'left');
    $this->db->join('specialty_check', 'specialty_check.id = patient_reports.specialty_check_id', 'left');
    $this->db->join('lab_reports', 'lab_reports.id = patient_reports.lab_reports_id', 'left');

    $this->db->where('patient_reports.report_id', $report_id);

    $query = $this->db->get();

    return $query->row();
}
}