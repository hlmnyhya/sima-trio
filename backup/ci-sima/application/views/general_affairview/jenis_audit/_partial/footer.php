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
        // $('#jenis_audit').load("<?php echo base_url() ?>master_data/ajax_get_jenis_audit");
        get_data();

        function get_data() {
            $("#jenis_audit").html('<tr> <td colspan="10" id="loading"> </td></tr>');

            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: "<?php echo base_url() ?>master_data/ajax_get_jenis_audit",
                success: function(data) {
                    $("#jenis_audit").html(data);
                }
            })
        }

        function search() {
            var jenisaudit = $('#Injenisaudit').val();
            $("#jenis_audit").html('<tr> <td colspan="10" id="loading"> </td></tr>');

            if (jenisaudit != '') {
                $.ajax({
                    type: "post",
                    dataType: 'JSON',
                    url: "<?php echo base_url() ?>master_data/search_data_jenisaudit",
                    data: "jenisaudit=" + jenisaudit,
                    success: function(data) {
                        $("#jenis_audit").html(data);
                        $("#search").val("");
                    }
                });
            } else {

                get_data();
            }
        }
        $('#caribtn').click(function() {
            search();
        });
        $('#Injenisaudit').keyup(function(e) {
            if (e.keyCode == 13) {
                search();
            }
        });

    });

    function edit(id) {
        // var id = $(this).attr('data-id');
        // $('#data_input').html("<?php echo base_url() ?>jenis_audit/ajax_get_jenis_audit");

        $.ajax({
            url: "<?php echo base_url() . $this->uri->segment(1) ?>/edit_jenisaudit",
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
        var $url = "<?php echo $this->uri->segment(1) ?>";
        $.ajax({
            url: "<?php echo base_url() . $this->uri->segment(1) ?>/input_jenisaudit",
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

</body>

</html>