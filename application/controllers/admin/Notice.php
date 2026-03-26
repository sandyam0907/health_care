<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Notice extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('datatable');
        $this->load->model('admin/Notice_model', 'notice_model');
    }

    // ================= LIST =================
    public function index()
    {
        $data['title'] = 'Notice List';
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/notices/notice_list', $data);
        $this->load->view('admin/includes/_footer');
    }

    // ================= DATATABLE =================
    public function notice_datatable_json()
    {
        $records = $this->notice_model->get_all_notices();

        $data = array();
        $count = 0;

        foreach ($records['data'] as $row) {

            $status = ($row['status'] == 0) ? 'Inactive' : 'Active';

            $data[] = array(
                ++$count,
                $row['title'],
                substr($row['message'], 0, 50) . '...',
                $row['valid_till'],
                '<span class="btn btn-xs btn-success">' . $status . '</span>',
                '<a class="btn btn-warning btn-sm" href="' . base_url('admin/notice/notice_edit/' . $row['id']) . '"><i class="fa fa-pencil"></i></a>
                 <a class="btn btn-danger btn-sm" href="' . base_url('admin/notice/notice_del/' . $row['id']) . '" onclick="return confirm(\'Delete?\')"><i class="fa fa-trash"></i></a>'
            );
        }

        $records['data'] = $data;
        echo json_encode($records);
    }

    // ================= FILE UPLOAD =================
    private function upload_notice_file()
    {
        if (!empty($_FILES['file']['name'])) {

            // create folder if not exists
            if (!is_dir('./uploads/notices/')) {
                mkdir('./uploads/notices/', 0777, true);
            }

            $config['upload_path'] = './uploads/notices/';
            $config['allowed_types'] = 'pdf';
            $config['file_name'] = time();

            $this->load->library('upload');
            $this->upload->initialize($config);

            if ($this->upload->do_upload('file')) {
                $file_data = $this->upload->data();
                return $file_data['file_name'];
            } else {
                log_message('error', $this->upload->display_errors());
            }
        }

        return null;
    }

    // ================= ADD =================
    public function notice_add()
    {
        if ($this->input->post()) {

            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('message', 'Message', 'required');
            $this->form_validation->set_rules('valid_till', 'Valid Till', 'required');

            if ($this->form_validation->run() === FALSE) {
                $this->load->view('admin/includes/_header');
                $this->load->view('admin/notices/notice_add');
                $this->load->view('admin/includes/_footer');
                return;
            }

            $file_name = $this->upload_notice_file();

            $data = [
                'title' => $this->input->post('title'),
                'message' => $this->input->post('message'),
                'valid_till' => $this->input->post('valid_till'),
                'file' => $file_name,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $this->notice_model->add_notice($data);

            $this->session->set_flashdata('success', 'Notice added successfully');
            redirect('admin/notice');
        }

        $this->load->view('admin/includes/_header');
        $this->load->view('admin/notices/notice_add');
        $this->load->view('admin/includes/_footer');
    }

    // ================= EDIT =================
    public function notice_edit($id)
    {
        $notice = $this->notice_model->get_notice_by_id($id);

        if ($this->input->post()) {

            $file_name = $notice['file'];

            // if new file uploaded
            if (!empty($_FILES['file']['name'])) {

                // delete old file
                if (!empty($notice['file']) && file_exists('./uploads/notices/' . $notice['file'])) {
                    unlink('./uploads/notices/' . $notice['file']);
                }

                $uploaded_file = $this->upload_notice_file();

                if (!empty($uploaded_file)) {
                    $file_name = $uploaded_file;
                }
            }

            $data = [
                'title' => $this->input->post('title'),
                'message' => $this->input->post('message'),
                'valid_till' => $this->input->post('valid_till'),
                'status' => $this->input->post('status'),
                'file' => $file_name
            ];

            $this->notice_model->edit_notice($data, $id);

            $this->session->set_flashdata('success', 'Updated successfully');
            redirect('admin/notice');
        }

        $data['notice'] = $notice;

        $this->load->view('admin/includes/_header');
        $this->load->view('admin/notices/notice_edit', $data);
        $this->load->view('admin/includes/_footer');
    }

    // ================= DELETE =================
    public function notice_del($id)
    {
        $notice = $this->notice_model->get_notice_by_id($id);

        // delete file
        if (!empty($notice['file']) && file_exists('./uploads/notices/' . $notice['file'])) {
            unlink('./uploads/notices/' . $notice['file']);
        }

        $this->db->delete('notices', ['id' => $id]);

        $this->session->set_flashdata('success', 'Deleted successfully');
        redirect('admin/notice');
    }
}