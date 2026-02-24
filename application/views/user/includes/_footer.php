 <!-- ===== FOOTER ===== -->
    <div class="gov-footer d-flex justify-content-between">
        <span>© Government of Uttar Pradesh – Health Department</span>
        <span>Generated via Preventive Health IT Platform</span>
    </div>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?= base_url()?>assets/dist/js/bootstrap.bundle.min.js"></script>

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


</body>

</html>