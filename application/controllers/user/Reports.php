<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('user/Report_model', 'report_model');
        $this->load->model('admin/Location_Model', 'location');
    }

    // Load report page
    public function index()
    {
        $data['title'] = "Reports";

        // District dropdown
        $data['districts'] = $this->location->get_districts_dropdown();

        // camp type dropdown
        $data['projects'] = $this->report_model->get_camp_types();

        $this->load->view('user/includes/_header', $data);
        $this->load->view('user/reports', $data);
        $this->load->view('user/includes/_footer');
    }

    // AJAX DataTables
    public function reports_datatable_json()
    {
        $records = $this->report_model->get_reports();

        $data = [];

        foreach ($records as $row) {

            $status = ($row->status == 1)
                ? '<span class="badge badge-success">Completed</span>'
                : '<span class="badge badge-warning">Pending</span>';

            $actions = '
                <div class="flex">

                <a href="' . base_url('user/reports/view/' . $row->report_id) . '" class="btn btn-primary btn-sm">
                <i class="fa fa-eye"></i>
                </a>

                <button class="btn btn-secondary btn-sm">
                <i class="fa fa-file-pdf-o"></i>
                </button>

                <button class="btn btn-warning btn-sm">
                <i class="fa fa-pencil"></i>
                </button>

                </div>
            ';

            $data[] = array(
                $row->report_id,
                $row->first_name . ' ' . $row->last_name,
                $row->age . ' / ' . $row->gender,
                $row->district_name,
                date('d-m-Y', strtotime($row->camp_date)),
                $status,
                $actions
            );
        }

        echo json_encode([
            "draw" => intval($this->input->post('draw')),
            "recordsTotal" => $this->report_model->count_all(),
            "recordsFiltered" => count($records),
            "data" => $data
        ]);
    }

    public function view($report_id)
    {
        $data['title'] = "View Report";

        
        // get report data from model
        $data['report'] = $this->report_model->get_individual_report($report_id);

        // load views
        $this->load->view('user/includes/_header', $data);
        $this->load->view('user/report_view', $data);
        $this->load->view('user/includes/_footer');
    }

    
}