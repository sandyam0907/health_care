</div> <!-- END main-wrapper -->
<style>
    .gov-footer {
        margin-top: auto;
    }
</style>
<!-- ===== FOOTER ===== -->
<div class="gov-footer d-flex justify-content-between">
    <span>© Government of Uttar Pradesh – Health Department</span>
    <span>Generated via Preventive Health IT Platform</span>
</div>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?= base_url() ?>assets/dist/js/bootstrap.bundle.min.js"></script>

<!-- DataTables -->
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<!-- For QR code -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

<script>

    function goToTab(dir) {
        let $active = $('.nav-tabs .nav-link.active');
        let $target = dir === 'next' ? $active.parent().next().find('.nav-link')
            : $active.parent().prev().find('.nav-link');
        if ($target.length) $target.tab('show');
    }

    $('.next-tab').click(() => goToTab('next'));
    $('.prev-tab').click(() => goToTab('prev'));
</script>

<!-- reports -->
<!-- <script>
    $(document).ready(function () {

        var table = $('#reportsTable').DataTable({

            processing: true,
            serverSide: true,

            ajax: {
                url: "<?= base_url('user/reports/reports_datatable_json') ?>",
                type: "POST",
                data: function (d) {

                    d.from_date = $('#from_date').val();
                    d.to_date = $('#to_date').val();
                    d.district = $('#district').val();
                    d.status = $('#status').val();
                    d.camp_type = $('#camp_type').val();
                    d.keyword = $('#keyword').val();

                    d[csrfName] = csrfHash;
                }
            },

            columnDefs: [
                {
                    targets: 7,
                    render: function (data, type, row) {

                        let reportId = row[0];

                        return `<div id="qr_${reportId}" class="qrbox"></div>`;
                    }
                }
            ],

            order: [[0, "desc"]],

            drawCallback: function (settings) {

                $('#reportsTable tbody tr').each(function () {

                    let reportId = $(this).find('td:eq(0)').text();

                    let qrDiv = document.getElementById("qr_" + reportId);

                    if (qrDiv) {

                        let url = "<?= base_url('user/reports/export_pdf/') ?>" + reportId;

                        console.log("QR URL:", url);

                        new QRCode(qrDiv, {
                            text: url,
                            width: 60,
                            height: 60
                        });

                    }

                });

                $(document).on('click', '.qr-btn', function () {
    let url = $(this).data('url');

    // Clear previous QR code
    $('#qrCode').html('');

    // Generate new QR code
    new QRCode(document.getElementById("qrCode"), {
        text: url,
        width: 260,
        height: 260
    });

    // Show modal
    $('#qrModal').modal('show');
});

            }


        });

        // APPLY FILTER
        $('.btn-primary').click(function () {

            table.ajax.reload();

        });


        // RESET FILTER
        $('.btn-outline-secondary').click(function () {

            $('#from_date').val('');
            $('#to_date').val('');
            $('#district').val('');
            $('#status').val('');
            $('#camp_type').val();
            $('#keyword').val();

            table.ajax.reload();

        });

    });

</script> -->

<script>
$(document).ready(function () {

    var table = $('#reportsTable').DataTable({

        processing: true,
        serverSide: true,

        ajax: {
            url: "<?= base_url('user/reports/reports_datatable_json') ?>",
            type: "POST",
            data: function (d) {

                d.from_date = $('#from_date').val();
                d.to_date = $('#to_date').val();
                d.district = $('#district').val();
                d.status = $('#status').val();
                d.camp_type = $('#camp_type').val();
                d.keyword = $('#keyword').val();

                d[csrfName] = csrfHash;
            }
        },

        order: [[0, "desc"]],

        columnDefs: [
            { targets: -1, orderable: false } // Disable sorting on Action column
        ]
    });

    // ✅ QR Code Button Click Event
    $(document).on('click', '.qr-btn', function () {
        let url = $(this).data('url');

         console.log("QR Code URL:", url);

        // Clear previous QR code
        $('#qrCode').html('');

        // Generate new QR code
        new QRCode(document.getElementById("qrCode"), {
            text: url,
            width: 260,
            height: 260
        });

        // Show modal
        $('#qrModal').modal('show');
    });

    // ✅ Apply Filter
    $('.btn-primary').click(function () {
        table.ajax.reload();
    });

    // ✅ Reset Filter
    $('.btn-outline-secondary').click(function () {
        $('#from_date').val('');
        $('#to_date').val('');
        $('#district').val('');
        $('#status').val('');
        $('#camp_type').val('');
        $('#keyword').val('');
        table.ajax.reload();
    });

});
</script>

