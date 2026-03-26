<?php

class Dashboard_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    // Filters
    private function apply_filters($filters)
    {
        if (!empty($filters['district'])) {
            $this->db->where('projects.district_id', $filters['district']);
        }
        if (!empty($filters['from_date'])) {
            $this->db->where('projects.camp_date >=', $filters['from_date']);
        }

        if (!empty($filters['to_date'])) {
            $this->db->where('projects.camp_date <=', $filters['to_date']);
        }
        if (isset($filters['status']) && $filters['status'] !== '') {
            $this->db->where('patient_reports.status', $filters['status']);
        }
        if (!empty($filters['camp_type'])) {
            $this->db->where('projects.project_master_id', $filters['camp_type']);
        }
    }


    // =========================
    // SUMMARY CARDS
    // =========================

    public function get_total_screenings($filters = [])
    {
        $this->db->from('patient_reports');
        $this->db->join('projects', 'projects.id = patient_reports.project_id', 'left');
        $this->apply_filters($filters);
        return $this->db->count_all_results();
    }

    public function get_total_camps($filters = [])
    {
        $this->db->from('projects');

        // apply only project-related filters
        if (!empty($filters['district'])) {
            $this->db->where('projects.district_id', $filters['district']);
        }

        if (!empty($filters['from_date'])) {
            $this->db->where('projects.camp_date >=', $filters['from_date']);
        }

        if (!empty($filters['to_date'])) {
            $this->db->where('projects.camp_date <=', $filters['to_date']);
        }

        if (!empty($filters['camp_type'])) {
            $this->db->where('projects.project_master_id', $filters['camp_type']);
        }
        // $this->db->where('projects.status', 1);
        return $this->db->count_all_results();
    }

    public function get_total_patients($filters = [])
    {
        $this->db->select('COUNT(DISTINCT patients.id) as total');
        $this->db->from('patients');
        $this->db->join('patient_reports', 'patient_reports.patient_id = patients.id', 'left');
        $this->db->join('projects', 'projects.id = patient_reports.project_id', 'left');

        $this->apply_filters($filters);

        return $this->db->get()->row()->total;
    }

    public function get_today_screenings($filters = [])
    {
        $this->db->from('patient_reports');
        $this->db->join('projects', 'projects.id = patient_reports.project_id', 'left');
        $this->db->where('patient_reports.created_date', date('Y-m-d'));

        $this->apply_filters($filters);

        return $this->db->count_all_results();
    }

    // =========================
    // CHART DATA
    // =========================

    // Gender Distribution
    public function get_gender_data($filters = [])
    {
        $this->db->select('patients.gender, COUNT(DISTINCT patients.id) as total');
        $this->db->from('patients');
        $this->db->join('patient_reports', 'patient_reports.patient_id = patients.id', 'left');
        $this->db->join('projects', 'projects.id = patient_reports.project_id', 'left');

        $this->apply_filters($filters);

        $this->db->group_by('patients.gender');

        return $this->db->get()->result();
    }

    // Age Group Distribution
    public function get_age_group_data($filters = [])
    {
        $this->db->select("
        CASE 
            WHEN patients.age < 18 THEN 'Children (0-17)'
            WHEN patients.age BETWEEN 18 AND 45 THEN 'Adults (18-45)'
            WHEN patients.age BETWEEN 46 AND 60 THEN 'Middle Age (46-60)'
            ELSE 'Senior Citizens (60+)'
        END AS age_group,
        COUNT(DISTINCT patients.id) AS total
    ");

        $this->db->from('patients');
        $this->db->join('patient_reports', 'patient_reports.patient_id = patients.id', 'left');
        $this->db->join('projects', 'projects.id = patient_reports.project_id', 'left');

        $this->apply_filters($filters);

        $this->db->group_by('age_group');

        return $this->db->get()->result();
    }

    // All Districts Screening 
    public function get_district_wise_screenings($filters = [])
    {
        $this->db->select('ci_districts.district_name, COUNT(DISTINCT patient_reports.id) as total');

        $this->db->from('patient_reports');
        $this->db->join('projects', 'projects.id = patient_reports.project_id');
        $this->db->join('ci_districts', 'ci_districts.id = projects.district_id');

        $this->apply_filters($filters);
        $this->db->group_by('ci_districts.id');
        $this->db->order_by('total', 'DESC');

        return $this->db->get()->result();
    }

    // Status (Completed / Pending)
    public function get_status_data($filters = [])
    {
        $this->db->select('patient_reports.status, COUNT(*) as total');
        $this->db->from('patient_reports');
        $this->db->join('projects', 'projects.id = patient_reports.project_id', 'left');
        $this->apply_filters($filters);
        $this->db->group_by('patient_reports.status');
        return $this->db->get()->result();
    }

    // Top districts
    public function get_top_districts($filters = [])
    {
        $this->db->select('ci_districts.district_name, COUNT(*) as total');
        $this->db->from('patient_reports');
        $this->db->join('projects', 'projects.id = patient_reports.project_id', 'left');
        $this->db->join('ci_districts', 'ci_districts.id = projects.district_id');

        $this->apply_filters($filters);

        $this->db->group_by('projects.district_id');
        $this->db->order_by('total', 'DESC');
        $this->db->limit(5);

        return $this->db->get()->result();
    }

    // Trend (daily)
    public function get_trend_data($filters = [])
    {
        $this->db->select('DATE(projects.camp_date) as date, COUNT(*) as total');
        $this->db->from('patient_reports');
        $this->db->join('projects', 'projects.id = patient_reports.project_id', 'left');
        $this->apply_filters($filters);
        $this->db->group_by('DATE(projects.camp_date)');
        $this->db->order_by('date', 'ASC');
        return $this->db->get()->result();
    }

    public function get_district_for_cardData($district)
    {
        $this->db->select('ci_districts.district_name, COUNT(patient_reports.id) as total');
        $this->db->from('patient_reports');
        $this->db->join('projects', 'projects.id = patient_reports.project_id');
        $this->db->join('ci_districts', 'ci_districts.id = projects.district_id');

        if (!empty($district)) {
            $this->db->where('projects.district_id', $district);
        }

        $this->db->group_by('ci_districts.id');

        return $this->db->get()->result();
    }

}
?>