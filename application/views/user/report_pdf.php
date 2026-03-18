<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <style>
        /* PDF Global Settings */
        @page {
            margin: 40px;
        }

        body {
            font-family: 'Helvetica', sans-serif;
            font-size: 9px;
            /* Reduced for better fit */
            color: #333;
            line-height: 1.2;
        }

        /* Prevent large gaps: Allow tables to break across pages */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 6px;
            page-break-inside: auto;
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }

        .header-table {
            width: 100%;
            border-bottom: 2px solid #1f4e79;
            margin-bottom: 10px;
            padding-bottom: 5px;
        }

        .report-title {
            color: #1f4e79;
            font-size: 16px;
            font-weight: bold;
        }

        .report-badge {
            background: #1f4e79;
            color: white;
            padding: 3px 6px;
            border-radius: 4px;
            font-size: 10px;
        }

        .section-title {
            background: #f7f7f7;
            border: 1px solid #ddd;
            padding: 4px;
            font-weight: bold;
            color: #1f4e79;
            text-align: center;
            margin: 10px 0 5px 0;
            border-radius: 4px;
            text-transform: uppercase;
            font-size: 10px;
        }

        .sub-title {
            color: #28a745;
            font-weight: bold;
            border-bottom: 1px solid #eee;
            margin-bottom: 4px;
            padding-bottom: 2px;
            font-size: 10px;
        }

        .data-table td {
            border: 1px solid #eee;
            padding: 4px;
            /* Tighter padding to save space */
            vertical-align: top;
        }

        .label {
            font-weight: bold;
            color: #555;
            width: 40%;
            background-color: #fafafa;
        }

        .col {
            width: 48%;
            vertical-align: top;
        }

        .spacer {
            width: 4%;
        }

        .footer {
            position: fixed;
            bottom: -20px;
            width: 100%;
            text-align: center;
            font-size: 8px;
            color: #999;
            border-top: 1px solid #eee;
            padding-top: 5px;
        }
    </style>
</head>

