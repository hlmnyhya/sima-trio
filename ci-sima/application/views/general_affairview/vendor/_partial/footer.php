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
        // $('#vendor').load("<?php echo base_url() ?>master_data/ajax_get_vendor");
        get_data(1);
        $(document).on('click', '.pagination li a', function(event) {
            event.preventDefault();
            var page = $(this).data('ci-pagination-page');
            var vendor = $('#Invendor').val();
            if (vendor) {
                search(page);
            } else {
                get_data(page);
            }
        });

        function get_data(page) {
            $("#vendor").html('<tr> <td colspan="10" id="loading"> </td></tr>');

            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: "<?php echo base_url() ?>master_data/ajax_get_vendor/" + page,
                success: function(data) {
                    $("#vendor").html(data.output);
                    $("#pagination").html(data.pagination);
                }
            })
        }

        function search(page) {
            var vendor = $('#Invendor').val();
            $("#vendor").html('<tr> <td colspan="10" id="loading"> </td></tr>');

            if (vendor != '') {
                $.ajax({
                    type: "post",
                    dataType: 'JSON',
                    url: "<?php echo base_url() ?>master_data/search_data_vendor/" + page,
                    data: "vendor=" + vendor,
                    success: function(data) {
                        $("#vendor").html(data.output);
                        $("#pagination").html(data.pagination);
                        $("#search").val("");
                    }
                });
            } else {
                get_data();
            }
        }
        $('#caribtn').click(function() {
            search(1);
        });
        $('#Invendor').keyup(function(e) {
            if (e.keyCode == 13) {
                search(1);
            }
        });


    });

    function edit(id) {
        // var id = $(this).attr('data-id');
        $.ajax({
            url: "<?php echo base_url() . $this->uri->segment(1) ?>/edit_vendor",
            type: 'get',
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
            url: "<?php echo base_url() . $this->uri->segment(1) ?>/input_vendor",
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

    function load_data(page) {
        $.ajax({
            url: "<?php echo base_url() ?>master_data/ajax_get_vendor",
            method: "POST",
            dataType: "json",
            success: function(data) {
                $('#country_table').html(data.country_table);
                $('#pagination_link').html(data.pagination_link);
            }
        });
    }

    load_country_data(1);
</script>

</body>

</html>