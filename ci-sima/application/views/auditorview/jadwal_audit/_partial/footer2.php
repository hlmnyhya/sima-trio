    <script src="<?php echo base_url() ?>assets/js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/jquery.validate.js"></script>
    <script>
        $('#Optcabang').load("<?php echo base_url() ?>audit/ajax_get_cabang2");
        $('#Optjenisaudit').load("<?php echo base_url(); ?>audit/ajax_get_jenis_audit2");
        $('#auditor').load("<?php echo base_url(); ?>audit/ajax_get_auditor");
        $("#FormJadwalAudit").validate({
            rules: {
                idjadwal_audit: {
                    required: true,
                    minlength: 3
                },
                idjenis_audit: {
                    required: true
                },
                auditor: {
                    required: true
                },
                tanggal: {
                    required: true
                },
                waktu: {
                    required: true
                },
                id_cabang: {
                    required: true
                }

            }


        });
    </script>
    <script>
        $(document).ready(function() {
            $('#data_1 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });

            $('.clockpicker').clockpicker();
        })
    </script>
    <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?php echo base_url() ?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <!-- Idle Timer plugin -->
    <script src="<?php echo base_url() ?>assets/js/plugins/idle-timer/idle-timer.min.js"></script>
    <!-- Custom and plugin javascript -->
    <script src="<?php echo base_url() ?>assets/js/inspinia.js"></script>
    <script src="<?php echo base_url() ?>assets/js/plugins/pace/pace.min.js"></script>

    <script src="<?php echo base_url() ?>assets/js/plugins/toastr/toastr.min.js"></script>

    <script src="<?php echo base_url() ?>assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>

    <script src="<?php echo base_url() ?>assets/js/plugins/clockpicker/clockpicker.js"></script>

    </body>

    </html>