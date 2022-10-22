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

<script src="<?php echo base_url() ?>assets/js/plugins/iCheck/icheck.min.js"></script>
<script>
    $(document).ready(function() {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });
</script>
<script>
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
        $('#user').load("<?php echo base_url(); ?>master_data/ajax_get_user");
        $('#Optusergroup').load("<?php echo base_url(); ?>master_data/ajax_get_usergroup2/<?php echo $usergroup ?>");
        $('#Optperusahaan').load("<?php echo base_url(); ?>master_data/ajax_get_perusahaan2/<?php echo $perusahaan ?>");
        $('#Optcabang').load("<?php echo base_url(); ?>master_data/ajax_get_cabang2/<?php echo $cabang ?>");
        var id_cabang = "<?php echo $cabang ?>";
        if (id_cabang == "") {
            $('#Optlokasi').prop('disabled', true);
        } else {
            $('#Optlokasi').prop('disabled', false);
            var lokasi = "<?php echo  $lokasi ?>";
            $.ajax({
                url: "<?php echo base_url(); ?>master_data/ajax_get_lokasi2",
                type: "POST",
                data: {
                    'id_cabang': id_cabang,
                    id_lokasi: lokasi
                },
                success: function(data) {
                    $('#Optlokasi').html(data);
                }
            });
        }
        $('#Optcabang').on('change', function() {
            var id_cabang = $(this).val();
            var id_lokasi = '<?php echo $lokasi ?>';
            if (id_cabang == "") {
                $('#Optlokasi').prop('disabled', true);
            } else {
                $('#Optlokasi').prop('disabled', false);
                $.ajax({
                    url: "<?php echo base_url(); ?>master_data/ajax_get_lokasi2",
                    type: "POST",
                    data: {
                        'id_cabang': id_cabang,
                        'id_lokasi': id_lokasi
                    },
                    success: function(data) {
                        $('#Optlokasi').html(data);
                    }
                });
            }
        })
        $('#btn-reset').click(function(e) {
            e.preventDefault();
            $('#password').attr('disabled', false);
            $('#confirm').toggleClass('hidden form-group');
        });
    });
</script>

</body>

</html>