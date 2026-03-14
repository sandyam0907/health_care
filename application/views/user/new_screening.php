<style>
    @media (max-width:768px) {

        .form-control {
            font-size: 14px;
        }

        .card-body {
            padding: 15px;
        }

        .btn {
            padding: 10px;
            font-size: 15px;
        }

        .prev-tab,
        .next-tab,
        #updateBtn {
            width: 100%;
        }
    }

    .gap-2 {
        gap: 10px;
    }

    .select2-container {
        width: 100% !important;
    }

    .select2-container .select2-selection--single {
        height: 38px;
        padding: 4px;
    }

    .select2-container .select2-selection--multiple {
        min-height: 38px;
    }

    #formTabs {
        overflow-x: auto;
        white-space: nowrap;
    }

    #formTabs .nav-item {
        flex-shrink: 0;
    }

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

    .report-section p {
        margin-bottom: 6px;
        font-size: 15px;
    }

    .is-invalid,
    .is-invalid-container {
        border: 1px solid #dc3545 !important;
    }

    .select2-container .select2-selection.is-invalid {
        border: 1px solid #dc3545 !important;
    }

    .temp-error {
        color: #dc3545 !important;
        display: block !important;
        margin-bottom: 5px;
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
    <?php $this->load->view('user/includes/_messages.php'); ?>
    <div class="card shadow-sm ">
        <div class="card-body">

            <!-- Current Camp Info -->
            <?php if (!empty($project)): ?>
                <div class="alert alert-info py-2 px-3 mb-3 d-flex justify-content-between align-items-center shadow-sm"
                    style="border-left: 5px solid #1f518a;">
                    <div>
                        <i class="bi bi-info-circle-fill mr-2"></i>
                        Active Camp: <strong><?= $project->project_name ?></strong>
                        <span class="mx-2">|</span>
                        Date: <strong><?= date('d-M-Y', strtotime($project->camp_date)) ?></strong>
                    </div>
                    <span class="badge badge-primary">In Progress</span>
                </div>
            <?php endif; ?>

            <!-- FORM TABS -->
            <ul class="nav nav-tabs flex-nowrap overflow-auto mb-3" id="formTabs">
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
            <input type="hidden" name="is_patient_updated" id="is_patient_updated" value="0">
            <div class="tab-content">

                <!-- ---------------------------------------------------------------------------------------------------------- -->
                <!-- PROJECT -->
                <!-- ---------------------------------------------------------------------------------------------------------- -->
                <div class="tab-pane fade show active" id="project">
                    <div class="section-title">Project & Camp Information</div>
                    <p class="text-muted small">Enter official details of the health camp as per UP Health IEC
                        guidelines.</p>
                    <div class="row">

                        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                            <label>Name <span class="text-danger">*</span> </label>
                            <select name="name" class="form-control select2-tags" required>
                                <option value="">Select or type project</option>

                                <?php foreach ($projects as $p): ?>
                                    <option value="<?= $p->project_name ?>" <?= set_select('name', $p->project_name); ?>>
                                        <?= $p->project_name ?>
                                    </option>
                                <?php endforeach; ?>

                            </select>
                            <?= form_error('name'); ?>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                            <label>State Name <span class="text-danger">*</span></label>
                            <select name="state_id" class="form-control select2" required>
                                <option value="">Select State</option>
                                <?php foreach ($states as $s): ?>
                                    <option value="<?= $s->id ?>" <?= set_select('state_id', $s->id); ?>>
                                        <?= $s->name ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('state_id'); ?>

                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                            <label>District Name <span class="text-danger">*</span></label>
                            <select name="district_id" class="form-control select2" required>
                                <option value="">Select District</option>
                                <?php foreach ($districts as $d): ?>
                                    <option value="<?= $d->id ?>" <?= set_select('district_id', $d->id); ?>>
                                        <?= $d->district_name ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('district_id'); ?>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                            <label>Pincode</label>
                            <input type="text" name="pincode" value="<?= set_value('pincode'); ?>" class="form-control">
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                            <label>Taluk Name <span class="text-danger">*</span></label>
                            <select name="taluk_id" class="form-control select2" required>
                                <option value="">Select Taluk</option>
                                <?php foreach ($taluks as $t): ?>
                                    <option value="<?= $t->id ?>" <?= set_select('taluk_id', $t->id); ?>>
                                        <?= $t->taluk_name ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('taluk_id'); ?>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                            <label>Program / Work Order ID</label>
                            <input type="text" name="program_work_order_id"
                                value="<?= set_value('program_work_order_id'); ?>" class="form-control">
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                            <label>Date <span class="text-danger">*</span></label>
                            <input type="date" name="camp_date" value="<?= set_value('camp_date'); ?>"
                                class="form-control" required>
                            <?= form_error('camp_date'); ?>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                            <label>Location</label>
                            <input type="text" name="location" value="<?= set_value('location'); ?>"
                                class="form-control">
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                            <label>Activity Nature</label>
                            <select name="activity_nature[]" class="form-control select2" multiple>
                                <option value="Generic" <?= set_select('activity_nature[]', 'Generic'); ?>>Generic
                                </option>
                                <option value="Health" <?= set_select('activity_nature[]', 'Health'); ?>>Health</option>
                                <option value="Awareness" <?= set_select('activity_nature[]', 'Awareness'); ?>>Awareness
                                </option>
                            </select>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                            <label>Type of Activity</label>
                            <select name="type_of_activity[]" class="form-control select2" multiple>
                                <option value="Pamphlet Distribution" <?= set_select('type_of_activity[]', 'Pamphlet Distribution'); ?>>
                                    Pamphlet Distribution</option>
                                <option value="Street Play" <?= set_select('type_of_activity[]', 'Street Play'); ?>>
                                    Street Play</option>
                                <option value="Poster Campaign" <?= set_select('type_of_activity[]', 'Poster Campaign'); ?>>
                                    Poster Campaign</option>
                            </select>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                            <label>Select Form</label>
                            <select name="select_form" class="form-control">
                                <option value="IEC Activity Log" <?= set_select('select_form', 'IEC Activity Log'); ?>>
                                    IEC Activity Log
                                </option>
                                <option value="Patient Registration" <?= set_select('select_form', 'Patient Registration'); ?>>
                                    Patient Registration
                                </option>
                            </select>
                        </div>

                    </div>
                    <div class="text-right mt-3">
                        <button type="button" class="btn btn-primary next-tab" data-next="#patient">Next</button>
                    </div>
                </div>

                <!-- ---------------------------------------------------------------------------------------------------------- -->
                <!-- PATIENT -->
                <!-- ---------------------------------------------------------------------------------------------------------- -->
                <div class="tab-pane fade" id="patient">
                    <div class="section-title">Patient Registration</div>
                    <p class="text-muted small">Patient identification details for report traceability.</p>
                    <div class="row align-items-end mb-4">
                        <div class="col-md-3">
                            <label class="d-block mb-2"><strong>Patient Type</strong></label>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="patient_type" value="new"
                                    <?= set_radio('patient_type', 'new', TRUE); ?>>
                                <label class="form-check-label">New Patient</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="patient_type" value="existing"
                                    <?= set_radio('patient_type', 'existing'); ?>>
                                <label class="form-check-label">Existing Patient</label>
                            </div>
                        </div>
                        <div id="existing_patient_box" style="display:none;" class="col-md-3">
                            <label>Select Patient</label>
                            <select id="existing_patient" name="existing_patient_id" class="form-control">
                                <option value="">-- Select Patient --</option>
                                <?php foreach ($patients as $p): ?>
                                    <option value="<?= $p->id ?>" <?= set_select('existing_patient_id', $p->id); ?>>
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
                            <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                                <label>First Name <span class="text-danger">*</span></label>
                                <input type="text" name="first_name" id="first_name"
                                    value="<?= set_value('first_name'); ?>" class="form-control" required
                                    placeholder="First Name">
                                <?= form_error('first_name'); ?>
                            </div>

                            <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                                <label>Last Name <span class="text-danger">*</span></label>
                                <input type="text" name="last_name" id="last_name"
                                    value="<?= set_value('last_name'); ?>" class="form-control " required
                                    placeholder="Full name as per ID">
                                <?= form_error('last_name'); ?>
                            </div>

                            <div class="col-md-2 mb-3">
                                <label>Age<span class="text-danger">*</span></label>
                                <input type="number" name="age" id="age" value="<?= set_value('age'); ?>"
                                    class="form-control" placeholder="Years" required>
                                <?= form_error('age'); ?>
                            </div>

                            <div class="col-md-2 mb-3">
                                <label>Gender <span class="text-danger">*</span></label>
                                <select name="gender" id="gender" class="form-control" required>
                                    <option value="">Select</option>
                                    <option value="Male" <?= set_select('gender', 'Male'); ?>>Male</option>
                                    <option value="Female" <?= set_select('gender', 'Female'); ?>>Female</option>
                                    <option value="Other" <?= set_select('gender', 'Other'); ?>>Other</option>
                                </select>
                                <?= form_error('gender'); ?>
                            </div>

                            <div class="col-md-2 mb-3">
                                <label>Mobile <span class="text-danger">*</span></label>
                                <input type="text" name="mobile" id="mobile" value="<?= set_value('mobile'); ?>"
                                    class="form-control" required placeholder="10-digit mobile" maxlength="10">
                                <?= form_error('mobile'); ?>
                            </div>
                        </div>

                        <!-- LABOUR DETAILS -->
                        <h6 class="section-title mt-4">Labour Details</h6>
                        <hr>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                                <label>Labour ID <span class="text-danger">*</span></label>
                                <input type="text" name="labour_id" id="labour_id"
                                    value="<?= set_value('labour_id'); ?>" class="form-control" placeholder="Labour Id"
                                    required>
                                <?= form_error('labour_id'); ?>
                            </div>

                            <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                                <label>Labour ID File</label>
                                <input type="file" name="labour_id_file" id="labour_id_file" class="form-control">
                                <div id="labour_file_preview" class="small text-muted mt-1"></div>
                            </div>

                            <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                                <label>Labour ID Type <span class="text-danger">*</span></label>
                                <select name="labour_id_type" id="labour_id_type" class="form-control" required>
                                    <option value="">Select</option>
                                    <option value="Labour" <?= set_select('labour_id_type', 'Labour'); ?>>Labour</option>
                                    <option value="Dependant" <?= set_select('labour_id_type', 'Dependant'); ?>>Dependant
                                    </option>
                                </select>
                                <?= form_error('labour_id_type'); ?>
                            </div>
                        </div>

                        <!-- KYC DETAILS -->
                        <h6 class="section-title mt-4">KYC Details</h6>
                        <hr>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                                <label>KYC Type <span class="text-danger">*</span></label>
                                <select name="kyc_type" id="kyc_type" class="form-control" required>
                                    <option value="">Select</option>
                                    <option value="Aadhaar" <?= set_select('kyc_type', 'Aadhaar'); ?>>Aadhaar</option>
                                    <option value="Voter ID" <?= set_select('kyc_type', 'Voter ID'); ?>>Voter ID</option>
                                    <option value="PAN" <?= set_select('kyc_type', 'PAN'); ?>>PAN</option>
                                </select>
                                <?= form_error('kyc_type'); ?>
                            </div>

                            <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                                <label>ID No <span class="text-danger">*</span></label>
                                <input type="text" name="kyc_no" id="kyc_no" value="<?= set_value('kyc_no'); ?>"
                                    class="form-control" placeholder="ID No" required>
                                <?= form_error('kyc_no'); ?>
                            </div>

                            <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                                <label>KYC File</label>
                                <input type="file" name="kyc_file" class="form-control">
                                <div id="kyc_file_preview" class="small text-muted mt-1"></div>
                            </div>
                        </div>
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-stretch mt-3">

                            <button type="button" class="btn btn-outline-secondary mb-2 mb-md-0" data-prev="#project">
                                Back
                            </button>

                            <div class="d-flex flex-column flex-md-row">
                                <button type="button" id="updateBtn" class="btn btn-warning mr-md-2 mb-2 mb-md-0"
                                    style="display:none;">
                                    Update Patient
                                </button>

                                <button type="button" class="btn btn-primary next-tab" data-next="#general">
                                    Next
                                </button>
                            </div>

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
                    <h6 class="section-title">Body Measurements <span class="badge badge-warning ml-2">Mandatory</span></h6>
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                            <label>Height <span class="text-danger">*</span></label>
                            <input type="text" name="height" value="<?= set_value('height'); ?>" class="form-control"
                                placeholder="in cm" required>
                            <?= form_error('height'); ?>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                            <label>Weight <span class="text-danger">*</span></label>
                            <input type="text" name="weight" value="<?= set_value('weight'); ?>" class="form-control"
                                placeholder="in kgs" required>
                            <?= form_error('weight'); ?>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                            <label>BMI <span class="text-danger">*</span></label>
                            <input type="text" name="bmi" value="<?= set_value('bmi'); ?>" class="form-control"
                                placeholder="BMI" required>
                            <?= form_error('bmi'); ?>
                        </div>
                    </div>

                    <!-- BODY COMPOSITION -->
                    <h6 class="section-title mt-4">Body Composition</h6>
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                            <label>Hydration (%)</label>
                            <input type="text" name="hydration" value="<?= set_value('hydration'); ?>"
                                class="form-control" placeholder="Hydration (%)">
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                            <label>Fat (%)</label>
                            <input type="text" name="fat" value="<?= set_value('fat'); ?>" class="form-control"
                                placeholder="Fat (%)">
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                            <label>Bonemass (%)</label>
                            <input type="text" name="bonemass" value="<?= set_value('bonemass'); ?>"
                                class="form-control" placeholder="Bonemass (%)">
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                            <label>Muscle (%)</label>
                            <input type="text" name="muscle" value="<?= set_value('muscle'); ?>" class="form-control"
                                placeholder="Muscle (%)">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                            <label>V fat (%)</label>
                            <input type="text" name="vfat" value="<?= set_value('vfat'); ?>" class="form-control"
                                placeholder="V fat (%)">
                        </div>
                    </div>

                    <!-- VITAL SIGNS -->
                    <h6 class="section-title mt-4">Vital Signs <span class="badge badge-warning ml-2">Mandatory</span></h6>

                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                            <label>Systolic Blood Pressure (mm Hg) <span class="text-danger">*</span></label>
                            <input type="text" name="systolic_bp" value="<?= set_value('systolic_bp'); ?>"
                                class="form-control" placeholder="mm Hg" required>
                            <?= form_error('systolic_bp'); ?>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                            <label>Diastolic Blood Pressure (mm Hg) <span class="text-danger">*</span></label>
                            <input type="text" name="diastolic_bp" value="<?= set_value('diastolic_bp'); ?>"
                                class="form-control" placeholder="mm Hg" required>
                            <?= form_error('diastolic_bp'); ?>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                            <label>Pulse (bpm) <span class="text-danger">*</span></label>
                            <input type="text" name="pulse" value="<?= set_value('pulse'); ?>" class="form-control"
                                placeholder="bpm" required>
                            <?= form_error('pulse'); ?>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                            <label>SpO2 (%) <span class="text-danger">*</span></label>
                            <input type="text" name="spo2" value="<?= set_value('spo2'); ?>" class="form-control"
                                placeholder="SpO2 (%)" required>
                            <?= form_error('spo2'); ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                            <label>Temperature (°C) <span class="text-danger">*</span></label>
                            <input type="text" name="temperature" value="<?= set_value('temperature'); ?>"
                                class="form-control" placeholder="°C" required>
                            <?= form_error('temperature'); ?>
                        </div>
                    </div>

                    <!-- METABOLIC AGE -->
                    <h6 class="section-title mt-4">Metabolic Indicators</h6>

                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                            <label>Metabolic Age</label>
                            <input type="text" name="metabolic_age" value="<?= set_value('metabolic_age'); ?>"
                                class="form-control" placeholder="Metabolic Age">
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                            <label>Basal Metabolic Age</label>
                            <input type="text" name="basal_metabolic_age"
                                value="<?= set_value('basal_metabolic_age'); ?>" class="form-control"
                                placeholder="Basal Metabolic Age">
                        </div>
                    </div>
                    <div class="d-flex flex-column flex-md-row justify-content-between gap-2 mt-3">
                        <button type="button" class="btn btn-outline-secondary prev-tab"
                            data-prev="#patient">Back</button>
                        <button type="button" class="btn btn-primary next-tab " data-next="#gp">Next</button>
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
                            <h6 class="sub-section-title">Heart <span class="text-danger">*</span></h6>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="heart_status" value="normal"
                                    <?= set_radio('heart_status', 'normal'); ?> required>
                                <label class="form-check-label">Normal – S1 S2 heard</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="heart_status" value="murmurs"
                                    <?= set_radio('heart_status', 'murmurs'); ?>>
                                <label class="form-check-label">Abnormal – Murmurs</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="heart_status" value="rasping"
                                    <?= set_radio('heart_status', 'rasping'); ?>>
                                <label class="form-check-label">Abnormal – Rasping</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="heart_status" value="blowing_sand"
                                    <?= set_radio('heart_status', 'blowing_sand'); ?>>
                                <label class="form-check-label">Abnormal – Blowing Sound</label>
                            </div>
                            <?= form_error('heart_status'); ?>
                        </div>

                        <!-- LUNG -->
                        <div class="col-md-4">
                            <h6 class="sub-section-title"> Lung<span class="text-danger">*</span></h6>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="lung_status" value="normal"
                                    <?= set_radio('lung_status', 'normal'); ?> required>
                                <label class="form-check-label">Normal – B/L NVBS</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="lung_status" value="rhonchi"
                                    <?= set_radio('lung_status', 'rhonchi'); ?>>
                                <label class="form-check-label">Abnormal – Rhonchi low pitched</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="lung_status" value="creales"
                                    <?= set_radio('lung_status', 'creales'); ?>>
                                <label class="form-check-label">Abnormal – Creales (high pitched whistling)</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="lung_status" value="strides"
                                    <?= set_radio('lung_status', 'strides'); ?>>
                                <label class="form-check-label">Abnormal – Strides (breath vibrator sound)</label>
                            </div>
                            <?= form_error('lung_status'); ?>
                        </div>

                        <!-- ABDOMEN -->
                        <div class="col-md-4">
                            <h6 class="sub-section-title"> Abdomen<span class="text-danger">*</span></h6>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="abdomen_status" value="normal"
                                    <?= set_radio('abdomen_status', 'normal'); ?> required>
                                <label class="form-check-label">Normal – P/A soft BS non tender</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="abdomen_status" value="splenomegaly"
                                    <?= set_radio('abdomen_status', 'splenomegaly'); ?>>
                                <label class="form-check-label">Abnormal – Splenomegaly</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="abdomen_status" value="hepatomegaly"
                                    <?= set_radio('abdomen_status', 'hepatomegaly'); ?>>
                                <label class="form-check-label">Abnormal – Hepatomegaly</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="abdomen_status"
                                    value="urinary_retention" <?= set_radio('abdomen_status', 'urinary_retention'); ?>>
                                <label class="form-check-label">Abnormal – Urinary Retention</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="abdomen_status" value="distention"
                                    <?= set_radio('abdomen_status', 'distention'); ?>>
                                <label class="form-check-label">Abnormal – Distention</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="abdomen_status"
                                    value="decreased_bowel" <?= set_radio('abdomen_status', 'decreased_bowel'); ?>>
                                <label class="form-check-label">Abnormal – Decreased Bowel Sounds</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="abdomen_status"
                                    value="abdominal_mass" <?= set_radio('abdomen_status', 'abdominal_mass'); ?>>
                                <label class="form-check-label">Abnormal – Abdominal Mass</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="abdomen_status"
                                    value="umbilical_hernia" <?= set_radio('abdomen_status', 'umbilical_hernia'); ?>>
                                <label class="form-check-label">Abnormal – Umbilical Hernia</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="abdomen_status"
                                    value="inguinal_hernia" <?= set_radio('abdomen_status', 'inguinal_hernia'); ?>>
                                <label class="form-check-label">Abnormal – Inguinal Hernia</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="abdomen_status" value="rigidity"
                                    <?= set_radio('abdomen_status', 'rigidity'); ?>>
                                <label class="form-check-label">Abnormal – Rigidity</label>
                            </div>
                            <?= form_error('abdomen_status'); ?>
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
                            <input type="text" name="fef" value="<?= set_value('fef'); ?>" class="form-control"
                                placeholder="FEF value">
                        </div>
                    </div>

                    <div class="row mb-3 align-items-center">
                        <div class="col-md-2">
                            <label>PEF</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="pef" value="<?= set_value('pef'); ?>" class="form-control"
                                placeholder="PEF value">
                        </div>
                    </div>

                    <div class="row mb-3 align-items-center">
                        <div class="col-md-2">
                            <label>FEV1</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="fev1" value="<?= set_value('fev1'); ?>" class="form-control"
                                placeholder="FEV1 value">
                        </div>
                    </div>

                    <div class="row mb-3 align-items-center">
                        <div class="col-md-2">
                            <label>FEV6</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="fev6" value="<?= set_value('fev6'); ?>" class="form-control"
                                placeholder="FEV6 value">
                        </div>
                    </div>
                    <div class="d-flex flex-column flex-md-row justify-content-between gap-2 mt-3">
                        <button type="button" class="btn btn-outline-secondary prev-tab"
                            data-prev="#general">Back</button>
                        <button type="button" class="btn btn-primary next-tab" data-next="#special">Next</button>
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
                                <label class="form-label">Is Otology Completed? <span
                                        class="text-danger">*</span></label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="otology_completed" value="yes"
                                        <?= set_radio('otology_completed', 'yes'); ?> required>
                                    <label class="form-check-label">Yes</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="otology_completed" value="no"
                                        <?= set_radio('otology_completed', 'no'); ?>>
                                    <label class="form-check-label">No</label>
                                </div>
                                <?= form_error('otology_completed'); ?>
                            </div>

                            <!-- PROVISIONAL DIAGNOSIS -->
                            <div class="mb-3">
                                <label class="form-label">Provisional Diagnosis</label>
                                <textarea name="provisional_diagnosis" class="form-control" rows="2"
                                    placeholder="Provisional Diagnosis"><?= set_value('provisional_diagnosis'); ?></textarea>
                            </div>

                            <!-- HEARING LEVELS -->
                            <h6 class="sub-section-title mt-4">Hearing Levels <span class="badge badge-warning ml-2">Mandatory</span> </h6> 
                            <div class="row">
                                <!-- LEFT EAR -->
                                <div class="col-md-6">
                                    <h6 class="sub-section-title mt-3">Left Ear</h6>
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label>Left Freq 500 Hz <span class="text-danger">*</span></label>
                                            <input type="text" name="left_ear_500"
                                                value="<?= set_value('left_ear_500'); ?>" class="form-control" required
                                                placeholder="0 to 120 db">
                                            <?= form_error('left_ear_500'); ?>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label>Left Freq 1 KHz <span class="text-danger">*</span></label>
                                            <input type="text" name="left_ear_1k"
                                                value="<?= set_value('left_ear_1k'); ?>" class="form-control" required
                                                placeholder="0 to 120 db">
                                            <?= form_error('left_ear_1k'); ?>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label>Left Freq 2 KHz <span class="text-danger">*</span></label>
                                            <input type="text" name="left_ear_2k"
                                                value="<?= set_value('left_ear_2k'); ?>" class="form-control" required
                                                placeholder="0 to 120 db">
                                            <?= form_error('left_ear_2k'); ?>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label>Left Freq 4 KHz <span class="text-danger">*</span></label>
                                            <input type="text" name="left_ear_4k"
                                                value="<?= set_value('left_ear_4k'); ?>" class="form-control" required
                                                placeholder="0 to 120 db">
                                            <?= form_error('left_ear_4k'); ?>
                                        </div>
                                    </div>
                                </div>

                                <!-- RIGHT EAR -->
                                <div class="col-md-6">
                                    <h6 class="sub-section-title mt-3">Right Ear</h6>
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label>Right Freq 500 Hz <span class="text-danger">*</span></label>
                                            <input type="text" name="right_ear_500"
                                                value="<?= set_value('right_ear_500'); ?>" class="form-control" required
                                                placeholder="0 to 120 db">
                                            <?= form_error('right_ear_500'); ?>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label>Right Freq 1 KHz <span class="text-danger">*</span></label>
                                            <input type="text" name="right_ear_1k"
                                                value="<?= set_value('right_ear_1k'); ?>" class="form-control" required
                                                placeholder="0 to 120 db">
                                            <?= form_error('right_ear_1k'); ?>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label>Right Freq 2 KHz <span class="text-danger">*</span></label>
                                            <input type="text" name="right_ear_2k"
                                                value="<?= set_value('right_ear_2k'); ?>" class="form-control" required
                                                placeholder="0 to 120 db">
                                            <?= form_error('right_ear_2k'); ?>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label>Right Freq 4 KHz <span class="text-danger">*</span></label>
                                            <input type="text" name="right_ear_4k"
                                                value="<?= set_value('right_ear_4k'); ?>" class="form-control" required
                                                placeholder="0 to 120 db">
                                            <?= form_error('right_ear_4k'); ?>
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
                                <textarea name="history" class="form-control"
                                    rows="2"><?= set_value('history'); ?></textarea>
                            </div>

                            <!-- SYMPTOMS -->
                            <div class="mb-3">
                                <label class="form-label">Symptoms</label>
                                <select name="symptoms" class="form-control">
                                    <option value="NA">NA</option>
                                    <option value="blurred_vision" <?= set_select('symptoms', 'blurred_vision'); ?>>
                                        Blurred Vision</option>
                                    <option value="watering" <?= set_select('symptoms', 'watering'); ?>>Watering</option>
                                    <option value="redness" <?= set_select('symptoms', 'redness'); ?>>Redness</option>
                                </select>
                            </div>

                            <!-- OCCULAR FINDINGS -->
                            <div class="mb-3">
                                <label class="form-label">Occular Findings</label>
                                <select name="ocular_findings" class="form-control">
                                    <option value="normal" <?= set_select('ocular_findings', 'normal'); ?>>Normal
                                    </option>
                                    <option value="conjunctivitis" <?= set_select('ocular_findings', 'conjunctivitis'); ?>>Conjunctivitis</option>
                                    <option value="cataract" <?= set_select('ocular_findings', 'cataract'); ?>>Cataract
                                    </option>
                                    <option value="pterygium" <?= set_select('ocular_findings', 'pterygium'); ?>>
                                        Pterygium</option>
                                </select>
                            </div>

                            <!-- EXTERNAL EYE EXAMINATION -->
                            <div class="mb-3">
                                <label class="form-label">External Eye Examination <span
                                        class="text-danger">*</span></label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="external_eye_exam"
                                        value="abnormal" <?= set_radio('external_eye_exam', 'abnormal'); ?> required>
                                    <label class="form-check-label">Abnormal</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="external_eye_exam" value="normal"
                                        <?= set_radio('external_eye_exam', 'normal'); ?>>
                                    <label class="form-check-label">Normal</label>
                                </div>
                                <?= form_error('external_eye_exam'); ?>
                            </div>

                            <!-- REFRACTION -->
                            <div class="mb-3">
                                <label class="form-label">Refraction</label>
                                <select name="refraction" class="form-control">
                                    <option value="no" <?= set_select('refraction', 'no'); ?>>No</option>
                                    <option value="yes" <?= set_select('refraction', 'yes'); ?>>Yes</option>
                                </select>
                            </div>

                            <!-- VISUAL ACUITY -->
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Visual Acuity - RE <span
                                            class="text-danger">*</span></label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="va_re" value="6/6"
                                            <?= set_radio('va_re', '6/6'); ?> required>
                                        6/6<br>
                                        <input class="form-check-input" type="radio" name="va_re" value="6/9"
                                            <?= set_radio('va_re', '6/9'); ?>>
                                        6/9<br>
                                        <input class="form-check-input" type="radio" name="va_re" value="6/12"
                                            <?= set_radio('va_re', '6/12'); ?>>
                                        6/12<br>
                                        <input class="form-check-input" type="radio" name="va_re" value="6/18"
                                            <?= set_radio('va_re', '6/18'); ?>>
                                        6/18<br>
                                        <input class="form-check-input" type="radio" name="va_re" value="6/24"
                                            <?= set_radio('va_re', '6/24'); ?>>
                                        6/24<br>
                                        <input class="form-check-input" type="radio" name="va_re" value="6/36"
                                            <?= set_radio('va_re', '6/36'); ?>>
                                        6/36<br>
                                        <input class="form-check-input" type="radio" name="va_re" value="6/60"
                                            <?= set_radio('va_re', '6/60'); ?>> 6/60
                                    </div>
                                    <?= form_error('va_re'); ?>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Visual Acuity - LE <span
                                            class="text-danger">*</span></label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="va_le" value="6/6"
                                            <?= set_radio('va_le', '6/6'); ?> required>
                                        6/6<br>
                                        <input class="form-check-input" type="radio" name="va_le" value="6/9"
                                            <?= set_radio('va_le', '6/9'); ?>>
                                        6/9<br>
                                        <input class="form-check-input" type="radio" name="va_le" value="6/12"
                                            <?= set_radio('va_le', '6/12'); ?>>
                                        6/12<br>
                                        <input class="form-check-input" type="radio" name="va_le" value="6/18"
                                            <?= set_radio('va_le', '6/18'); ?>>
                                        6/18<br>
                                        <input class="form-check-input" type="radio" name="va_le" value="6/24"
                                            <?= set_radio('va_le', '6/24'); ?>>
                                        6/24<br>
                                        <input class="form-check-input" type="radio" name="va_le" value="6/36"
                                            <?= set_radio('va_le', '6/36'); ?>>
                                        6/36<br>
                                        <input class="form-check-input" type="radio" name="va_le" value="6/60"
                                            <?= set_radio('va_le', '6/60'); ?>> 6/60
                                    </div>
                                    <?= form_error('va_le'); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-column flex-md-row justify-content-between gap-2 mt-3">
                        <button type="button" class="btn btn-outline-secondary prev-tab" data-prev="#gp">Back</button>
                        <button type="button" class="btn btn-primary next-tab" data-next="#lab">Next</button>
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
                            <label>Hemoglobin <span class="text-danger">*</span></label>
                            <input name="hemoglobin" id="hemoglobin" value="<?= set_value('hemoglobin'); ?>"
                                class="form-control" placeholder="g/dL" required>
                            <?= form_error('hemoglobin'); ?>
                        </div>
                        <div class="col-md-3">
                            <label>Blood Sugar (Random) <span class="text-danger">*</span></label>
                            <input name="blood_sugar" id="blood_sugar" value="<?= set_value('blood_sugar'); ?>"
                                class="form-control" placeholder="mg/dL" required>
                            <?= form_error('blood_sugar'); ?>
                        </div>
                        <div class="col-md-3">
                            <label>HbA1c <span class="text-danger">*</span></label>
                            <input name="hba1c" id="hba1c" value="<?= set_value('hba1c'); ?>" class="form-control"
                                placeholder="%" required>
                            <?= form_error('hba1c'); ?>
                        </div>
                        <div class="col-md-3">
                            <label>Urine Routine <span class="text-danger">*</span></label>
                            <select name="urine_routine" class="form-control" required>
                                <option value="normal" <?= set_select('urine_routine', 'normal'); ?>>Normal</option>
                                <option value="abnormal" <?= set_select('urine_routine', 'abnormal'); ?>>Abnormal
                                </option>
                            </select>

                        </div>
                        <?= form_error('urine_routine'); ?>
                    </div>

                    <div class="section-title">Haematology Investigation</div>
                    <p class="text-muted small">Lab values as per collected samples.</p>
                    <div class="row">
                        <div class="row mt-3">
                            <div class="col-md-3">
                                <label>WBC Count </label>
                                <input name="wbc_count" id="wbc_count" value="<?= set_value('wbc_count'); ?>"
                                    class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label>Platelet Count</label>
                                <input name="platelet_count" id="platelet_count"
                                    value="<?= set_value('platelet_count'); ?>" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label>ECG</label>
                                <select name="ecg" class="form-control">
                                    <option value="not_done" <?= set_select('ecg', 'not_done'); ?>>Not Done</option>
                                    <option value="normal" <?= set_select('ecg', 'normal'); ?>>Normal</option>
                                    <option value="abnormal" <?= set_select('ecg', 'abnormal'); ?>>Abnormal</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Chest X-Ray</label>
                                <select name="chest_x_ray" class="form-control">
                                    <option value="not_required" <?= set_select('chest_x_ray', 'not_required'); ?>>Not
                                        Required</option>
                                    <option value="normal" <?= set_select('chest_x_ray', 'normal'); ?>>Normal</option>
                                    <option value="abnormal" <?= set_select('chest_x_ray', 'abnormal'); ?>>Abnormal
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column flex-md-row justify-content-between gap-2 mt-3">
                        <button type="button" class="btn btn-outline-secondary prev-tab"
                            data-prev="#special">Back</button>
                        <button type="button" class="btn btn-primary next-tab" data-next="#report">Next</button>
                    </div>
                </div>

                <!-- ---------------------------------------------------------------------------------------------------------- -->
                <!-- REPORT -->
                <!-- ---------------------------------------------------------------------------------------------------------- -->
                <div class="tab-pane fade" id="report">
                    <div class="section-title">Form Completion Summary</div>
                    <p class="text-muted small">Review your entries before final submission.</p>

                    <div class="row" id="report-summary-container">
                    </div>

                    <div class="d-flex flex-column flex-md-row justify-content-between gap-2 mt-4">
                        <button type="button" class="btn btn-outline-secondary prev-tab" data-prev="#lab">Back to
                            Lab</button>
                        <button type="button" class="btn btn-primary next-tab" data-next="#analytics">Go to
                            Submission</button>
                    </div>
                </div>

                <!-- ---------------------------------------------------------------------------------------------------------- -->
                <!-- ANALYTICS / SUBMIT -->
                <!-- ---------------------------------------------------------------------------------------------------------- -->


                <div class="tab-pane fade" id="analytics">
                    <div class="section-title text-primary">Pre-Submission Validation Check</div>
                    <p class="text-muted small">The list below summarizes the completion of mandatory clinical fields.
                    </p>

                    <div id="analytics-alert" class="alert mb-4 shadow-sm"></div>

                    <div class="row">
                        <div class="col-md-9">
                            <div class="list-group shadow-sm" id="analytics-checklist"></div>
                        </div>
                    </div>

                    <div class="text-right mt-5 border-top pt-4">
                        <button type="submit" class="btn btn-success btn-lg px-5" id="finalSubmitBtn">
                            <i class="bi bi-cloud-check"></i> Final Submit
                        </button>
                        <button type="button" class="btn btn-danger" id="finishCamp">Finish Camp</button>
                    </div>

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

    $('.select2').select2({
        width: '100%'
    });

    $('.select2-tags').select2({
        tags: true,
        width: '100%',
        placeholder: "Select or type project name"
    });
</script>
<script>
    $(document).ready(function () {

        //Project ID
        let projectId = "<?= $this->session->userdata('project_id'); ?>";
        if (projectId) {
            $('#project').find('[required]').removeAttr('required');
        }

        // =========================
        // CSRF TOKEN
        // =========================
        let csrfName = $('input[name="<?= $this->security->get_csrf_token_name(); ?>"]').attr('name');
        let csrfHash = $('input[name="<?= $this->security->get_csrf_token_name(); ?>"]').val();

        // =========================
        // PATIENT TYPE TOGGLE
        // =========================
        let patientType = "<?= set_value('patient_type'); ?>";

        if (patientType === 'existing') {
            $('#existing_patient_box').show();
        }
        $('input[name="patient_type"]').change(function () {
            let type = $(this).val();
            //  console.log("Selected:", type);
            if (type === 'existing') {
                $('#existing_patient_box').show();
            } else {
                $('#existing_patient_box').hide();
                $('#patient_section')
                    .find('input, select')
                    .prop('disabled', false);

                $('#updateBtn').hide();
                $('#is_patient_updated').val(0);
            }
        });

        // =========================
        // FETCH EXISTING PATIENT
        // =========================
        $('#existing_patient').change(function () {

            let id = $(this).val();
            if (!id) return;

            $.ajax({
                url: "<?= base_url('user/new_screening/get_patient') ?>",
                type: "POST",
                data: {
                    id: id,
                    [csrfName]: csrfHash
                },
                dataType: "json",
                success: function (res) {
                    $('#first_name').val(res.first_name);
                    $('#last_name').val(res.last_name);
                    $('#age').val(res.age);
                    $('#gender').val(res.gender);
                    $('#mobile').val(res.mobile);

                    $('input[name="labour_id"]').val(res.labour_id);
                    $('select[name="labour_id_type"]').val(res.labour_id_type);

                    $('select[name="kyc_type"]').val(res.kyc_type);
                    $('input[name="kyc_no"]').val(res.kyc_no);

                    if (res.labour_id_file) {
                        $('#labour_file_preview').html(
                            `<a href="<?= base_url('uploads/labour/') ?>${res.labour_id_file}" target="_blank">
                View uploaded file
            </a>`
                        );
                    }

                    if (res.kyc_file) {
                        $('#kyc_file_preview').html(
                            `<a href="<?= base_url('uploads/kyc/') ?>${res.kyc_file}" target="_blank">
                View uploaded file
            </a>`
                        );
                    }
                    $('#patient_section input').prop('readonly', true);
                    $('#patient_section select').prop('disabled', true);
                    $('#updateBtn').show();
                    $('#is_patient_updated').val(0);
                    csrfHash = $('input[name="<?= $this->security->get_csrf_token_name(); ?>"]').val();
                }
            });
        });

        // =========================
        // UPDATE BUTTON CLICK
        // =========================
        $('#updateBtn').click(function () {
            $('#patient_section input').prop('readonly', false);
            $('#patient_section select').prop('disabled', false);
            $('#is_patient_updated').val(1);
            alert("Now you can edit patient details");
        });

        // =========================
        // TAB NEXT
        // =========================
        $('.next-tab').off('click').on('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            e.stopImmediatePropagation();

            let nextTab = $(this).data('next');
            let currentTabPane = $(this).closest('.tab-pane');
            let isValid = true;

            currentTabPane.find('.temp-error').remove();
            currentTabPane.find('.is-invalid').removeClass('is-invalid');
            currentTabPane.find('.is-invalid-container').removeClass('is-invalid-container');

            currentTabPane.find('[required]').each(function () {
                let field = $(this);
                let fieldName = field.attr('name');
                let isMissing = false;

                if (field.is(':radio')) {
                    if ($(`input[name="${fieldName}"]:checked`).length === 0) {
                        isMissing = true;
                        // field.closest('.form-check').parent().addClass('is-invalid-container');
                    }
                } else if (field.is('select')) {
                    if (!field.val() || field.val() === "" || field.val() === null) {
                        isMissing = true;
                        field.addClass('is-invalid');
                        if (field.hasClass('select2-hidden-accessible')) {
                            field.next('.select2-container').find('.select2-selection').addClass('is-invalid');
                        }
                    }
                } else {
                    if (!field.val() || field.val().trim() === "") {
                        isMissing = true;
                        field.addClass('is-invalid');
                    }
                }

                if (isMissing) {
                    isValid = false;
                    let parent = field.closest('.mb-3, .col-md-3, .col-md-4, .col-lg-3, .form-group, .row');
                    let labelText = parent.find('label').first().text().replace('*', '').trim();

                    if (!labelText || labelText.length < 2) {
                        labelText = field.attr('placeholder') || field.attr('name');
                    }
                    let errorHtml = `<div class="text-danger small mt-1 temp-error" style="font-weight:600; display:block;">${labelText} is required.</div>`;
                    if (field.hasClass('select2-hidden-accessible')) {
                        field.next('.select2-container').after(errorHtml);
                    } else if (field.is(':radio')) {
                        if (field.closest('div').parent().find('.temp-error').length === 0) {
                            field.closest('div').parent().append(errorHtml);
                        }
                    } else {
                        field.after(errorHtml);
                    }
                }
            });
            if (isValid) {
                $(`.nav-tabs a[href="${nextTab}"]`).tab('show');
                $('html, body').animate({ scrollTop: $(".newscreening").offset().top - 20 }, 200);
            } else {
                $('html, body').animate({
                    scrollTop: currentTabPane.find('.is-invalid, .temp-error, .is-invalid-container').first().offset().top - 150
                }, 300);
            }
            return false;
        });

        // =========================
        // GENERATE REPORT & ANALYTICS PREVIEWS 
        // =========================
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            let target = $(e.target).attr("href");

            // --- REPORT TAB LOGIC ---
            if (target === "#report") {
                let container = $('#report-summary-container');
                container.empty();

                let sections = [];

                if (!projectId) {
                    sections.push({ id: '#project', title: 'Project Details' });
                }

                sections.push(
                    { id: '#patient', title: 'Patient Info' },
                    { id: '#general', title: 'Vitals & Body' },
                    { id: '#gp', title: 'GP Screening' },
                    { id: '#special', title: 'Specialty Screening' },
                    { id: '#lab', title: 'Laboratory' }
                );

                let processedNames = [];

                sections.forEach(section => {
                    let sectionHasData = false;
                    let html = `<div class="col-md-6 mb-4">
                                    <div class="card border-light shadow-sm">
                                        <div class="card-header py-2 bg-light d-flex justify-content-between align-items-center">
                                            <strong class="text-secondary">${section.title}</strong>
                                            <button type="button" class="btn btn-sm btn-link p-0 text-primary edit-shortcut" data-target="${section.id}" style="font-size:12px">Edit</button>
                                        </div>
                                        <ul class="list-group list-group-flush small" style="max-height: 400px; overflow-y: auto;">`;

                    $(section.id).find('input, select, textarea').each(function () {
                        let name = $(this).attr('name');
                        if (!name || $(this).attr('type') === 'hidden' || processedNames.includes(name)) return;

                        let labelText = "";
                        let parent = $(this).closest('.mb-3, .col-md-3, .col-md-4, .col-md-6, .col-md-12, .col-lg-3, .row, .form-group');
                        let labelObj = $(section.id).find(`label[for="${$(this).attr('id')}"]`);
                        if (labelObj.length === 0 || labelObj.text().trim() === "") { labelObj = parent.find('label').first(); }
                        if (labelObj.length === 0 || labelObj.text().trim() === "") { labelObj = $(this).closest('.row').find('label').first(); }

                        labelText = labelObj.text().replace('*', '').trim();
                        if (!labelText || labelText.length < 2) {
                            labelText = $(this).attr('placeholder') || name.replace(/_/g, ' ').toUpperCase();
                        }

                        let isMissing = false;
                        let displayValue = "";

                        if ($(this).is(':radio')) {
                            let checkedRadio = $(`input[name="${name}"]:checked`);
                            if (checkedRadio.length > 0) {
                                displayValue = checkedRadio.next('label').text().trim() || checkedRadio.val();
                            } else { isMissing = true; }
                        } else if ($(this).is('select')) {
                            let val = $(this).val();
                            if (!val || val === "" || (Array.isArray(val) && val.length === 0)) {
                                isMissing = true;
                            } else {
                                displayValue = Array.isArray(val) ? "Multiple Selected" : $(this).find('option:selected').text().trim();
                            }
                        } else {
                            let val = $(this).val();
                            if (!val || val.trim() === "") { isMissing = true; } else { displayValue = val; }
                        }

                        sectionHasData = true;
                        processedNames.push(name);

                        if (isMissing) {
                            html += `<li class="list-group-item d-flex justify-content-between align-items-center bg-light text-muted">
                                        <span>${labelText}</span>
                                        <span class="badge badge-light border text-muted">Empty</span>
                                     </li>`;
                        } else {
                            html += `<li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span class="text-muted">${labelText}</span>
                                        <span class="text-dark font-weight-bold text-right ml-2">${displayValue}</span>
                                     </li>`;
                        }
                    });

                    html += `</ul></div></div>`;
                    if (sectionHasData) container.append(html);
                });
            }

            // --- ANALYTICS TAB LOGIC ---
            if (target === "#analytics") {
                let checklist = $('#analytics-checklist');
                let alertBox = $('#analytics-alert');
                let submitBtn = $('#finalSubmitBtn');

                checklist.empty();
                let sectionsFoundWithIssues = 0;

                let sections = [];

                if (!projectId) {
                    sections.push({ id: '#project', title: 'Project Information' });
                }

                sections.push(
                    { id: '#patient', title: 'Patient Registration' },
                    { id: '#general', title: 'General Check' },
                    { id: '#gp', title: 'GP Screening' },
                    { id: '#special', title: 'Specialty Screening' },
                    { id: '#lab', title: 'Laboratory Reports' }
                );

                sections.forEach(section => {
                    let issues = [];

                    //  Scan for client-side required fields that are empty
                    $(section.id).find('[required]').each(function () {
                        let name = $(this).attr('name');
                        let val = $(this).val();
                        let isMissing = false;

                        if ($(this).is(':radio')) {
                            if ($(`input[name="${name}"]:checked`).length === 0) isMissing = true;
                        } else {
                            if (!val || val.trim() === "") isMissing = true;
                        }

                        if (isMissing) {
                            let label = $(this).closest('.mb-3, .row, .col-md-3, .col-md-2, .form-group').find('label').first().text().replace('*', '').trim();
                            issues.push(label || name);
                        }
                    });

                    //  Scan for server-side errors (text-danger tags)
                    $(section.id).find('small.text-danger').each(function () {
                        if ($(this).text().trim().length > 0) {
                            let label = $(this).closest('.mb-3, .row, .col-md-3, .col-md-2, .form-group').find('label').first().text().replace('*', '').trim();
                            if (label) issues.push(label);
                        }
                    });

                    issues = [...new Set(issues)];

                    let html = "";
                    if (issues.length === 0) {
                        html = `<div class="list-group-item d-flex justify-content-between align-items-center bg-light">
                                    <span><i class="bi bi-check-circle-fill text-success mr-2"></i> ${section.title}</span>
                                    <span class="badge badge-success px-3">Ready</span>
                                </div>`;
                    } else {
                        sectionsFoundWithIssues++;
                        html = `<div class="list-group-item flex-column align-items-start border-left-danger" style="border-left: 5px solid #dc3545;">
                                    <div class="d-flex w-100 justify-content-between align-items-center">
                                        <h6 class="mb-1 text-danger font-weight-bold">${section.title}</h6>
                                        <span class="badge badge-danger">${issues.length} Issue(s)</span>
                                    </div>
                                    <p class="mb-1 small text-muted">Required: <strong>${issues.join(', ')}</strong></p>
                                    <a href="javascript:void(0)" class="small text-primary edit-shortcut" data-target="${section.id}">Open Section →</a>
                                </div>`;
                    }
                    checklist.append(html);
                });

                if (sectionsFoundWithIssues > 0) {
                    alertBox.removeClass('alert-success alert-info').addClass('alert-danger');
                    alertBox.html(`<h5><i class="bi bi-shield-lock-fill"></i> Submission Locked</h5>
                       <p class="mb-0 small">Please fill the mandatory fields in <strong>${sectionsFoundWithIssues}</strong> sections to enable the submit button.</p>`);
                    submitBtn.prop('disabled', true).addClass('btn-secondary').removeClass('btn-success');
                } else {
                    alertBox.removeClass('alert-danger alert-info').addClass('alert-success');
                    alertBox.html(`<h5><i class="bi bi-check-all"></i> Ready to Submit</h5>
                       <p class="mb-0 small">All required clinical data has been verified. You can now finalize this screening.</p>`);
                    submitBtn.prop('disabled', false)
                        .addClass('btn-success').removeClass('btn-secondary');
                }
            }

            $('#finalSubmitBtn').click(function () {
                console.log("Submit button clicked");
            });
            $('.edit-shortcut').off('click').on('click', function (e) {
                e.preventDefault();
                let tabId = $(this).data('target');
                $(`.nav-tabs a[href="${tabId}"]`).tab('show');
                $('html, body').animate({ scrollTop: $(".newscreening").offset().top }, 200);
            });

        });


        // =========================
        // TAB PREVIOUS
        // =========================
        $('.prev-tab').click(function () {
            let prevTab = $(this).data('prev');
            if (prevTab) {
                $('.nav-tabs a[href="' + prevTab + '"]').tab('show');
            }
        });

        // =========================
        // OPEN TAB AFTER REDIRECT
        // =========================
        let tab = new URLSearchParams(window.location.search).get('tab');
        if (tab === 'patient') {
            $('.nav-tabs a[href="#patient"]').tab('show');
        }
        var openTab = "<?= isset($open_tab) ? $open_tab : '' ?>";
        if (openTab) {
            $('.nav-tabs a[href="#' + openTab + '"]').tab('show');
        }

        // =========================
        // FINISH CAMP
        // =========================
        $('#finishCamp').click(function () {
            if (confirm("Finish this camp?")) {
                window.location.href = "<?= base_url('user/new_screening/finish_camp') ?>";
            }
        });

        // =========================
        // OPEN TAB WITH ERROR
        // =========================
        if ($('.text-danger').length > 0) {
            let tabPane = $('.text-danger').first().closest('.tab-pane');
            if (tabPane.length) {
                let tabId = tabPane.attr('id');
                $('.nav-tabs a[href="#' + tabId + '"]').tab('show');

            }

        }
        // =========================
        // REALTIME VALIDATION UPDATE 
        // =========================
        $(document).on('input change', 'input, select, textarea', function () {
            let field = $(this);
            let val = field.val();
            let container = field.closest('.mb-3, .row, .col-md-3, .col-md-2, .form-group');
            let isFilled = false;
            if (field.is(':radio')) {
                if ($(`input[name="${field.attr('name')}"]:checked`).length > 0) isFilled = true;
            } else if (val && val.trim() !== "") {
                isFilled = true;
            }
            if (isFilled) {
                container.find('.text-danger').fadeOut(200, function () {
                    $(this).text('');
                });
                field.removeClass('is-invalid');
                if ($('#analytics').hasClass('active')) {
                    $('.nav-tabs a[href="#analytics"]').trigger('shown.bs.tab');
                }
            }
        });
        $('#healthForm').submit(function () {

            $('#patient_section input').prop('readonly', false);
            $('#patient_section select').prop('disabled', false);

        });
    });
</script>