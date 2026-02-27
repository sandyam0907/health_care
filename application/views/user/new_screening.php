<style>
    .section-title {
        font-size: 14px;
        font-weight: 600;
        color: #2f7d32;
        margin-bottom: 6px;
    }

    .sub-section-title {
        font-size: 13px;
        font-weight: 600;
        color: #1e5aa7;
        margin-bottom: 10px;
    }
</style>
<!-- ===== BREADCRUMB BAR ===== -->
<div class="container-fluid">
    <nav aria-label="breadcrumb" class="mt-2">
        <ol class="breadcrumb bg-white shadow-sm mb-0" style="border-left:4px solid #1f518a;">
            <li class="breadcrumb-item">
                <a href="index.html">Dashboard</a>
            </li>

            <li class="breadcrumb-item active" aria-current="page">
                New Screening
            </li>
        </ol>
    </nav>
</div>



<!-- ===== MAIN CONTENT ===== -->
<div class="container-fluid mt-3 mb-5 newscreening">
    <div class="card shadow-sm ">
        <div class="card-body">

            <!-- FORM TABS -->
            <ul class="nav nav-tabs mb-3" id="formTabs">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#project"><i
                            class="bi bi-diagram-3"></i> Project</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#patient"><i class="bi bi-person"></i>
                        Patient</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#general"><i
                            class="bi bi-heart-pulse"></i> General</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#gp"><i class="bi bi-stethoscope"></i>
                        GP</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#special"><i class="bi bi-eye"></i>
                        Specialty</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#lab"><i class="bi bi-droplet"></i>
                        Lab</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#report"><i
                            class="bi bi-file-earmark-text"></i> Report</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#analytics"><i
                            class="bi bi-graph-up"></i> Analytics</a></li>
            </ul>

            <?php echo form_open(base_url('user/new_screening/add'), ['id' => 'healthForm', 'enctype' => 'multipart/form-data']); ?>
            <div class="tab-content">

                <!-- ---------------------------------------------------------------------------------------------------------- -->
                <!-- PROJECT -->
                <!-- ---------------------------------------------------------------------------------------------------------- -->
                <div class="tab-pane fade show active" id="project">
                    <div class="section-title">Project & Camp Information</div>
                    <p class="text-muted small">Enter official details of the health camp as per UP Health IEC
                        guidelines.</p>
                    <div class="row">

                        <div class="col-md-3 mb-3">
                            <label>Name *</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>State Name</label>
                            <select name="state_name" class="form-control select2">
                                <?php foreach ($states as $s): ?>
                                    <option value="<?= $s->name ?>">
                                        <?= $s->name ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>District Name</label>
                            <select name="district_name" class="form-control select2">
                                <?php foreach ($districts as $d): ?>
                                    <option value="<?= $d->district_name ?>">
                                        <?= $d->district_name ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>Pincode</label>
                            <input type="text" name="pincode" class="form-control">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>Taluk Name</label>
                            <select name="taluk_name" class="form-control select2">
                                <?php foreach ($taluks as $t): ?>
                                    <option value="<?= $t->taluk_name ?>">
                                        <?= $t->taluk_name ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>Program / Work Order ID</label>
                            <input type="text" name="program_work_order_id" class="form-control">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>Date</label>
                            <input type="date" name="camp_date" class="form-control">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>Location</label>
                            <input type="text" name="location" class="form-control">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>Activity Nature</label>
                            <select name="activity_nature[]" class="form-control select2" multiple>
                                <option>Generic</option>
                                <option>Health</option>
                                <option>Awareness</option>
                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>Type of Activity</label>
                            <select name="type_of_activity[]" class="form-control select2" multiple>
                                <option>Pamphlet Distribution</option>
                                <option>Street Play</option>
                                <option>Poster Campaign</option>
                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>Assign Users</label>
                            <select name="assign_users[]" class="form-control select2" multiple>
                                <?php foreach ($users as $u): ?>
                                    <option value="<?= $u['id'] ?>"><?= $u['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>


                        <div class="col-md-3 mb-3">
                            <label>Select Form</label>
                            <select name="select_form" class="form-control">
                                <option>IEC Activity Log</option>
                                <option>Patient Registration</option>
                            </select>
                        </div>

                    </div>
                    <div class="text-right mt-3">
                        <button type="button" class="btn btn-primary next-tab">Next</button>
                    </div>
                </div>

                <!-- ---------------------------------------------------------------------------------------------------------- -->
                <!-- PATIENT -->
                <!-- ---------------------------------------------------------------------------------------------------------- -->
                <div class="tab-pane fade" id="patient">
                    <div class="section-title">Patient Registration</div>
                    <p class="text-muted small">Patient identification details for report traceability.</p>

                    <div class="row mb-4">
                        <!-- RADIO BUTTONS -->
                        <div class="col-md-3">
                            <label class="me-3">
                                <input type="radio" name="patient_type" value="new" checked> New Patient
                            </label>

                            <label>
                                <input type="radio" name="patient_type" value="existing"> Existing Patient
                            </label>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div id="existing_patient_box" style="display:none;" class="col-md-3">
                            <label>Select Patient</label>
                            <select id="existing_patient" name="existing_patient_id" class="form-control">
                                <option value="">-- Select Patient --</option>
                                <?php foreach ($patients as $p): ?>
                                    <option value="<?= $p->id ?>">
                                        <?= $p->first_name ?>     <?= $p->last_name ?> - <?= $p->mobile ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <!-- GENERAL DETAILS -->
                    <h6 class="section-title">General Details</h6>
                    <hr>
                    <div id="patient_section">

                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label>First Name</label>
                                <input type="text" name="first_name" id="first_name" class="form-control"
                                    placeholder="First Name">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Last Name</label>
                                <input type="text" name="last_name" id="last_name" class="form-control"
                                    placeholder="Full name as per ID">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label>Age</label>
                                <input type="number" name="age" id="age" class="form-control" placeholder="Years">
                            </div>

                            <div class="col-md-2 mb-3">
                                <label>Gender</label>
                                <select name="gender" id="gender" class="form-control">
                                    <option value="">Select</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                    <option>Other</option>
                                </select>
                            </div>

                            <div class="col-md-2 mb-3">
                                <label>Mobile</label>
                                <input type="text" name="mobile" id="mobile" class="form-control"
                                    placeholder="10-digit mobile" maxlength="10">
                            </div>
                        </div>

                        <!-- LABOUR DETAILS -->
                        <h6 class="section-title mt-4">Labour Details</h6>
                        <hr>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label>Labour ID</label>
                                <input type="text" name="labour_id" class="form-control" placeholder="Labour Id">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Labour ID File</label>
                                <input type="file" name="labour_id_file" class="form-control">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Labour ID Type</label>
                                <select name="labour_id_type" class="form-control">
                                    <option value="">Select</option>
                                    <option value="Labour">Labour</option>
                                    <option value="Dependant">Dependant</option>
                                </select>
                            </div>
                        </div>

                        <!-- KYC DETAILS -->
                        <h6 class="section-title mt-4">KYC Details</h6>
                        <hr>

                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label>KYC Type</label>
                                <select name="kyc_type" class="form-control">
                                    <option value="">Select</option>
                                    <option value="Aadhaar">Aadhaar</option>
                                    <option value="Voter ID">Voter ID</option>
                                    <option value="PAN">PAN</option>
                                </select>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>ID No</label>
                                <input type="text" name="kyc_no" class="form-control" placeholder="ID No">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>KYC File</label>
                                <input type="file" name="kyc_file" class="form-control">
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <button type="button" class="btn btn-outline-secondary prev-tab">Back</button>
                            <button type="button" class="btn btn-primary next-tab">Next</button>
                        </div>
                    </div>
                </div>

                <!-- ---------------------------------------------------------------------------------------------------------- -->
                <!-- GENERAL -->
                <!-- ---------------------------------------------------------------------------------------------------------- -->
                <div class="tab-pane fade" id="general">
                    <h6 class="section-title">General Health Check</h6>
                    <hr>
                    <p class="text-muted small">Vitals recorded by nursing / paramedical staff.</p>

                    <!-- BODY MEASUREMENTS -->
                    <h6 class="section-title">Body Measurements</h6>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label>Height</label>
                            <input type="text" name="height" class="form-control" placeholder="in cm">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Weight</label>
                            <input type="text" name="weight" class="form-control" placeholder="in kgs">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>BMI</label>
                            <input type="text" name="bmi" class="form-control" placeholder="BMI">
                        </div>
                    </div>

                    <!-- BODY COMPOSITION -->
                    <h6 class="section-title mt-4">Body Composition</h6>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label>Hydration (%)</label>
                            <input type="text" name="hydration" class="form-control" placeholder="Hydration (%)">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>Fat (%)</label>
                            <input type="text" name="fat" class="form-control" placeholder="Fat (%)">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>Bonemass (%)</label>
                            <input type="text" name="bonemass" class="form-control" placeholder="Bonemass (%)">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>Muscle (%)</label>
                            <input type="text" name="muscle" class="form-control" placeholder="Muscle (%)">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label>V fat (%)</label>
                            <input type="text" name="vfat" class="form-control" placeholder="V fat (%)">
                        </div>
                    </div>

                    <!-- VITAL SIGNS -->
                    <h6 class="section-title mt-4">Vital Signs</h6>

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label>Systolic Blood Pressure (mm Hg)</label>
                            <input type="text" name="systolic_bp" class="form-control" placeholder="mm Hg">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>Diastolic Blood Pressure (mm Hg)</label>
                            <input type="text" name="diastolic_bp" class="form-control" placeholder="mm Hg">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>Pulse (bpm)</label>
                            <input type="text" name="pulse" class="form-control" placeholder="bpm">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>SpO2 (%)</label>
                            <input type="text" name="spo2" class="form-control" placeholder="SpO2 (%)">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label>Temperature (°C)</label>
                            <input type="text" name="temperature" class="form-control" placeholder="°C">
                        </div>
                    </div>

                    <!-- METABOLIC AGE -->
                    <h6 class="section-title mt-4">Metabolic Indicators</h6>

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label>Metabolic Age</label>
                            <input type="text" name="metabolic_age" class="form-control" placeholder="Metabolic Age">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>Basal Metabolic Age</label>
                            <input type="text" name="basal_metabolic_age" class="form-control"
                                placeholder="Basal Metabolic Age">
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <button type="button" class="btn btn-outline-secondary prev-tab">Back</button>
                        <button type="button" class="btn btn-primary next-tab">Next</button>
                    </div>
                </div>

                <!-- ---------------------------------------------------------------------------------------------------------- -->
                <!-- GP -->
                <!-- ---------------------------------------------------------------------------------------------------------- -->
                <div class="tab-pane fade" id="gp">
                    <div class="section-title">GP Screening</div>
                    <p class="text-muted small">Doctor observations using stethoscope & spirometry.</p>

                    <!-- GP LED - STETHOSCOPE SCREENING -->
                    <h6 class="section-title">General Practitioner Led – Stethoscope Screening</h6>
                    <hr>

                    <div class="row">
                        <!-- HEART -->
                        <div class="col-md-4">
                            <h6 class="sub-section-title">Heart</h6>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="heart_status" value="normal">
                                <label class="form-check-label">Normal – S1 S2 heard</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="heart_status" value="murmurs">
                                <label class="form-check-label">Abnormal – Murmurs</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="heart_status" value="rasping">
                                <label class="form-check-label">Abnormal – Rasping</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="heart_status" value="blowing_sand">
                                <label class="form-check-label">Abnormal – Blowing Sound</label>
                            </div>
                        </div>

                        <!-- LUNG -->
                        <div class="col-md-4">
                            <h6 class="sub-section-title">Lung</h6>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="lung_status" value="normal">
                                <label class="form-check-label">Normal – B/L NVBS</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="lung_status" value="rhonchi">
                                <label class="form-check-label">Abnormal – Rhonchi low pitched</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="lung_status" value="creales">
                                <label class="form-check-label">Abnormal – Creales (high pitched whistling)</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="lung_status" value="strides">
                                <label class="form-check-label">Abnormal – Strides (breath vibrator sound)</label>
                            </div>
                        </div>

                        <!-- ABDOMEN -->
                        <div class="col-md-4">
                            <h6 class="sub-section-title">Abdomen</h6>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="abdomen_status" value="normal">
                                <label class="form-check-label">Normal – P/A soft BS non tender</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="abdomen_status" value="splenomegaly">
                                <label class="form-check-label">Abnormal – Splenomegaly</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="abdomen_status" value="hepatomegaly">
                                <label class="form-check-label">Abnormal – Hepatomegaly</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="abdomen_status"
                                    value="urinary_retention">
                                <label class="form-check-label">Abnormal – Urinary Retention</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="abdomen_status" value="distention">
                                <label class="form-check-label">Abnormal – Distention</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="abdomen_status"
                                    value="decreased_bowel">
                                <label class="form-check-label">Abnormal – Decreased Bowel Sounds</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="abdomen_status"
                                    value="abdominal_mass">
                                <label class="form-check-label">Abnormal – Abdominal Mass</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="abdomen_status"
                                    value="umbilical_hernia">
                                <label class="form-check-label">Abnormal – Umbilical Hernia</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="abdomen_status"
                                    value="inguinal_hernia">
                                <label class="form-check-label">Abnormal – Inguinal Hernia</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="abdomen_status" value="rigidity">
                                <label class="form-check-label">Abnormal – Rigidity</label>
                            </div>
                        </div>

                    </div>

                    <!-- GP LED - SPIROMETRY SCREENING -->
                    <h6 class="section-title">General Practitioner Led – Spirometry Screening</h6>
                    <hr>

                    <div class="row mb-3 align-items-center">
                        <div class="col-md-2">
                            <label>FEF</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="fef" class="form-control" placeholder="FEF value">
                        </div>
                    </div>

                    <div class="row mb-3 align-items-center">
                        <div class="col-md-2">
                            <label>PEF</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="pef" class="form-control" placeholder="PEF value">
                        </div>
                    </div>

                    <div class="row mb-3 align-items-center">
                        <div class="col-md-2">
                            <label>FEV1</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="fev1" class="form-control" placeholder="FEV1 value">
                        </div>
                    </div>

                    <div class="row mb-3 align-items-center">
                        <div class="col-md-2">
                            <label>FEV6</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="fev6" class="form-control" placeholder="FEV6 value">
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <button type="button" class="btn btn-outline-secondary prev-tab">Back</button>
                        <button type="button" class="btn btn-primary next-tab">Next</button>
                    </div>
                </div>

                <!-- ---------------------------------------------------------------------------------------------------------- -->
                <!-- SPECIAL -->
                <!-- ---------------------------------------------------------------------------------------------------------- -->
                <div class="tab-pane fade" id="special">
                    <div class="section-title">Specialty Screening</div>
                    <p class="text-muted small">Results from Audiometry & Ophthalmology screening.</p>
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="section-title">Audiometry Screening</h6>
                            <hr>

                            <!-- OTOLOGY COMPLETED -->
                            <div class="mb-3">
                                <label class="form-label">Is Otology Completed?</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="otology_completed" value="yes">
                                    <label class="form-check-label">Yes</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="otology_completed" value="no">
                                    <label class="form-check-label">No</label>
                                </div>
                            </div>

                            <!-- PROVISIONAL DIAGNOSIS -->
                            <div class="mb-3">
                                <label class="form-label">Provisional Diagnosis</label>
                                <textarea name="provisional_diagnosis" class="form-control" rows="2"
                                    placeholder="Provisional Diagnosis"></textarea>
                            </div>

                            <!-- HEARING LEVELS -->
                            <h6 class="sub-section-title mt-4">Hearing Levels</h6>
                            <div class="row">
                                <!-- LEFT EAR -->
                                <div class="col-md-6">
                                    <h6 class="sub-section-title mt-3">Left Ear</h6>
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label>Left Freq 500 Hz *</label>
                                            <input type="text" name="left_ear_500" class="form-control"
                                                placeholder="0 to 120 db">
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label>Left Freq 1 KHz *</label>
                                            <input type="text" name="left_ear_1k" class="form-control"
                                                placeholder="0 to 120 db">
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label>Left Freq 2 KHz *</label>
                                            <input type="text" name="left_ear_2k" class="form-control"
                                                placeholder="0 to 120 db">
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label>Left Freq 4 KHz *</label>
                                            <input type="text" name="left_ear_4k" class="form-control"
                                                placeholder="0 to 120 db">
                                        </div>
                                    </div>
                                </div>

                                <!-- RIGHT EAR -->
                                <div class="col-md-6">
                                    <h6 class="sub-section-title mt-3">Right Ear</h6>
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label>Right Freq 500 Hz *</label>
                                            <input type="text" name="right_ear_500" class="form-control"
                                                placeholder="0 to 120 db">
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label>Right Freq 1 KHz *</label>
                                            <input type="text" name="right_ear_1k" class="form-control"
                                                placeholder="0 to 120 db">
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label>Right Freq 2 KHz *</label>
                                            <input type="text" name="right_ear_2k" class="form-control"
                                                placeholder="0 to 120 db">
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label>Right Freq 4 KHz *</label>
                                            <input type="text" name="right_ear_4k" class="form-control"
                                                placeholder="0 to 120 db">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6 class="section-title">Ophthalmology Screening</h6>
                            <hr>

                            <!-- HISTORY -->
                            <div class="mb-3">
                                <label class="form-label">History</label>
                                <textarea name="history" class="form-control" rows="2"></textarea>
                            </div>

                            <!-- SYMPTOMS -->
                            <div class="mb-3">
                                <label class="form-label">Symptoms</label>
                                <select name="symptoms" class="form-control">
                                    <option value="NA">NA</option>
                                    <option value="blurred_vision">Blurred Vision</option>
                                    <option value="eye_pain">Eye Pain</option>
                                    <option value="watering">Watering</option>
                                    <option value="redness">Redness</option>
                                </select>
                            </div>

                            <!-- OCCULAR FINDINGS -->
                            <div class="mb-3">
                                <label class="form-label">Occular Findings</label>
                                <select name="ocular_findings" class="form-control">
                                    <option value="normal">Normal</option>
                                    <option value="conjunctivitis">Conjunctivitis</option>
                                    <option value="cataract">Cataract</option>
                                    <option value="pterygium">Pterygium</option>
                                </select>
                            </div>

                            <!-- EXTERNAL EYE EXAMINATION -->
                            <div class="mb-3">
                                <label class="form-label">External Eye Examination</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="external_eye_exam"
                                        value="abnormal">
                                    <label class="form-check-label">Abnormal</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="external_eye_exam" value="normal"
                                        checked>
                                    <label class="form-check-label">Normal</label>
                                </div>
                            </div>

                            <!-- REFRACTION -->
                            <div class="mb-3">
                                <label class="form-label">Refraction</label>
                                <select name="refraction" class="form-control">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </div>

                            <!-- VISUAL ACUITY -->
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Visual Acuity - RE</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="va_re" value="6/6">
                                        6/6<br>
                                        <input class="form-check-input" type="radio" name="va_re" value="6/9">
                                        6/9<br>
                                        <input class="form-check-input" type="radio" name="va_re" value="6/12">
                                        6/12<br>
                                        <input class="form-check-input" type="radio" name="va_re" value="6/18">
                                        6/18<br>
                                        <input class="form-check-input" type="radio" name="va_re" value="6/24">
                                        6/24<br>
                                        <input class="form-check-input" type="radio" name="va_re" value="6/36">
                                        6/36<br>
                                        <input class="form-check-input" type="radio" name="va_re" value="6/60"> 6/60
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Visual Acuity - LE</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="va_le" value="6/6">
                                        6/6<br>
                                        <input class="form-check-input" type="radio" name="va_le" value="6/9">
                                        6/9<br>
                                        <input class="form-check-input" type="radio" name="va_le" value="6/12">
                                        6/12<br>
                                        <input class="form-check-input" type="radio" name="va_le" value="6/18">
                                        6/18<br>
                                        <input class="form-check-input" type="radio" name="va_le" value="6/24">
                                        6/24<br>
                                        <input class="form-check-input" type="radio" name="va_le" value="6/36">
                                        6/36<br>
                                        <input class="form-check-input" type="radio" name="va_le" value="6/60"> 6/60
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-3">
                        <button type="button" class="btn btn-outline-secondary prev-tab">Back</button>
                        <button type="button" class="btn btn-primary next-tab">Next</button>
                    </div>
                </div>

                <!-- ---------------------------------------------------------------------------------------------------------- -->
                <!-- LAB -->
                <!-- ---------------------------------------------------------------------------------------------------------- -->
                <div class="tab-pane fade" id="lab">
                    <div class="section-title">
                        Laboratory Investigations
                        <span class="badge badge-warning ml-2">Mandatory</span>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label>Hemoglobin</label>
                            <input name="hemoglobin" class="form-control" placeholder="g/dL">
                        </div>
                        <div class="col-md-3">
                            <label>Blood Sugar (Random)</label>
                            <input name="blood_sugar" class="form-control" placeholder="mg/dL">
                        </div>
                        <div class="col-md-3">
                            <label>HbA1c</label>
                            <input name="hba1c" class="form-control" placeholder="%">
                        </div>
                        <div class="col-md-3">
                            <label>Urine Routine</label>
                            <select name="urine_routine" class="form-control">
                                <option value="normal">Normal</option>
                                <option value="abnormal">Abnormal</option>
                            </select>
                        </div>
                    </div>

                    <div class="section-title">Haematology Investigation</div>
                    <p class="text-muted small">Lab values as per collected samples.</p>
                    <div class="row">
                        <div class="row mt-3">
                            <div class="col-md-3">
                                <label>WBC Count</label>
                                <input name="wbc_count" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label>Platelet Count</label>
                                <input name="platelet_count" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label>ECG</label>
                                <select name="ecg" class="form-control">
                                    <option value="not_done">Not Done</option>
                                    <option value="normal">Normal</option>
                                    <option value="abnormal">Abnormal</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Chest X-Ray</label>
                                <select name="chest_x_ray" class="form-control">
                                    <option value="not_required">Not Required</option>
                                    <option value="normal">Normal</option>
                                    <option value="abnormal">Abnormal</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <button type="button" class="btn btn-outline-secondary prev-tab">Back</button>
                        <button type="button" class="btn btn-primary next-tab">Next</button>
                    </div>
                </div>

                <!-- ---------------------------------------------------------------------------------------------------------- -->
                <!-- REPORT -->
                <!-- ---------------------------------------------------------------------------------------------------------- -->
                <div class="tab-pane fade" id="report">
                    <div class="section-title">Consolidated Medical Opinion</div>
                    <p class="text-muted small">Final diagnosis, advice & referral if required.</p>

                    <textarea class="form-control" rows="6" name="doctor_report"
                        placeholder="Doctor's consolidated opinion and recommendations..."></textarea>

                    <div class="d-flex justify-content-between mt-3">
                        <button type="button" class="btn btn-outline-secondary prev-tab">Back</button>
                        <button type="button" class="btn btn-primary next-tab">Next</button>
                    </div>
                </div>

                <!-- ---------------------------------------------------------------------------------------------------------- -->
                <!-- ANALYTICS / SUBMIT -->
                <!-- ---------------------------------------------------------------------------------------------------------- -->
                <div class="tab-pane fade" id="analytics">
                    <div class="section-title text-success">All Sections Completed</div>
                    <p class="text-muted">You may now submit and generate the Health Report PDF.</p>

                    <div class="alert alert-warning small">
                        ⚠️ Some mandatory medical investigations may be pending.
                        Please review before final submission.
                    </div>

                    <ul>
                        <li>✔ Patient data verified</li>
                        <li>✔ Clinical screening completed</li>
                        <li>✔ Lab values recorded</li>
                    </ul>

                    <div class="text-right mt-4">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <a href="report.html" class="btn btn-success btn-lg"><i class="bi bi-file-earmark-pdf"></i>
                            Generate PDF
                        </a>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $('.select2').select2();
</script>
<script>
    $('input[name="patient_type"]').on('change', function () {

        if ($(this).val() === 'existing') {

            $('#existing_patient_box').show();
            $('#patient_section input').prop('readonly', false);
            $('#patient_section select').prop('disabled', false);

        } else {
            $('#existing_patient_box').hide();
            $('#patient_section input').prop('readonly', false);
            $('#patient_section select').prop('disabled', false);
            $('#patient_section').find('input[type="text"], input[type="number"], select').val('');
        }
    });

    $('#existing_patient').on('change', function () {

        let id = $(this).val();
        console.log("Selected ID:", id);
        if (!id) return;

        let csrfName = $('input[name="<?= $this->security->get_csrf_token_name(); ?>"]').attr('name');
        let csrfHash = $('input[name="<?= $this->security->get_csrf_token_name(); ?>"]').val();

        $.ajax({
            url: "<?= base_url('user/new_screening/get_patient') ?>",
            type: "POST",
            data: {
                id: id,
                [csrfName]: csrfHash 
            },
            dataType: "json",
            success: function (res) {

    console.log("Response:", res);

    // BASIC
    $('#first_name').val(res.first_name);
    $('#last_name').val(res.last_name);
    $('#age').val(res.age);
    $('#gender').val(res.gender);
    $('#mobile').val(res.mobile);

    // LABOUR
    $('input[name="labour_id"]').val(res.labour_id);
    $('select[name="labour_id_type"]').val(res.labour_id_type);

    // KYC
    $('select[name="kyc_type"]').val(res.kyc_type);
    $('input[name="kyc_no"]').val(res.kyc_no);

}
        });
    });
</script>