<style>
    .report-section p {
        margin-bottom: 3px;
        font-size: 15px;
    }

    .section-title {
        background: #f7f7f7;
        border: 1px solid #ddd;
        padding: 6px;
        font-weight: 600;
        border-radius: 4px;
    }

    .report-title {
        color: #1f4e79;
        font-weight: 600;
    }

    .report-badge {
        background: #1f4e79;
        color: white;
        padding: 6px 12px;
        border-radius: 6px;
        font-weight: 500;
    }

    .patient-title,
    .camp-title {
        color: #1f4e79;
    }
</style>



<div class="container mt-4">

    <div class="card shadow-sm">

        <div class="card-body">

            <!-- HEADER -->
            <div class="d-flex justify-content-between align-items-center mb-3 p-3 border rounded bg-light">

                <h4 class="mb-0 report-title">Patient Report</h4>

                <span class="badge report-badge p-2">
                    Report ID : <?= $report->report_id ?>
                </span>

            </div>


            <!-- PATIENT + CAMP DETAILS -->
            <div class="row">

                <div class="col-md-6">

                    <h6 class="patient-title">Patient Details</h6>

                    <table class="table table-bordered table-sm">
                        <tr>
                            <th width="40%">Name</th>
                            <td><?= $report->first_name ?> <?= $report->last_name ?></td>
                        </tr>

                        <tr>
                            <th>Age</th>
                            <td><?= $report->age ?></td>
                        </tr>

                        <tr>
                            <th>Gender</th>
                            <td><?= $report->gender ?></td>
                        </tr>

                        <tr>
                            <th>Mobile</th>
                            <td><?= $report->mobile ?></td>
                        </tr>
                    </table>

                </div>


                <div class="col-md-6">

                    <h6 class="camp-title">Camp Details</h6>

                    <table class="table table-bordered table-sm">

                        <tr>
                            <th width="40%">Camp Name</th>
                            <td><?= $report->project_name ?></td>
                        </tr>

                        <tr>
                            <th>Camp Date</th>
                            <td><?= date('d-m-Y', strtotime($report->camp_date)) ?></td>
                        </tr>

                        <tr>
                            <th>Location</th>
                            <td><?= $report->location ?></td>
                        </tr>

                        <tr>
                            <th>Pincode</th>
                            <td><?= $report->pincode ?></td>
                        </tr>

                    </table>

                </div>

            </div>


            <!-- GENERAL CHECK -->
            <div class=" p-3 mt-4 report-section">

                <h5 class="text-center mb-3 section-title">General Check</h5>

                <div class="row">

                    <div class="col-md-6">
                        <h6 class="text-success">Body Measurements</h6>

                        <p><b>Height :</b> <?= $report->height ?></p>
                        <p><b>Weight :</b> <?= $report->weight ?></p>
                        <p><b>BMI :</b> <?= $report->bmi ?></p>

                    </div>


                    <div class="col-md-6">
                        <h6 class="text-success">Body Composition</h6>

                        <p><b>Hydration :</b> <?= $report->hydration ?></p>
                        <p><b>Fat :</b> <?= $report->fat ?></p>
                        <p><b>Bone Mass :</b> <?= $report->bonemass ?></p>
                        <p><b>Muscle :</b> <?= $report->muscle ?></p>
                        <p><b>Vfat :</b> <?= $report->vfat ?></p>

                    </div>

                </div>


                <div class="row mt-3">

                    <div class="col-md-6">
                        <h6 class="text-success">Vital Signs</h6>

                        <p><b>Systolic BP :</b> <?= $report->systolic_bp ?></p>
                        <p><b>Diastolic BP :</b> <?= $report->diastolic_bp ?></p>
                        <p><b>Pulse :</b> <?= $report->pulse ?></p>
                        <p><b>SpO2 :</b> <?= $report->spo2 ?></p>
                        <p><b>Temperature :</b> <?= $report->temperature ?></p>

                    </div>


                    <div class="col-md-6">
                        <h6 class="text-success">Metabolic Indicators</h6>

                        <p><b>Metabolic Age :</b> <?= $report->metabolic_age ?></p>
                        <p><b>Basal Metabolic Age :</b> <?= $report->basal_metabolic_age ?></p>

                    </div>

                </div>

            </div>

            <!-- GP SCREENING -->
            <div class=" p-3 mt-4 report-section">

                <h5 class="text-center mb-3 section-title">GP Screening</h5>

                <div class="row">

                    <div class="col-md-6">

                        <h6 class="text-success">Stethoscope Screening</h6>

                        <p><b>Heart :</b> <?= $report->heart_status ?></p>
                        <p><b>Lung :</b> <?= $report->lung_status ?></p>
                        <p><b>Abdomen :</b> <?= $report->abdomen_status ?></p>

                    </div>


                    <div class="col-md-6">

                        <h6 class="text-success">Spirometry</h6>

                        <p><b>FEF :</b> <?= $report->fef ?></p>
                        <p><b>PEF :</b> <?= $report->pef ?></p>
                        <p><b>FEV1 :</b> <?= $report->fev1 ?></p>
                        <p><b>FEV6 :</b> <?= $report->fev6 ?></p>

                    </div>

                </div>

            </div>

            <!-- Specialty Screening  -->
            <div class=" p-3 mt-4 report-section">

                <h5 class="text-center mb-3 section-title">Specialty Screening</h5>

                <div class="row">

                    <div class="col-md-6">

                        <h6 class="text-success">Audiometry</h6>

                        <p><b>Otology Completed :</b> <?= $report->otology_completed ?></p>
                        <p><b>Provisional Diagnosis :</b> <?= $report->provisional_diagnosis ?></p>
                        <p><b>Diagnosis :</b> <?= $report->provisional_diagnosis ?></p>
                        <p><b>Symptoms :</b> <?= $report->symptoms ?></p>
                        <p><b>History :</b> <?= $report->history ?></p>

                        <h6 class="mt-3 text-success">Hearing Levels</h6>

                        <p><b>Left Ear 500Hz :</b> <?= $report->left_ear_500 ?></p>
                        <p><b>Right Ear 500Hz :</b> <?= $report->right_ear_500 ?></p>

                        <p><b>Left Ear 1k :</b> <?= $report->left_ear_1k ?></p>
                        <p><b>Right Ear 1k :</b> <?= $report->right_ear_1k ?></p>

                        <p><b>Left Ear 2k :</b> <?= $report->left_ear_2k ?></p>
                        <p><b>Right Ear 2k :</b> <?= $report->right_ear_2k ?></p>

                        <p><b>Left Ear 4k :</b> <?= $report->left_ear_4k ?></p>
                        <p><b>Right Ear 4k :</b> <?= $report->right_ear_4k ?></p>

                    </div>


                    <div class="col-md-6">

                        <h6 class="text-success">Ophthalmology</h6>

                        <p><b>Ocular Findings :</b> <?= $report->ocular_findings ?></p>
                        <p><b>External Eye Exam :</b> <?= $report->external_eye_exam ?></p>
                        <p><b>Refraction :</b> <?= $report->refraction ?></p>

                        <p><b>Visual Acuity RE :</b> <?= $report->va_re ?></p>
                        <p><b>Visual Acuity LE :</b> <?= $report->va_le ?></p>

                    </div>

                </div>

            </div>


            <!--Laboratory Investigations  -->
            <div class=" p-3 mt-4 report-section">

                <h5 class="text-center mb-3 section-title">Laboratory Investigations</h5>

                <div class="row">

                    <div class="col-md-6">

                        <p><b>Hemoglobin :</b> <?= $report->hemoglobin ?></p>
                        <p><b>Blood Sugar :</b> <?= $report->blood_sugar ?></p>
                        <p><b>HbA1c :</b> <?= $report->hba1c ?></p>
                        <p><b>Urine Routine :</b> <?= $report->urine_routine ?></p>

                    </div>


                    <div class="col-md-6">

                        <p><b>WBC Count :</b> <?= $report->wbc_count ?></p>
                        <p><b>Platelet Count :</b> <?= $report->platelet_count ?></p>
                        <p><b>ECG :</b> <?= $report->ecg ?></p>
                        <p><b>Chest X-Ray :</b> <?= $report->chest_x_ray ?></p>

                    </div>

                </div>

            </div>


            <!-- PRINT BUTTON -->
            <div class="text-right mt-4">

                <button onclick="window.print()" class="btn btn-primary">
                    Print Report
                </button>

            </div>


        </div>
    </div>
</div>