<?php defined('BASEPATH') OR exit('No direct script access allowed');



class new_screening extends My_Controller {



	public function __construct(){

		parent::__construct();

		user_auth_check(); // check login auth	

		//$this->load->model('user/dashboard_model', 'dashboard_model');

	}

	//--------------------------------------------------------------------------

	public function index(){

		$data['title'] = 'Dashboard';
		 $data['states'] = ['Chhattisgarh','Karnataka','Tamil Nadu'];
        $data['districts'] = ['Raipur','Bangalore Urban','Chennai'];
        $data['taluks'] = ['Raipur','Whitefield','Tambaram'];
        $data['users'] = [
            ['id'=>1,'name'=>'Doctor A'],
            ['id'=>2,'name'=>'Nurse B'],
            ['id'=>3,'name'=>'Field Staff C'],
        ];

		$this->load->view('user/includes/_header', $data);

    	$this->load->view('user/new_screening');

    	$this->load->view('user/includes/_footer');

	}

	
}
?>	