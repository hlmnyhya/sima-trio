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
    $("#FormLap").validate({
        rules: {
            tempat: {
                required: true
            },
            counter: {
                required: true
            },
            tgl_awal: {
                required: true
            },
            counter: {
                required: true
            },
            kacab: {
                required: true
            },
            id_cabang: {
                required: true
            },
            tgl_akhir: {
                required: true
            }

        }
    });
</script>

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
        // $('#audit_unit').load("<?php echo base_url() ?>transaksi_auditor/ajax_get_unit");
        $('#OptCabang').load("<?php echo base_url(); ?>laporan_auditor/ajax_get_cabang2");
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
            get_data(1);
            //     var cabang = $('#OptCabang').val();
            //     var tgl_awal = $('#tgl_awal').val();
            //     var tgl_akhir = $('#tgl_akhir').val();
            //     var status = $('#status').val();
            //     var getUrlParameter = function getUrlParameter(sParam) {
            //     var sPageURL = window.location.search.substring(1),
            //         sURLVariables = sPageURL.split('&'),
            //         sParameterName,
            //         i;

            //     for (i = 0; i < sURLVariables.length; i++) {
            //         sParameterName = sURLVariables[i].split('=');

            //         if (sParameterName[0] === sParam) {
            //             return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            //         }
            //     }
            // };

            //     var valu = getUrlParameter('pages');

            //     $.ajax({
            //         method: 'post',
            //         dataType:'JSON',
            //         url: '<?php echo base_url() ?>laporan_auditor/preview',
            //         data:{id_cabang: cabang, tgl_awal: tgl_awal, tgl_akhir: tgl_akhir, status: status, pages: valu},
            //         // data: 'id_cabang='+cabang+'&&tgl_awal='+tgl_awal+'&&tgl_akhir='+tgl_akhir+'&&status='+status+'&&pages='+valu,
            //         success:function(data){
            //             console.log(data.pagination_link);

            //         $('#unit').html(data.unit_list);
            //         $('#pagination').html(data.pagination_link);
            //         $('#pagination').html(data.pagination_link);

            //         }
            //     })

        });
        $(document).on('click', '.pagination li a', function(event) {
            event.preventDefault();
            var page = $(this).data('ci-pagination-page');
            get_data(page);

        });

        function get_data(page) {
            var cabang = $('#OptCabang').val();
            var idjadwal_audit = $('#OptJadwalAudit').val();
            var status = $('#status').val();
            var action = 'preview';
            $('#unit').html("<tr> <td id='loading' colspan='8'></td></tr>");

            $.ajax({
                method: 'post',
                dataType: 'JSON',
                url: '<?php echo base_url() ?>laporan_auditor/preview/' + page,
                data: {
                    id_cabang: cabang,
                    idjadwal_audit: idjadwal_audit,
                    status: status,
                    action: action
                },
                // data: 'id_cabang='+cabang+'&&tgl_awal='+tgl_awal+'&&tgl_akhir='+tgl_akhir+'&&status='+status+'&&pages='+valu,
                success: function(data) {
                    console.log(data);

                    $('#unit').html(data.unit_list);
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