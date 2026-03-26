<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Controller
{
	function __construct()
	{

		parent::__construct();
		user_auth_check(); // check login auth

		$this->load->model('user/User_model', 'user_model');

	}

	//-----------------------------------------------------		
	// ================= PROFILE =================
	public function index()
	{
		$user_id = $this->session->userdata('user_id');

		$data['user'] = $this->user_model->get_user($user_id);

		$this->load->view('user/includes/_header');
		$this->load->view('user/profile/profile', $data);
		$this->load->view('user/includes/_footer');
	}

	// ================= UPDATE PROFILE =================
	public function update_profile()
	{
		$user_id = $this->session->userdata('user_id');

		// ================= VALIDATION RULES =================
		$this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
		$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('mobile_no', 'Mobile', 'trim|required|numeric|min_length[10]|max_length[10]');
		$this->form_validation->set_rules('address', 'Address', 'trim|required');

		// ================= CHECK VALIDATION =================
		if ($this->form_validation->run() == FALSE) {

			$this->session->set_flashdata('error', validation_errors());
			redirect('user/profile'); // back to profile page

		} else {

			// ================= UPDATE DATA =================
			$data = [
				'firstname' => $this->input->post('firstname'),
				'lastname' => $this->input->post('lastname'),
				'username' => $this->input->post('username'),
				'email' => $this->input->post('email'),
				'mobile_no' => $this->input->post('mobile_no'),
				'address' => $this->input->post('address'),
				'updated_at' => date('Y-m-d H:i:s')
			];

			$this->user_model->update_profile($user_id, $data);

			// update session
			$this->session->set_userdata('username', $data['username']);

			$this->session->set_flashdata('success', 'Profile updated successfully');
			redirect('user/profile');
		}
	}

	// ================= CHANGE PASSWORD =================
	public function password()
	{
		$this->load->view('user/includes/_header');
		$this->load->view('user/profile/change_pwd');
		$this->load->view('user/includes/_footer');
	}

	// ================= UPDATE PASSWORD =================
	public function change_password()
	{
		$user_id = $this->session->userdata('user_id');

		$old = $this->input->post('old_password');
		$new = $this->input->post('new_password');
		$confirm = $this->input->post('confirm_password');


		if ($new != $confirm) {
			$this->session->set_flashdata('error', 'New & Confirm password not matching');
			redirect('user/profile/password');
		}


		if (strlen($new) < 6) {
			$this->session->set_flashdata('error', 'Password must be at least 6 characters');
			redirect('user/profile/password');
		}

		$user = $this->user_model->get_user($user_id);

		if (!password_verify($old, $user->password)) {
			$this->session->set_flashdata('error', 'Old password incorrect');
			redirect('user/profile/password');
		}

		$hashed_password = password_hash($new, PASSWORD_BCRYPT);

		$this->user_model->update_password($user_id, $hashed_password);

		$this->session->set_flashdata('success', 'Password updated successfully');
		redirect('user/profile/password');
	}

}

?>