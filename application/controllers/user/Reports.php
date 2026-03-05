<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Reports extends My_Controller
{


    public function __construct()
    {

        parent::__construct();

        user_auth_check(); // check login auth	

        //$this->load->model('user/dashboard_model', 'dashboard_model');
        $this->load->model('admin/Location_Model', 'location');
        $this->load->model('user/New_Screening_model', 'screening_model');


    }

    // ===========================================================================

    public function index()
    {
        $data['title'] = 'New Screening';
        
        $this->load->view('user/includes/_header', $data);
        $this->load->view('user/reports', $data);
        $this->load->view('user/includes/_footer');
    }

}
?>