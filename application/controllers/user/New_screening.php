<?php defined('BASEPATH') OR exit('No direct script access allowed');


class New_screening extends My_Controller
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

    // ✅ FROM DB
    $data['states'] = $this->location->get_states_dropdown();
    $data['districts'] = $this->location->get_districts_dropdown();
    $data['taluks'] = $this->location->get_taluks_dropdown();

    $data['patients'] = $this->db->get('patients')->result();

    $data['users'] = [
        ['id' => 1, 'name' => 'Doctor A'],
        ['id' => 2, 'name' => 'Nurse B'],
        ['id' => 3, 'name' => 'Field Staff C'],
    ];

    $this->load->view('user/includes/_header', $data);
    $this->load->view('user/new_screening', $data);
    $this->load->view('user/includes/_footer');
}

    public function add()
    {
         $this->load->library('upload');
        //  ===========================================================================
        // 1. PROJECT
        //  ===========================================================================
        $project_data = [
            'project_name' => $this->input->post('name'),
            'state_name' => $this->input->post('state_name'),
            'district_name' => $this->input->post('district_name'),
            'taluk_name' => $this->input->post('taluk_name'),
            'pincode' => $this->input->post('pincode'),
            'work_order_id' => $this->input->post('program_work_order_id'),
            'camp_date' => $this->input->post('camp_date'),
            'location' => $this->input->post('location'),
            'activity_nature_id' => implode(',', (array) $this->input->post('activity_nature')),
            'activity_type_id' => implode(',', (array) $this->input->post('type_of_activity')),
            'user_id' => implode(',', (array) $this->input->post('assign_users')),
            'form_id' => $this->input->post('select_form'),
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $project_id = $this->screening_model->insert_project($project_data);

        if (!$project_id) {
            print_r($this->db->error());
            exit;
        }

        //  ===========================================================================
        // 2. PATIENT
        //  ===========================================================================
        $patient_type = $this->input->post('patient_type');
        // FILE UPLOAD - LABOUR
        $labour_file = '';
        if (!empty($_FILES['labour_id_file']['name'])) {
            $config['upload_path'] = './uploads/labour/';
            $config['allowed_types'] = 'jpg|jpeg|png|pdf';
            $config['file_name'] = time() . '_labour';

            $this->load->library('upload');
            $this->upload->initialize($config);

            if ($this->upload->do_upload('labour_id_file')) {
                $labour_file = $this->upload->data('file_name');
            }
        }

        // FILE UPLOAD - KYC
        $kyc_file = '';
        if (!empty($_FILES['kyc_file']['name'])) {
            $config['upload_path'] = './uploads/kyc/';
            $config['allowed_types'] = 'jpg|jpeg|png|pdf';
            $config['file_name'] = time() . '_kyc';

            $this->upload->initialize($config);

            if ($this->upload->do_upload('kyc_file')) {
                $kyc_file = $this->upload->data('file_name');
            }
        }

        // ================= EXISTING =================
        if ($patient_type == 'existing') {

            $patient_id = $this->input->post('existing_patient_id');
            $update_data = [
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'age' => $this->input->post('age'),
                'gender' => $this->input->post('gender'),
                'mobile' => $this->input->post('mobile'),
                'labour_id' => $this->input->post('labour_id'),
                'labour_id_type' => $this->input->post('labour_id_type'),
                'kyc_type' => $this->input->post('kyc_type'),
                'kyc_no' => $this->input->post('kyc_no'),
            ];

            if ($labour_file) {
                $update_data['labour_id_file'] = $labour_file;
            }

            if ($kyc_file) {
                $update_data['kyc_file'] = $kyc_file;
            }

            $this->screening_model->update_patient($patient_id, $update_data);
        }


        // ================= NEW =================
        else {

            // your existing insert code
            $patient_data = [
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'age' => $this->input->post('age'),
                'gender' => $this->input->post('gender'),
                'mobile' => $this->input->post('mobile'),
                'labour_id' => $this->input->post('labour_id'),
                'labour_id_type' => $this->input->post('labour_id_type'),
                'labour_id_file' => $labour_file,
                'kyc_type' => $this->input->post('kyc_type'),
                'kyc_no' => $this->input->post('kyc_no'),
                'kyc_file' => $kyc_file,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $patient_id = $this->screening_model->insert_patient($patient_data);
        }

        // ===========================================================================
        // 3. SCREENING (IMPORTANT)
        // ===========================================================================
        $screening_data = [
            'project_id' => $project_id,
            'patient_id' => $patient_id,
            'screening_date' => date('Y-m-d'),
            'doctor_report' => $this->input->post('doctor_report'),
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->db->insert('screenings', $screening_data);
        $screening_id = $this->db->insert_id();

        //  ===========================================================================
        // 4. GENERAL
        // ===========================================================================
        $general_data = [
            'screening_id' => $screening_id,
            'project_id' => $project_id,
            'patient_id' => $patient_id,
            'height' => $this->input->post('height'),
            'weight' => $this->input->post('weight'),
            'bmi' => $this->input->post('bmi'),
            'hydration' => $this->input->post('hydration'),
            'fat' => $this->input->post('fat'),
            'bonemass' => $this->input->post('bonemass'),
            'muscle' => $this->input->post('muscle'),
            'vfat' => $this->input->post('vfat'),
            'systolic_bp' =>$this->input->post('systolic_bp'),
            'diastolic_bp' =>$this->input->post('diastolic_bp'),
            'pulse' =>$this->input->post('pulse'),
            'spo2' =>$this->input->post('spo2'),
            'temperature' => $this->input->post('temperature'),
            'metabolic_age' => $this->input->post('metabolic_age'),
            'basal_metabolic_age' => $this->input->post('basal_metabolic_age'),
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->screening_model->insert_general($general_data);

        //  ===========================================================================
        // 5. GP
        //  ===========================================================================
        $gp_data = [
            'screening_id' => $screening_id,
            'project_id' => $project_id,
            'patient_id' => $patient_id,
            'heart_status' => $this->input->post('heart_status'),
            'lung_status' => $this->input->post('lung_status'),
            'abdomen_status' => $this->input->post('abdomen_status'),
            'fef' => $this->input->post('fef'),
            'pef' => $this->input->post('pef'),
            'fev1' => $this->input->post('fev1'),
            'fev6' => $this->input->post('fev6'),
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->screening_model->insert_gp($gp_data);

        //  ===========================================================================
        // 6. SPECIAL
        //  ===========================================================================
        $special_data = [
            'screening_id' => $screening_id,
            'project_id' => $project_id,
            'patient_id' => $patient_id,
            'otology_completed' => $this->input->post('otology_completed'),
            'provisional_diagnosis' => $this->input->post('provisional_diagnosis'),
            'left_ear_500' => $this->input->post('left_ear_500'),
            'left_ear_1k' => $this->input->post('left_ear_1k'),
            'left_ear_2k' => $this->input->post('left_ear_2k'),
            'left_ear_4k' => $this->input->post('left_ear_4k'),
            'right_ear_500' => $this->input->post('right_ear_500'),
            'right_ear_1k' => $this->input->post('right_ear_1k'),
            'right_ear_2k' => $this->input->post('right_ear_2k'),
            'right_ear_4k' => $this->input->post('right_ear_4k'),
            'history' => $this->input->post('history'),
            'symptoms' => $this->input->post('symptoms'),
            'ocular_findings' => $this->input->post('ocular_findings'),
            'external_eye_exam' => $this->input->post('external_eye_exam'),
            'refraction' => $this->input->post('refraction'),
            'va_re' => $this->input->post('va_re'),
            'va_le' => $this->input->post('va_le'),
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->screening_model->insert_special($special_data);

        //  ===========================================================================
        // 7. LAB
        //  ===========================================================================
        $lab_data = [
            'screening_id' => $screening_id,
            'project_id' => $project_id,
            'patient_id' => $patient_id,
            'hemoglobin' => $this->input->post('hemoglobin'),
            'blood_sugar' => $this->input->post('blood_sugar'),
            'hba1c' => $this->input->post('hba1c'),
            'urine_routine' => $this->input->post('urine_routine'),
            'wbc_count' => $this->input->post('wbc_count'),
            'platelet_count' => $this->input->post('platelet_count'),
            'ecg' => $this->input->post('ecg'),
            'chest_x_ray' => $this->input->post('chest_x_ray'),
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->screening_model->insert_lab($lab_data);

        //  ===========================================================================
        // DONE
        //  ===========================================================================
        $this->session->set_flashdata('success', 'Screening saved successfully');
        redirect('user/new_screening');
    }

    // GET Patient by Id
    public function get_patient()
    {
        $id = $this->input->post('id');

        $patient = $this->screening_model->get_patient_by_id($id);

        echo json_encode($patient);
    }

}
?>