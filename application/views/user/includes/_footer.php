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

</script>


</body>

</html>