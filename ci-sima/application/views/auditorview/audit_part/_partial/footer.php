<div class="footer fixed">
    <div class="pull-right">
        <div id="stat">
            <span class="label label-success"> <span class="text-info"><i class="fa fa-circle"></i></span> Online</span>
        </div>
    </div>
    <div>
        &copy; <Strong> Trio Motor</strong> 2020 - <?php echo date('Y'); ?>
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
                toastr.success('<?php echo $this->session->flashdata(
                    'berhasil'
                ); ?>', 'Status');

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
                toastr.error('<?php echo $this->session->flashdata(
                    'gagal'
                ); ?>', 'Status');

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
                toastr.warning('<?php echo $this->session->flashdata(
                    'warning'
                ); ?>', 'Status');

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
        // $('#audit_part').load("<?php echo base_url(); ?>transaksi_auditor/ajax_get_part");
        // $('#list_audit_part').load("<?php echo base_url(); ?>transaksi_auditor/ajax_get_part");
        $('#OptCabang').load("<?php echo base_url(); ?>transaksi_auditor/ajax_get_cabang2");

        // var id_cabang = ""
        // $('#OptCabang').load("<?php echo base_url(); ?>transaksi_auditor/ajax_get_cabang2");
        // //$('#OptJadwalAudit').load("<?php echo base_url(); ?>transaksi_auditor/ajax_get_jadwalaudit");
        // $('#OptCabang').change(function() {
        //     $('#OptJadwalAudit').load("<?php echo base_url(); ?>transaksi_auditor/ajax_get_jadwalaudit/" + $(this).val());
        // })

        function search() {
            var cabang = $('#Incabang').val();

            if (cabang != '') {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url(); ?>master_data/search_data_cabang",
                    data: "cabang=" + cabang,
                    success: function(data) {
                        $("#cabang").html(data);
                        $("#search").val("");
                    }
                });
            } else {
                $('#cabang').load("<?php echo base_url(); ?>master_data/ajax_get_cabang");
            }
        }
        $('#caribtn').click(function() {
            search();
        });
        $('#Incabang').keyup(function(e) {
            if (e.keyCode == 13) {
                search();
            }
        });


    });

    function edit(id) {
        // var id = $(this).attr('data-id');
        $.ajax({
            url: "<?php echo base_url() .
                $this->uri->segment(1); ?>/edit_cabang",
            type: 'post',
            data: "id=" + id,
            dataType: 'html',
            success: function(data) {
                $('#data_input').html(data);
            }

        });
    }


    function show() {
        $('#add').attr('disabled', true);
        var $url = "<?php echo $this->uri->segment(1); ?>";
        $.ajax({
            url: "<?php echo base_url() .
                $this->uri->segment(1); ?>/input_cabang",
            type: 'post',
            dataType: 'html',
            success: function(data) {
                $('#data_input').html(data);
            }

        })
    }

    function hide() {
        $('#add').attr('disabled', false);
        $('#data_input').html('');
    }
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

        $('#previewpart').click(function(e) {
            e.preventDefault();
            preview(1);
        });

        $(document).on('click', '.pagination li a', function(event) {
            event.preventDefault();
            var page = $(this).data('ci-pagination-page');
            preview(page);

        });

        function preview(page) {
            var cabang = $('#OptCabang').val();
            var idjadwal_audit = $('#OptJadwalAudit').val();
            var status = $('#status').val();
                        var kondisi = $('#kondisi').val();
            var action = 'previewpart';

            $('#audit_unit').html('<tr><td colspan="20" id="loading"></td></tr>');

            $.ajax({
                method: 'post',
                dataType: 'JSON',
                url: '<?php echo base_url(); ?>transaksi_auditor/previewpart/' + page,
                data: {
                    id_cabang: cabang,
                    idjadwal_audit: idjadwal_audit,
                    status: status,
                    kondisi: kondisi,
                    action: action
                },
                // data: 'id_cabang='+cabang+'&&tgl_awal='+tgl_awal+'&&tgl_akhir='+tgl_akhir+'&&status='+status+'&&pages='+valu,
                success: function(data) {

                    $('#audit_part').html(data.part_list);
                    $('#pagination').html(data.pagination_link);
                    $('#rows_entry').html(data.row_entry);

                }
            });
        }


    })

</script>

</body>

</html>