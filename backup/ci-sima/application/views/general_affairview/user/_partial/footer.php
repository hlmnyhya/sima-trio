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
<script>
    $("#FormUser").validate({
        rules: {
            nik: {
                required: true,
                minlength: 8
            },
            username: {
                required: true,
                minlength: 5
            },
            nama: "required",
            usergroup: "required",
            divisi: "required",
            status: "required",
            password: {
                required: true,
                minlength: 6
            },
            confirm_password: {
                equalTo: "#password"
            }

        }
    });
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
    $(document).ready(function() {

        // setTimeout(function() {
        //     toastr.options = {
        //         positionClass: 'toast-bottom-left',
        //         closeButton: true,
        //         progressBar: true,
        //         showMethod: 'slideDown',
        //         timeOut: 4000
        //     }; 
        // //     toastr.success('Selamat Datang Username', 'Login berhasil');

        // }, 1300);
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
        // $('#user').load("<?php echo base_url(); ?>master_data/ajax_get_user");
        // $('#user').load("<?php echo base_url(); ?>master_data/ajax_get_user");
        $('#Optusergroup').load("<?php echo base_url(); ?>master_data/ajax_get_usergroup2");
        $('#Optperusahaan').load("<?php echo base_url(); ?>master_data/ajax_get_perusahaan2");
        $('#Optcabang').load("<?php echo base_url(); ?>master_data/ajax_get_cabang2/");

        $('#Optcabang').on('change', function() {
            var id_cabang = $(this).val();
            if (id_cabang == "") {
                $('#Optlokasi').prop('disabled', true);
            } else {
                $('#Optlokasi').prop('disabled', false);
                $.ajax({
                    url: "<?php echo base_url(); ?>master_data/ajax_get_lokasi2",
                    type: "POST",
                    data: {
                        'id_cabang': id_cabang
                    },
                    success: function(data) {
                        $('#Optlokasi').html(data);
                    }
                });
            }
        })

        get_data(1);

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

        function get_data(page) {
            $("#user").html('<tr> <td colspan="10" id="loading"> </td></tr>');
            $('#pagination').html('');
            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: "<?php echo base_url(); ?>master_data/ajax_get_user/" + page,
                success: function(data) {
                    console.log(data);

                    $('#user').html(data.output);
                    $('#pagination').html(data.pagination);
                }
            });
        }

        function search(page) {
            var id = $('#cari').val();
            $("#user").html('<tr> <td colspan="10" id="loading"> </td></tr>');
            $('#pagination').html('');

            console.log(id);

            if (id != '') {
                $.ajax({
                    type: "post",
                    dataType: 'JSON',
                    url: "<?php echo base_url() ?>master_data/search_data_user/" + page,
                    data: {
                        id: id
                    },
                    success: function(data) {
                        $("#user").html(data.output);
                        $("#pagination").html(data.pagination);
                        $("#search").val("");
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
        $('#btn-reset').click(function(e) {
            e.preventDefault();
            $('#password').attr('disabled', false);
            $('#confirm').toggleClass('hidden form-group');
        });
    });
</script>

</body>

</html>