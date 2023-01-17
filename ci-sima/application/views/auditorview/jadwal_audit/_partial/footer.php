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
<script src="<?php echo base_url() ?>assets/js/jquery.validate.js"></script>
<script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/moment.js"></script>
<script src="<?php echo base_url() ?>assets/js/moment-with-locales.js"></script>
<script src="<?php echo base_url() ?>assets/js/moment-timezone-with-data.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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

<script>
    window.onunload = refreshParent;

    function refreshParent() {
        window.opener.location.reload();
    }
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
        get_data(1);
        // $('#list_jadwal_audit').load("<?php echo base_url(); ?>audit/ajax_get_jadwal_audit");  
        $('#Optjenisaudit').load("<?php echo base_url(); ?>audit/ajax_get_jenis_audit2");
        $('#audit_part').load("<?php echo base_url() ?>transaksi_auditor/ajax_get_part");
        $('#OptCabang').load("<?php echo base_url() ?>audit/ajax_get_cabang2");
        function timezone(){
   var time = document.getElementById('zone').value;
   document.getElementById('waktu').value = time;
   }

   get_data(1);

   
        $(document).on('click', '.pagination li a', function(event) {
            event.preventDefault();
            var page = $(this).data('ci-pagination-page');
            get_data(page);
        });
        

        function get_data(page) {
            $('#list_jadwal_audit').html('<tr><td colspan="13" class="text-center" id="loading"></td></tr>');
            $.ajax({
                type: 'post',
                dataType: 'JSON',
                url: "<?php echo base_url() ?>audit/ajax_get_jadwal_audit/" + page,
                success: function(res) {
                    console.log(res);
                    $('#list_jadwal_audit').html(res.output);
                    $('#pagination').html(res.pagination);
                    $('#rows_entry').html(res.row_entry);
                }
            });
        }
        $('#data_1 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });

        $('.clockpicker').clockpicker();

        function search() {
            var audit = $('#jdwal').val();
            $('#list_jadwal_audit').html('<tr><td colspan="13" class="text-center" id="loading"></td></tr>');

            if (audit != '') {
                $.ajax({
                    type: "post",
                    dataType: 'JSON',
                    url: "<?php echo base_url() ?>audit/search_audit",
                    data: "id=" + audit,
                    success: function(data) {
                        $('#list_jadwal_audit').html(data);
                        $('#pagination').html('');
                        $("#search").val("");
                    }
                });
            } else {
                get_data(page);
            }
        }
        $('#caribtn').click(function() {
            search();
        });

    });
    $("#tz").html(moment().format('MMMM Do YYYY, h:mm:ss a'))
</script>
<script>
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
<script type="text/javascript">
   function timezone(){
   var time = document.getElementById('zone').value;
   document.getElementById('waktu').value = time;
   }
</script>
</body>

</html>