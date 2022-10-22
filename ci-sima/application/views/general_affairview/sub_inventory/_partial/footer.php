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
        // $('#sub_inv').load("<?php echo base_url() ?>master_data/ajax_get_sub_inv");
        get_data(1);

        function get_data(page) {
            $("#sub_inv").html('<tr> <td colspan="5" id="loading"> </td></tr>');

            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: "<?php echo base_url() ?>master_data/ajax_get_sub_inv/" + page,
                success: function(data) {
                    $("#sub_inv").html(data.output);
                    $("#pagination").html(data.pagination);
                }
            })
        }
        $(document).on('click', '.pagination li a', function(event) {
            event.preventDefault();
            var page = $(this).data('ci-pagination-page');
            var id = $('#cari').val();
            if (id) {
                search(page);
            } else {
                get_data(page);
            }
        });
        // $('#jenisinv').load("<?php echo base_url() ?>master_data/ajax_get_jenis_inv2");
        function search(page) {
            var id = $('#cari').val();
            $("#sub_inv").html('<tr> <td colspan="5" id="loading"> </td></tr>');


            if (id != '') {
                // $("#sub_inv").html(subinv);
                $.ajax({
                    type: "post",
                    dataType: 'JSON',
                    url: "<?php echo base_url() ?>master_data/search_data_subinventory/" + page,
                    data: "id=" + id,
                    success: function(data) {
                        $("#sub_inv").html(data.output);
                        $("#pagination").html(data.pagination);
                    }
                });
            } else {
                get_data(1);
            }
        }

        $('#caribtn').click(function() {
            search(1);
        });

        $('#cari').keyup(function(e) {
            if (e.keyCode == 13) {
                search(1);
            }
        });
    });

    function edit(id, jenis) {
        // var id = $(this).attr('data-id');
        $.ajax({
            url: "<?php echo base_url() . $this->uri->segment(1) ?>/edit_subinv",
            type: 'post',
            data: "id=" + id + "&jenis=" + jenis,
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
            url: "<?php echo base_url() . $this->uri->segment(1) ?>/input_subinv",
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