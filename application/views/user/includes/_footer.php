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
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.responsive.min.js"></script>

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

            responsive: true,
            processing: true,
            serverSide: true,
            searching: false,

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


                    d[csrfName] = csrfHash; // CSRF TOKEN

                }
            },

            order: [[0, "desc"]]

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