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

<!-- Mainly scripts -->
<script src="<?php echo base_url() ?>assets/js/jquery-3.1.1.min.js"></script>

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


<script>
    $(document).ready(function() {
        <?php if ($this->session->flashdata('berhasil')) { ?>
            setTimeout(function() {
                toastr.options = {
                    positionClass: 'toast-bottom-left',
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 4000
                };
                toastr.success('<?php echo $this->session->flashdata('berhasil') ?>', 'Status');

            }, 1300);
        <?php } ?>
        <?php if ($this->session->flashdata('gagal')) { ?>
            setTimeout(function() {
                toastr.options = {
                    positionClass: 'toast-bottom-left',
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 4000
                };
                toastr.error('<?php echo $this->session->flashdata('gagal') ?>', 'Status');

            }, 1300);
        <?php } ?>
        <?php if ($this->session->flashdata('warning')) { ?>
            setTimeout(function() {
                toastr.options = {
                    positionClass: 'toast-bottom-left',
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 4000
                };
                toastr.warning('<?php echo $this->session->flashdata('warning') ?>', 'Status');

            }, 1300);
        <?php } ?>
        $(document).idleTimer(10000);
    });

    $(document).on("idle.idleTimer", function(event, elem, obj) {
        document.getElementById("stat").innerHTML = "<span class='label label-danger'> <span class='text-warning'><i class='fa fa-circle'></i></span> Offline</span>";

    });

    $(document).on("active.idleTimer", function(event, elem, obj, triggerevent) {
        // function you want to fire when the user becomes active again
        document.getElementById("stat").innerHTML = "<span class='label label-success'> <span class='text-info'><i class='fa fa-circle'></i></span> Online</span>";
    });
</script>
<script>
    $(document).ready(function() {
        var id_cabang = ""
        $('#OptCabang').load("<?php echo base_url(); ?>transaksi_auditor/ajax_get_cabang2");
        //$('#OptJadwalAudit').load("<?php echo base_url(); ?>transaksi_auditor/ajax_get_jadwalaudit");
        $('#OptCabang').change(function() {
            $('#OptJadwalAudit').load("<?php echo base_url(); ?>transaksi_auditor/ajax_get_jadwalaudit/" + $(this).val());
        })


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

        $('#preview').click(function(e) {
            e.preventDefault();
            preview(1);
        });

        $(document).on('click', '.pagination li a', function(event) {
            event.preventDefault();
            var page = $(this).data('ci-pagination-page');
            preview(page);

        });

        $('#keterangan').change(function() {
            var tes = $(this).val();
            console.log(tes);

            if (tes == 'lainnya') {
                $('#keterangan_lainnya').removeClass('hidden');
            } else {
                $('#keterangan_lainnya').addClass('hidden');
            }
        });

        function preview(page) {
            var cabang = $('#OptCabang').val();
            var idjadwal_audit = $('#OptJadwalAudit').val();
            var status = $('#status').val();
            var action = 'preview';
            $('#audit_unit').html('<tr><td colspan="20" id="loading"></td></tr>');

            $.ajax({
                method: 'post',
                dataType: 'JSON',
                url: '<?php echo base_url() ?>transaksi_auditor/preview/' + page,
                data: {
                    id_cabang: cabang,
                    idjadwal_audit: idjadwal_audit,
                    status: status,
                    action: action
                },
                // data: 'id_cabang='+cabang+'&&tgl_awal='+tgl_awal+'&&tgl_akhir='+tgl_akhir+'&&status='+status+'&&pages='+valu,
                success: function(data) {

                    $('#audit_unit').html(data.unit_list);
                    $('#pagination').html(data.pagination_link);
                    $('#rows_entry').html(data.row_entry);

                }
            });
        }


    })



    // function preview() {

    //     var cabang = $('#OptCabang').val();
    //     var tgl_awal = $('#tgl_awal').val();
    //     var tgl_akhir = $('#tgl_akhir').val();
    //     var status = $('#status').val();

    //             console.log(cabang,tgl_awal,tgl_akhir,status);
    //     $.ajax({
    //         type: 'post',
    //         url :"<?php echo base_url() ?>transaksi_auditor/preview",
    //         data : 'id_cabang='+cabang+'&&tgl_awal='+tgl_awal+'&&tgl_akhir='+tgl_akhir+'&&status='+status,
    //         success: function (data)
    //         {
    //             $('#audit_unit').html(data);    

    //         }
    //     });

    // }
</script>

</body>

</html>