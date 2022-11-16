<div class="footer fixed">
    <div class="pull-right">
        <div id="stat">
            <span class="label label-success"> <span class="text-info"><i class="fa fa-circle"></i></span> Online</span>
        </div>
    </div>
    <div>
        &copy; <Strong> Trio Motor</strong> 2020 - <?php echo date("Y"); ?>
    </div>
</div>

</div>

<script src="<?php echo base_url() ?>assets/js/jquery-3.1.1.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<!-- Upload js-->
<script src="<?php echo base_url() ?>assets/js/plugins/jasny/jasny-bootstrap.min.js"></script>
<!-- Idle Timer plugin -->
<script src="<?php echo base_url() ?>assets/js/plugins/idle-timer/idle-timer.min.js"></script>
<!-- Custom and plugin javascript -->
<script src="<?php echo base_url() ?>assets/js/inspinia.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/pace/pace.min.js"></script>

<script src="<?php echo base_url() ?>assets/js/plugins/toastr/toastr.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery.validate.js"></script>
<script>
    $(document).ready(function() {
        $('#OptCabang').load("<?php echo base_url(); ?>laporan_auditor/ajax_get_cabang2");
        $('#OptCabang').change(function() {
            $('#OptJadwalAudit').load("<?php echo base_url(); ?>transaksi_auditor/ajax_get_jadwalaudit/" + $(this).val());
        })

        $('#preview').click(function(e) {
            e.preventDefault();
            get_data(1);

        });
        $('#data_1 .input-group.date').datepicker({
            format: 'mm/dd/yyyy',
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });

        $('#data_5 .input-daterange').datepicker({
            format: 'mm/dd/yyyy',
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true
        });
        $(document).on('click', '.pagination li a', function(event) {
            event.preventDefault();
            var page = $(this).data('ci-pagination-page');
            get_data(page);

        });

        function get_data(page) {
            var cabang = $('#OptCabang').val();
            var idjadwal_audit = $('#OptJadwalAudit').val();
            $('#aksesoris').html('<tr><td colspan="13" id="loading"></td></tr>');

            $.ajax({
                method: 'post',
                dataType: 'JSON',
                url: '<?php echo base_url() ?>laporan_auditor/prevaksesoris/' + page,
                data: {
                    id_cabang: cabang,
                    idjadwal_audit: idjadwal_audit,
                },
                // data: 'id_cabang='+cabang+'&&tgl_awal='+tgl_awal+'&&tgl_akhir='+tgl_akhir+'&&status='+status+'&&pages='+valu,
                success: function(data) {
                    console.log(data);

                    $('#aksesoris').html(data.aksesoris);
                    $('#pagination').html(data.pagination_link);
                    $('#rows_entry').html(data.row_entry);

                }
            });
        }
        $('#dataPreview').click(function(e) {
            e.preventDefault();
            get_data(1);
        });
        $('#open').click(function(e) {
            e.preventDefault();
            $('#change').toggleClass('hidden form-group');
            $('#open').toggleClass('xshow hidden');
            $('#OptCabang').attr('readonly', true);
            $('#tgl_awal').attr('readonly', true);
            $('#tgl_akhir').attr('readonly', true);

        });
        $('#cancel').click(function(e) {
            e.preventDefault();
            $('#change').toggleClass('form-group hidden');
            $('#open').toggleClass('hidden xshow');
            $('#OptCabang').attr('readonly', false);
            $('#tgl_awal').attr('readonly', false);
            $('#tgl_akhir').attr('readonly', false);

        })
    });
</script>


</body>

</html>