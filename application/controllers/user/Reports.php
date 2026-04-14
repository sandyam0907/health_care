<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('datatable');
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
        $data['camp_types'] = $this->report_model->get_camp_types();

        $this->load->view('user/includes/_header', $data);
        $this->load->view('user/reports', $data);
        $this->load->view('user/includes/_footer');
    }

    public function reports_datatable_json()
    {
        $records = $this->report_model->get_reports();

        $data = [];

        foreach ($records as $row) {

            $status = ($row->status == 1)
                ? '<span class="badge badge-success">Completed</span>'
                : '<span class="badge badge-warning">Pending</span>';

            $reportUrl = base_url('user/reports/export_pdf/' . $row->report_id . '/view');
            $downloadUrl = base_url('user/reports/export_pdf/' . $row->report_id . '/download');
            $encodedUrl = urlencode($reportUrl);
            $emailSubject = urlencode("Health Report - " . $row->report_id);
            $emailBody = urlencode("Please find the health report here: " . $reportUrl);

            $actions = '
<div class="flex">

    <!-- View -->
    <a href="' . base_url('user/reports/view/' . $row->report_id) . '" 
       class="btn btn-outline-primary btn-sm view-btn" title="View">
        <i class="fa fa-eye"></i>
    </a>

      <!-- Edit -->
    <a href="' . base_url('user/new_screening/edit/' . $row->report_id) . '" 
       class="btn btn-outline-warning btn-sm edit-btn" title="Edit">
        <i class="fa fa-pencil"></i>
    </a>


    <!-- Share Dropdown -->
    <div class="btn-group">
        <button type="button" class="btn btn-outline-success btn-sm dropdown-toggle"
                data-toggle="dropdown" title="Share">
            <i class="fa fa-share-alt"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right">
         <a class="dropdown-item" href="' . $downloadUrl . '">
        <i class="fa fa-download text-danger"></i> Download Report
    </a>
            <a class="dropdown-item" target="_blank"
               href="https://wa.me/?text=' . $encodedUrl . '">
                <i class="fa fa-whatsapp text-success"></i> WhatsApp
            </a>
            <a class="dropdown-item"
               href="mailto:?subject=' . $emailSubject . '&body=' . $emailBody . '">
                <i class="fa fa-envelope text-primary"></i> Email
            </a>
        </div>
    </div>

    <!-- QR Code Button -->
    <button class="btn btn-outline-info btn-sm qr-btn" 
            data-url="' . $reportUrl . '" 
            title="Show QR Code">
        <i class="fa fa-qrcode"></i>
    </button>

     <!-- View Report PDF -->
    <a href="' . $reportUrl . '" 
       class="btn btn-outline-danger btn-sm pdf-btn" target="_blank" title="Download PDF">
        <i class="fa fa-file-pdf-o"></i>
    </a>

  

</div>';

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
            "recordsFiltered" => $this->report_model->count_filtered(),
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

    public function export_pdf($report_id, $mode = 'view')
    {
        $this->load->library('pdf');

        $report_data = $this->report_model->get_individual_report($report_id);

        if (!$report_data) {
            show_error('No data found for the given Report ID.');
        }

        $data['report'] = $report_data;
        $html = $this->load->view('user/report_pdf', $data, true);

        // If mode is 'download', force download
        $download = ($mode === 'download');

        $this->pdf->generate($html, "Report_" . $report_id, $download);
    }



}