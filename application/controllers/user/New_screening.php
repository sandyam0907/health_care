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
        $this->load->model('user/Report_model', 'report_model');


    }

    // ===========================================================================

    public function index()
    {
        // echo "PHP Date: " . date('Y-m-d H:i:s');
        // echo "Timezone: " . date_default_timezone_get();
        // exit;
        

        // get Locations 
        $data['states'] = $this->location->get_states_dropdown();
        $data['districts'] = $this->location->get_districts_dropdown();
        $data['taluks'] = $this->location->get_taluks_dropdown();

        // Get patients
        $data['patients'] = $this->db->get('patients')->result();

        // Project_is session store
        $project_id = $this->session->userdata('project_id');

        // get project by Id
        $data['project'] = $this->screening_model->get_project_by_id($project_id);

        //Project Names
        $data['projects'] = $this->screening_model->get_project_names();

        //echo $this->session->userdata('project_id');

        $this->load->view('user/includes/_header', $data);
        $this->load->view('user/new_screening', $data);
        $this->load->view('user/includes/_footer');
    }

    public function add()
    {

        $this->load->library('upload');


        $is_edit = $this->input->post('is_edit');
        $report_id = $this->input->post('report_id');

        if ($is_edit) {
            $existing = $this->report_model->get_individual_report($report_id);

            if (!$existing) {
                show_error("Invalid Report ID");
            }

            $project_id = $existing->project_id;
        } else {
            $project_id = $this->session->userdata('project_id');
        }

        // =========================
        // VALIDATION RULES
        // =========================
        if (!$project_id) {
            $this->form_validation->set_rules('project_master_id', 'Project Name', 'required|trim');
            $this->form_validation->set_rules('camp_date', 'Camp Date', 'required');
            $this->form_validation->set_rules('state_id', 'State ', 'required');
            $this->form_validation->set_rules('district_id', 'District', 'required');
            $this->form_validation->set_rules('taluk_id', 'Taluk', 'required');

        }


        //Patient
        if ($this->input->post('patient_type') == 'new') {
            $this->form_validation->set_rules('first_name', 'First Name', 'required|trim');
            $this->form_validation->set_rules('last_name', 'Last Name', 'required|trim');
            $this->form_validation->set_rules('age', 'Age', 'required|trim');
            $this->form_validation->set_rules('gender', 'Gender', 'required');
            $this->form_validation->set_rules('mobile', 'Mobile', 'required|numeric|exact_length[10]');
            $this->form_validation->set_rules('labour_id', 'Labour ID', 'required|trim');
            $this->form_validation->set_rules('labour_id_type', 'Labour Type', 'required|trim');
            $this->form_validation->set_rules('kyc_type', 'kyc Type', 'required|trim');
            $this->form_validation->set_rules('kyc_no', 'kyc Number ', 'required|trim');

        }

        //General 

        $this->form_validation->set_rules('height', 'Height', 'required|numeric');
        $this->form_validation->set_rules('weight', 'Weight', 'required|numeric');
        $this->form_validation->set_rules('bmi', 'BMI', 'required|numeric');
        $this->form_validation->set_rules('systolic_bp', 'Systolic bp', 'required');
        $this->form_validation->set_rules('diastolic_bp', 'Diastolic bp', 'required');
        $this->form_validation->set_rules('pulse', 'Pulse', 'required');
        $this->form_validation->set_rules('spo2', 'Spo2', 'required');
        $this->form_validation->set_rules('temperature', 'Temperature', 'required');

        // GP validation
        $this->form_validation->set_rules('heart_status', 'Heart Status', 'required');
        $this->form_validation->set_rules('lung_status', 'Lung Status', 'required');
        $this->form_validation->set_rules('abdomen_status', 'Abdomen Status', 'required');

        // Otology
        $this->form_validation->set_rules('otology_completed', 'Otology Completed', 'required');
        $this->form_validation->set_rules('left_ear_500', 'Left Ear 500 Hz', 'required|numeric');
        $this->form_validation->set_rules('left_ear_1k', 'Left Ear 1 KHz', 'required|numeric');
        $this->form_validation->set_rules('left_ear_2k', 'Left Ear 2 KHz', 'required|numeric');
        $this->form_validation->set_rules('left_ear_4k', 'Left Ear 4 KHz', 'required|numeric');
        $this->form_validation->set_rules('right_ear_500', 'Right Ear 500 Hz', 'required|numeric');
        $this->form_validation->set_rules('right_ear_1k', 'Right Ear 1 KHz', 'required|numeric');
        $this->form_validation->set_rules('right_ear_2k', 'Right Ear 2 KHz', 'required|numeric');
        $this->form_validation->set_rules('right_ear_4k', 'Right Ear 4 KHz', 'required|numeric');
        $this->form_validation->set_rules('external_eye_exam', 'External Eye Examination', 'required');
        $this->form_validation->set_rules('va_re', 'Visual Acuity RE', 'required');
        $this->form_validation->set_rules('va_le', 'Visual Acuity LE', 'required');

        // Lab
        $this->form_validation->set_rules('hemoglobin', 'Hemoglobin', 'required');
        $this->form_validation->set_rules('blood_sugar', 'Blood Sugar', 'required');
        $this->form_validation->set_rules('hba1c', 'hba1c', 'required');
        $this->form_validation->set_rules('urine_routine', 'Urine Routine', 'required');

        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');

        // =========================
        // VALIDATION CHECK
        // =========================

        if ($this->form_validation->run() === FALSE) {

            // remove previous success message
            $this->session->unset_userdata('success');

            $this->session->set_flashdata(
                'error',
                ' Some required fields are missing. Please review all sections and complete the form.'
            );



            // reload same page with errors
            $data['states'] = $this->location->get_states_dropdown();
            $data['districts'] = $this->location->get_districts_dropdown();
            $data['taluks'] = $this->location->get_taluks_dropdown();
            $data['patients'] = $this->db->get('patients')->result();

            $project_id = $this->session->userdata('project_id');
            $data['project'] = $this->screening_model->get_project_by_id($project_id);
            $data['projects'] = $this->screening_model->get_project_names();

            $data['open_tab'] = $project_id ? 'patient' : 'project';

            $this->load->view('user/includes/_header', $data);
            $this->load->view('user/new_screening', $data);
            $this->load->view('user/includes/_footer');

            return;
        }



        //  ===========================================================================
        // 1. PROJECT
        //  ===========================================================================

        $this->db->trans_start();
        if (!$project_id && !$is_edit) {
            // GET INPUT FROM SELECT2
            $input = $this->input->post('project_master_id');

            if (is_numeric($input)) {
                // Existing project selected
                $project_master_id = $input;
            } else {
                // New project typed

                $project_existing = $this->db
                    ->where('project_name', $input)
                    ->get('project_master')
                    ->row();

                if ($project_existing) {
                    $project_master_id = $project_existing->id;
                } else {
                    $this->db->insert('project_master', [
                        'project_name' => ucfirst($input),
                        'status' => 1,
                        'created_at' => date('Y-m-d H:i:s')
                    ]);

                    $project_master_id = $this->db->insert_id();
                }
            }


            $project_data = [
                'project_master_id' => $project_master_id,
                'state_id' => $this->input->post('state_id'),
                'district_id' => $this->input->post('district_id'),
                'taluk_id' => $this->input->post('taluk_id'),
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
            $project_data = $this->security->xss_clean($project_data);
            $project_id = $this->screening_model->add_project($project_data);

            // store in session
            $this->session->set_userdata('project_id', $project_id);
        }

        //  ===========================================================================
        // 2. PATIENT
        //  ===== ======================================================================

        // FILE UPLOAD - LABOUR
        $labour_file = '';
        if (!empty($_FILES['labour_id_file']['name'])) {
            $config['upload_path'] = './uploads/labour/';
            $config['allowed_types'] = 'jpg|jpeg|png|pdf';
            $config['file_name'] = time() . '_labour';

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

        // PATIENT LOGIC 

        $patient_type = $this->input->post('patient_type');
        $patient_id = null;

        // DETERMINE PATIENT ID

        if ($is_edit) {
            $patient_id = $existing->patient_id;
        } elseif ($patient_type === 'existing') {
            $patient_id = $this->input->post('existing_patient_id');
        } elseif ($patient_type === 'new') {
            // insert new
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

            $patient_data = $this->security->xss_clean($patient_data);
            $patient_id = $this->screening_model->add_patient($patient_data);
        }

        // COMMON UPDATE LOGIC 

        $is_updated = $this->input->post('is_patient_updated');

        if ($is_edit || $is_updated == 1) {

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

            $update_data = $this->security->xss_clean($update_data);

            $this->screening_model->update_patient($patient_id, $update_data);
        }

        if (!$patient_id) {
            show_error("Patient not created / selected");
        }

        // ===========================================================================
        // 3. SCREENING (IMPORTANT)
        // ===========================================================================

        $screening_data = [
            'project_id' => $project_id,
            'patient_id' => $patient_id,
            'screening_date' => date('Y-m-d'),
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $screening_data = $this->security->xss_clean($screening_data);
        if ($is_edit) {

            if (empty($existing->screening_id)) {
                show_error('Screening ID missing');
            }

            $screening_id = $existing->screening_id;

        } else {

            $screening_id = $this->screening_model->add_screening($screening_data);

        }

        //  ===========================================================================
        // 4. GENERAL
        // ===========================================================================
        if ($is_edit) {
            $general_data = [
                'height' => $this->input->post('height'),
                'weight' => $this->input->post('weight'),
                'bmi' => $this->input->post('bmi'),
                'hydration' => $this->input->post('hydration'),
                'fat' => $this->input->post('fat'),
                'bonemass' => $this->input->post('bonemass'),
                'muscle' => $this->input->post('muscle'),
                'vfat' => $this->input->post('vfat'),
                'systolic_bp' => $this->input->post('systolic_bp'),
                'diastolic_bp' => $this->input->post('diastolic_bp'),
                'pulse' => $this->input->post('pulse'),
                'spo2' => $this->input->post('spo2'),
                'temperature' => $this->input->post('temperature'),
                'metabolic_age' => $this->input->post('metabolic_age'),
                'basal_metabolic_age' => $this->input->post('basal_metabolic_age'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

        } else {
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
                'systolic_bp' => $this->input->post('systolic_bp'),
                'diastolic_bp' => $this->input->post('diastolic_bp'),
                'pulse' => $this->input->post('pulse'),
                'spo2' => $this->input->post('spo2'),
                'temperature' => $this->input->post('temperature'),
                'metabolic_age' => $this->input->post('metabolic_age'),
                'basal_metabolic_age' => $this->input->post('basal_metabolic_age'),
                'created_at' => date('Y-m-d H:i:s')
            ];

        }
        $general_data = $this->security->xss_clean($general_data);
        if ($is_edit) {
            $this->screening_model->update_general(
                $existing->general_check_id,
                $general_data
            );
            $general_id = $existing->general_check_id;
        } else {
            $general_id = $this->screening_model->add_general($general_data);
        }

        //  ===========================================================================
        // 5. GP
        //  ===========================================================================
        if ($is_edit) {
            $gp_data = [
                'heart_status' => $this->input->post('heart_status'),
                'lung_status' => $this->input->post('lung_status'),
                'abdomen_status' => $this->input->post('abdomen_status'),
                'fef' => $this->input->post('fef'),
                'pef' => $this->input->post('pef'),
                'fev1' => $this->input->post('fev1'),
                'fev6' => $this->input->post('fev6'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

        } else {
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

        }
        $gp_data = $this->security->xss_clean($gp_data);
        if ($is_edit) {
            $this->screening_model->update_gp(
                $existing->gp_check_id,
                $gp_data
            );
            $gp_id = $existing->gp_check_id;
        } else {
            $gp_id = $this->screening_model->add_gp($gp_data);
        }

        //  ===========================================================================
        // 6. SPECIAL
        //  ===========================================================================

        if ($is_edit) {
            $special_data = [
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
                'updated_at' => date('Y-m-d H:i:s')
            ];

        } else {
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

        }

        $special_data = $this->security->xss_clean($special_data);
        if ($is_edit) {
            $this->screening_model->update_special(
                $existing->specialty_check_id,
                $special_data
            );
            $special_id = $existing->specialty_check_id;
        } else {
            $special_id = $this->screening_model->add_special($special_data);
        }

        //  ===========================================================================
        // 7. LAB
        //  ===========================================================================
        if ($is_edit) {
            $lab_data = [
                'hemoglobin' => $this->input->post('hemoglobin'),
                'blood_sugar' => $this->input->post('blood_sugar'),
                'hba1c' => $this->input->post('hba1c'),
                'urine_routine' => $this->input->post('urine_routine'),
                'wbc_count' => $this->input->post('wbc_count'),
                'platelet_count' => $this->input->post('platelet_count'),
                'ecg' => $this->input->post('ecg'),
                'chest_x_ray' => $this->input->post('chest_x_ray'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

        } else {
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

        }

        $lab_data = $this->security->xss_clean($lab_data);
        if ($is_edit) {
            if ($existing->lab_reports_id) {
                $this->screening_model->update_lab(
                    $existing->lab_reports_id,
                    $lab_data
                );
                $lab_id = $existing->lab_reports_id;
            } else {
                $lab_id = $this->screening_model->add_lab($lab_data);
            }
        } else {
            $lab_id = $this->screening_model->add_lab($lab_data);
        }


        //  ===========================================================================
        // Generate Report ID
        //  ===========================================================================
        if (!$is_edit) {
            $report_id = $this->screening_model->generate_report_id();

            $report_data = [
                'report_id' => $report_id,
                'project_id' => $project_id,
                'patient_id' => $patient_id,
                'general_check_id' => $general_id,
                'gp_check_id' => $gp_id,
                'specialty_check_id' => $special_id,
                'lab_reports_id' => $lab_id,
                'status' => 1,
                'created_date' => date('Y-m-d'),
                'created_time' => date('H:i:s')
            ];
            // print_r($report_data);
            // exit;

            $report_data = $this->security->xss_clean($report_data);
            $this->screening_model->add_patient_report($report_data);
        }
        //  ===========================================================================
        // DONE
        //  ===========================================================================


        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            show_error('Something went wrong');
        }

        $this->session->unset_userdata('error');
        $this->session->set_flashdata('success', 'Screening saved successfully');
        if ($is_edit) {
            redirect('user/reports');
        } else {
            redirect('user/new_screening?tab=patient');
        }
    }

    public function edit($report_id)
    {
        // Get report data
        $report = $this->report_model->get_individual_report($report_id);

        if (!$report) {
            show_404();
        }

        // Load dropdowns & data same as index()
        $data['report'] = $report;
        $data['states'] = $this->location->get_states_dropdown();
        $data['districts'] = $this->location->get_districts_dropdown();
        $data['taluks'] = $this->location->get_taluks_dropdown();
        $data['patients'] = $this->db->get('patients')->result();

        // project
        $data['project'] = $this->screening_model->get_project_by_id($report->project_id);
        $data['projects'] = $this->screening_model->get_project_names();

        // IMPORTANT → open patient tab first
        $data['open_tab'] = 'patient';

        $this->load->view('user/includes/_header', $data);
        $this->load->view('user/new_screening', $data);
        $this->load->view('user/includes/_footer');
    }

    // GET Patient by Id
    public function get_patient()
    {
        $id = $this->input->post('id');

        $patient = $this->screening_model->get_patient_by_id($id);

        echo json_encode($patient);
    }

    public function finish_camp()
    {
        $this->session->unset_userdata('project_id');

        $this->session->set_flashdata('success', 'Camp finished');

        redirect('user/new_screening');
    }

}
?>