<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Dashboard extends My_Controller
{
	public function __construct()
	{
		parent::__construct();

		user_auth_check(); // check login auth

		$this->load->model('admin/Location_Model', 'location');
		$this->load->model('admin/Notice_model', 'notice_model');
		$this->load->model('user/Report_model', 'report_model');
		$this->load->model('user/Dashboard_model', 'dashboard_model');
	}

	//--------------------------------------------------------------------------

	public function index()
	{
		$data['title'] = 'Dashboard';

		// $data['notices'] = $this->notice_model->get_active_notices();

		// Get Filters
		$filters = [
			'from_date' => $this->input->get('from_date'),
			'to_date' => $this->input->get('to_date'),
			'district' => $this->input->get('district'),
			'camp_type' => $this->input->get('camp_type'),
			'status' => $this->input->get('status')
		];
		$trend_filters = $filters;

		// apply default only for trend
		if (empty($trend_filters['from_date']) && empty($trend_filters['to_date'])) {
			$trend_filters['from_date'] = date('Y-m-01'); // first day of month
			$trend_filters['to_date'] = date('Y-m-d');    // today
		}

		// Summary
		$data['total_screenings'] = $this->dashboard_model->get_total_screenings($filters);
		$data['total_camps'] = $this->dashboard_model->get_total_camps($filters);
		$data['total_patients'] = $this->dashboard_model->get_total_patients($filters);
		$data['today'] = $this->dashboard_model->get_today_screenings($filters);

		// Chart Data
		$data['status_data'] = $this->dashboard_model->get_status_data($filters);
		$data['top_districts'] = $this->dashboard_model->get_top_districts($filters);
		$data['trend_data'] = $this->dashboard_model->get_trend_data($trend_filters);
		$data['gender_data'] = $this->dashboard_model->get_gender_data($filters);
		$data['age_data'] = $this->dashboard_model->get_age_group_data($filters);
		$data['district_wise'] = $this->dashboard_model->get_district_wise_screenings($filters);

		// Filter Dropdown
		$data['districts'] = $this->location->get_districts_dropdown();
		$data['camp_types'] = $this->report_model->get_camp_types();

		$this->load->view('user/includes/_header', $data);
		$this->load->view('user/dashboard', $data);
		$this->load->view('user/includes/_footer');
	}

	//--------------------------------------------------------------------------
	public function get_filtered_data()
	{
		$filters = [
			'from_date' => $this->input->post('from_date'),
			'to_date' => $this->input->post('to_date'),
			'district' => $this->input->post('district'),
			'status' => $this->input->post('status'),
			'camp_type' => $this->input->post('camp_type')
		];

		$data['total_screenings'] = $this->dashboard_model->get_total_screenings($filters);
		$data['total_camps'] = $this->dashboard_model->get_total_camps($filters);
		$data['total_patients'] = $this->dashboard_model->get_total_patients($filters);
		$data['today'] = $this->dashboard_model->get_today_screenings($filters);
		$data['status_data'] = $this->dashboard_model->get_status_data($filters);
		$data['district_data'] = $this->dashboard_model->get_top_districts($filters);
		$data['trend_data'] = $this->dashboard_model->get_trend_data($filters);
		$data['gender_data'] = $this->dashboard_model->get_gender_data($filters);
		$data['age_data'] = $this->dashboard_model->get_age_group_data($filters);

		echo json_encode($data);
	}

	//--------------------------------------------------------------------------
	public function get_district_card()
	{
		$district = $this->input->post('district');
		$data = $this->dashboard_model->get_district_for_cardData($district);
		echo json_encode($data);
		exit;
	}

	//--------------------------------------------------------------------------

	public function index_1()
	{

		$data['all_users'] = $this->dashboard_model->get_all_users();

		$data['active_users'] = $this->dashboard_model->get_active_users();

		$data['deactive_users'] = $this->dashboard_model->get_deactive_users();

		$data['title'] = 'Dashboard';

		$this->load->view('admin/includes/_header', $data);

		$this->load->view('admin/dashboard/index', $data);

		$this->load->view('admin/includes/_footer');

	}



	//--------------------------------------------------------------------------

	public function index_2()
	{

		$data['title'] = 'Dashboard';


		$this->load->view('admin/includes/_header');

		$this->load->view('admin/dashboard/index2');

		$this->load->view('admin/includes/_footer');

	}



	//--------------------------------------------------------------------------

	public function index_3()
	{

		$data['title'] = 'Dashboard';

		$this->load->view('admin/includes/_header');

		$this->load->view('admin/dashboard/index3');

		$this->load->view('admin/includes/_footer');

	}


}
?>