<!-- dashboard -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(function () {

        //District Performance Card
        $('#districtPerformanceFilter').change(function () {
            let district = $(this).val();
            if (!district) {
                location.reload();
                return;
            }
            $.ajax({
                url: "<?= site_url('user/dashboard/get_district_card') ?>",
                type: "POST",
                data: {
                    district: district,
                    '<?= $this->security->get_csrf_token_name(); ?>': '<?= $this->security->get_csrf_hash(); ?>'
                },
                success: function (res) {
                    let data = JSON.parse(res);
                    if (data.length === 0) {
                        $('#districtPerformanceContainer').html(`<p class="text-center">No data found</p>`);
                        return;
                    }
                    let max = Math.max(...data.map(d => d.total));
                    let html = '';
                    data.forEach(d => {
                        let percent = (d.total / max) * 100;
                        html += `
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="small fw-bold">${d.district_name}</span>
                            <span class="small fw-bold text-district">${d.total}</span>
                        </div>
                        <div class="progress district-progress">
                            <div class="progress-bar bg-district" style="width:${percent}%"></div>
                        </div>
                    </div>
                `;
                    });

                    $('#districtPerformanceContainer').html(html);
                },
                error: function (xhr) {
                    console.error("Error:", xhr.responseText);
                }
            });
        });

        //  STATUS DISTRIBUTION (Pie)
        var statusCtx = document.getElementById('statusChart').getContext('2d');
        new Chart(statusCtx, {
            type: 'pie',
            data: {
                labels: [<?php foreach ($status_data as $s)
                    echo ($s->status == 1 ? '"Completed"' : '"Pending"') . ','; ?>],
                datasets: [{
                    data: [<?php foreach ($status_data as $s)
                        echo $s->total . ','; ?>],
                    backgroundColor: ['#28a745', '#ffc107']
                }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });

        // TOP DISTRICTS (Horizontal Bar)
        var districtCtx = document.getElementById('districtChart').getContext('2d');
        new Chart(districtCtx, {
            type: 'bar',
            data: {
                labels: [<?php foreach ($top_districts as $d)
                    echo '"' . $d->district_name . '",'; ?>],
                datasets: [{
                    label: 'Total Screenings',
                    data: [<?php foreach ($top_districts as $d)
                        echo $d->total . ','; ?>],
                    backgroundColor: '#1f518a'
                }]
            },
            options: {
                indexAxis: 'x', // Makes it horizontal
                plugins: { legend: { display: false } }
            }
        });

        // DAILY TREND (Line)
        var trendCtx = document.getElementById('trendChart').getContext('2d');
        new Chart(trendCtx, {
            type: 'line',
            data: {
                labels: [<?php foreach ($trend_data as $t)
                    echo '"' . date('M d', strtotime($t->date)) . '",'; ?>],
                datasets: [{
                    label: 'Daily Screenings',
                    data: [<?php foreach ($trend_data as $t)
                        echo $t->total . ','; ?>],
                    borderColor: '#1f518a',
                    backgroundColor: 'rgba(31, 81, 138, 0.1)',
                    fill: true,
                    tension: 0.3
                }]
            }
        });
        // GENDER DISTRIBUTION (Doughnut)
        var genderCtx = document.getElementById('genderChart').getContext('2d');
        new Chart(genderCtx, {
            type: 'doughnut',
            data: {
                labels: [<?php foreach ($gender_data as $g)
                    echo '"' . $g->gender . '",'; ?>],
                datasets: [{
                    data: [<?php foreach ($gender_data as $g)
                        echo $g->total . ','; ?>],
                    backgroundColor: ['#36a2eb', '#ff6384', '#ffcd56']
                }]
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom' } } }
        });

        // AGE GROUP DISTRIBUTION (Bar)
        var ageCtx = document.getElementById('ageChart').getContext('2d');
        new Chart(ageCtx, {
            type: 'bar',
            data: {
                labels: [<?php foreach ($age_data as $a)
                    echo '"' . $a->age_group . '",'; ?>],
                datasets: [{
                    label: 'Total Patients',
                    data: [<?php foreach ($age_data as $a)
                        echo $a->total . ','; ?>],
                    backgroundColor: '#4bc0c0'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } }
            }
        });

        // filter button
        $('.btn-primary').click(function () {

            let from_date = $('#from_date').val();
            let to_date = $('#to_date').val();
            let district = $('#district').val();
            let status = $('#status').val();
            let camp_type = $('#camp_type').val();

            let url = "?from_date=" + from_date +
                "&to_date=" + to_date +
                "&district=" + district +
                "&status=" + status +
                "&camp_type=" + camp_type;

            window.location.href = url;
        });

        // Reset button
        $('.reset-btn').click(function () {
            window.location.href = window.location.pathname;
        });
    });
</script>


</body>

</html>