<body>

    <table class="header-table">
        <tr>
            <td><span class="report-title">Patient Health Report</span></td>
            <td style="text-align: right;"><span class="report-badge">Report ID:
                    <?= $report->report_id ?? 'NA' ?></span></td>
        </tr>
    </table>

    <table>
        <tr>
            <td class="col">
                <div class="sub-title">Patient Details</div>
                <table class="data-table">
                    <tr>
                        <td class="label">First Name</td>
                        <td><?= $report->first_name ?? 'NA' ?></td>
                    </tr>
                    <tr>
                        <td class="label">Last Name</td>
                        <td><?= $report->last_name ?? 'NA' ?></td>
                    </tr>
                    <tr>
                        <td class="label">Age</td>
                        <td><?= $report->age ?? 'NA' ?></td>
                    </tr>
                    <tr>
                        <td class="label">Gender</td>
                        <td><?= $report->gender ?? 'NA' ?></td>
                    </tr>
                    <tr>
                        <td class="label">Mobile</td>
                        <td><?= $report->mobile ?? 'NA' ?></td>
                    </tr>
                </table>
            </td>
            <td class="spacer"></td>
            <td class="col">
                <div class="sub-title">Camp Details</div>
                <table class="data-table">
                    <tr>
                        <td class="label">Camp Name</td>
                        <td><?= $report->project_name ?? 'NA' ?></td>
                    </tr>
                    <tr>
                        <td class="label">Date</td>
                        <td><?= !empty($report->camp_date) ? date('d-m-Y', strtotime($report->camp_date)) : 'NA' ?></td>
                    </tr>
                    <tr>
                        <td class="label">Location</td>
                        <td><?= $report->location ?? 'NA' ?></td>
                    </tr>
                    <tr>
                        <td class="label">District</td>
                        <td><?= $report->district_name ?? 'NA' ?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <div class="section-title">General Check</div>
    <table>
        <tr>
            <td class="col">
                <div class="sub-title">Measurements & Composition</div>
                <table class="data-table">
                    <tr>
                        <td class="label">Height</td>
                        <td><?= $report->height ?? 'NA' ?></td>
                    </tr>
                    <tr>
                        <td class="label">Weight</td>
                        <td><?= $report->weight ?? 'NA' ?></td>
                    </tr>
                    <tr>
                        <td class="label">BMI</td>
                        <td><?= $report->bmi ?? 'NA' ?></td>
                    </tr>
                    <tr>
                        <td class="label">Hydration</td>
                        <td><?= $report->hydration ?? 'NA' ?></td>
                    </tr>
                    <tr>
                        <td class="label">Fat</td>
                        <td><?= $report->fat ?? 'NA' ?></td>
                    </tr>
                    <tr>
                        <td class="label">Bone Mass</td>
                        <td><?= $report->bonemass ?? 'NA' ?></td>
                    </tr>
                    <tr>
                        <td class="label">Muscle</td>
                        <td><?= $report->muscle ?? 'NA' ?></td>
                    </tr>
                    <tr>
                        <td class="label">Vfat</td>
                        <td><?= $report->vfat ?? 'NA' ?></td>
                    </tr>
                </table>
            </td>
            <td class="spacer"></td>
            <td class="col">
                <div class="sub-title">Vital Signs & Metabolic</div>
                <table class="data-table">
                    <tr>
                        <td class="label">Systolic BP</td>
                        <td><?= $report->systolic_bp ?? 'NA' ?></td>
                    </tr>
                    <tr>
                        <td class="label">Diastolic BP</td>
                        <td><?= $report->diastolic_bp ?? 'NA' ?></td>
                    </tr>
                    <tr>
                        <td class="label">Pulse</td>
                        <td><?= $report->pulse ?? 'NA' ?></td>
                    </tr>
                    <tr>
                        <td class="label">SpO2</td>
                        <td><?= $report->spo2 ?? 'NA' ?></td>
                    </tr>
                    <tr>
                        <td class="label">Temperature</td>
                        <td><?= $report->temperature ?? 'NA' ?></td>
                    </tr>
                    <tr>
                        <td class="label">Metabolic Age</td>
                        <td><?= $report->metabolic_age ?? 'NA' ?></td>
                    </tr>
                    <tr>
                        <td class="label">Basal Met. Age</td>
                        <td><?= $report->basal_metabolic_age ?? 'NA' ?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <div class="section-title">GP Screening</div>
    <table>
        <tr>
            <td class="col">
                <div class="sub-title">Stethoscope Screening</div>
                <table class="data-table">
                    <tr>
                        <td class="label">Heart Status</td>
                        <td><?= $report->heart_status ?? 'NA' ?></td>
                    </tr>
                    <tr>
                        <td class="label">Lung Status</td>
                        <td><?= $report->lung_status ?? 'NA' ?></td>
                    </tr>
                    <tr>
                        <td class="label">Abdomen Status</td>
                        <td><?= $report->abdomen_status ?? 'NA' ?></td>
                    </tr>
                </table>
            </td>
            <td class="spacer"></td>
            <td class="col">
                <div class="sub-title">Spirometry</div>
                <table class="data-table">
                    <tr>
                        <td class="label">FEF</td>
                        <td><?= $report->fef ?? 'NA' ?></td>
                    </tr>
                    <tr>
                        <td class="label">PEF</td>
                        <td><?= $report->pef ?? 'NA' ?></td>
                    </tr>
                    <tr>
                        <td class="label">FEV1</td>
                        <td><?= $report->fev1 ?? 'NA' ?></td>
                    </tr>
                    <tr>
                        <td class="label">FEV6</td>
                        <td><?= $report->fev6 ?? 'NA' ?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <div class="section-title">Specialty Screening</div>
    <table>
        <tr>
            <td class="col">
                <div class="sub-title">Audiometry</div>
                <table class="data-table">
                    <tr>
                        <td class="label">Otology</td>
                        <td><?= $report->otology_completed ?? 'NA' ?></td>
                    </tr>
                    <tr>
                        <td class="label">Diagnosis</td>
                        <td><?= $report->provisional_diagnosis ?? 'NA' ?></td>
                    </tr>
                    <tr>
                        <td class="label">Symptoms</td>
                        <td><?= $report->symptoms ?? 'NA' ?></td>
                    </tr>
                    <tr>
                        <td class="label">History</td>
                        <td><?= $report->history ?? 'NA' ?></td>
                    </tr>
                    <tr>
                        <td class="label">L-Ear 500Hz / 1k</td>
                        <td><?= $report->left_ear_500 ?? 'NA' ?> / <?= $report->left_ear_1k ?? 'NA' ?></td>
                    </tr>
                    <tr>
                        <td class="label">L-Ear 2k / 4k</td>
                        <td><?= $report->left_ear_2k ?? 'NA' ?> / <?= $report->left_ear_4k ?? 'NA' ?></td>
                    </tr>
                    <tr>
                        <td class="label">R-Ear 500Hz / 1k</td>
                        <td><?= $report->right_ear_500 ?? 'NA' ?> / <?= $report->right_ear_1k ?? 'NA' ?></td>
                    </tr>
                    <tr>
                        <td class="label">R-Ear 2k / 4k</td>
                        <td><?= $report->right_ear_2k ?? 'NA' ?> / <?= $report->right_ear_4k ?? 'NA' ?></td>
                    </tr>
                </table>
            </td>
            <td class="spacer"></td>
            <td class="col">
                <div class="sub-title">Ophthalmology</div>
                <table class="data-table">
                    <tr>
                        <td class="label">Ocular Findings</td>
                        <td><?= $report->ocular_findings ?? 'NA' ?></td>
                    </tr>
                    <tr>
                        <td class="label">External Exam</td>
                        <td><?= $report->external_eye_exam ?? 'NA' ?></td>
                    </tr>
                    <tr>
                        <td class="label">Refraction</td>
                        <td><?= $report->refraction ?? 'NA' ?></td>
                    </tr>
                    <tr>
                        <td class="label">Visual Acuity RE</td>
                        <td><?= $report->va_re ?? 'NA' ?></td>
                    </tr>
                    <tr>
                        <td class="label">Visual Acuity LE</td>
                        <td><?= $report->va_le ?? 'NA' ?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <div class="section-title">Laboratory Investigations</div>
    <table class="data-table">
        <tr>
            <td class="label">Hemoglobin</td>
            <td><?= $report->hemoglobin ?? 'NA' ?></td>
            <td class="label">Blood Sugar</td>
            <td><?= $report->blood_sugar ?? 'NA' ?></td>
        </tr>
        <tr>
            <td class="label">HbA1c</td>
            <td><?= $report->hba1c ?? 'NA' ?></td>
            <td class="label">Urine Routine</td>
            <td><?= $report->urine_routine ?? 'NA' ?></td>
        </tr>
        <tr>
            <td class="label">WBC Count</td>
            <td><?= $report->wbc_count ?? 'NA' ?></td>
            <td class="label">Platelet Count</td>
            <td><?= $report->platelet_count ?? 'NA' ?></td>
        </tr>
        <tr>
            <td class="label">ECG</td>
            <td><?= $report->ecg ?? 'NA' ?></td>
            <td class="label">Chest X-Ray</td>
            <td><?= $report->chest_x_ray ?? 'NA' ?></td>
        </tr>
    </table>

    <div class="footer">
        Generated on <?= date('d-m-Y H:i') ?> | Digital Health Record
    </div>
</body>

</html>