<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('datatable'); // loaded my custom serverside datatable library
        $this->load->model('admin/Project_model', 'project_model');
    }

    public function index()
    {
        $data['title'] = 'Project List';
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/project/project_list', $data);
        $this->load->view('admin/includes/_footer', $data);
    }

    public function project_datatable_json()
    {
        $records = $this->project_model->get_all_projects();

        $data = array();
        $count = 0;

        foreach ($records['data'] as $row) {

            $status = ($row['status'] == 0) ? 'Inactive' : 'Active';

            $data[] = array(
                ++$count,
                $row['project_name'],
                '<span class="btn btn-xs btn-success">' . $status . '</span>',
                '<a class="update btn btn-sm btn-warning" href="' . base_url('admin/project/project_edit/' . $row['id']) . '"><i class="fa fa-pencil"></i></a>
             <a class="delete btn btn-sm btn-danger" href="' . base_url('admin/project/project_del/' . $row['id']) . '" onclick="return confirm(\'Delete?\')"><i class="fa fa-trash"></i></a>'
            );
        }

        $records['data'] = $data;
        echo json_encode($records);
    }

    public function project_add()
    {
        if ($this->input->post()) {

            $this->form_validation->set_rules('project', 'project', 'trim|required|is_unique[project_master.project_name]');

            if ($this->form_validation->run() === FALSE) {
                $this->load->view('admin/includes/_header');
                $this->load->view('admin/project/project_add');
                $this->load->view('admin/includes/_footer');
                return;
            }

            $data = array(
                'project_name' => ucfirst($this->input->post('project')),
                'status' => 1
            );

            $data = $this->security->xss_clean($data);
            $this->project_model->add_project($data);

            $this->session->set_flashdata('success', 'Project added successfully');
            redirect(base_url('admin/project'));
        } else {
            $data['title'] = 'Add Project';
            $this->load->view('admin/includes/_header', $data);
            $this->load->view('admin/project/project_add', $data);
            $this->load->view('admin/includes/_footer', $data);
        }
    }
    public function project_edit($id = 0)
    {
        if ($this->input->post()) {

            $this->form_validation->set_rules('project', 'project', 'trim|required');

            if ($this->form_validation->run() === FALSE) {
                $this->load->view('admin/includes/_header');
                $this->load->view('admin/project/project_edit');
                $this->load->view('admin/includes/_footer');
                return;
            }

            $data = array(
                'project_name' => ucfirst($this->input->post('project')),
                'status' => $this->input->post('status')
            );

            $data = $this->security->xss_clean($data);
            $this->project_model->edit_project($data, $id);

            $this->session->set_flashdata('success', 'Project updated successfully');
            redirect(base_url('admin/project'));
        } else {
            $data['title'] = 'Update Project';
            $data['project'] = $this->project_model->get_project_by_id($id);

            $this->load->view('admin/includes/_header', $data);
            $this->load->view('admin/project/project_edit', $data);
            $this->load->view('admin/includes/_footer', $data);
        }
    }
    public function project_del($id = 0)
    {
        $this->db->delete('project_master', array('id' => $id));
        $this->session->set_flashdata('success', 'Deleted successfully!');
        redirect(base_url('admin/project'));
    }
}