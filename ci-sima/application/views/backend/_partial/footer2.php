</div>

</div>

<!-- Mainly scripts -->
<script src="<?php echo base_url() ?>assets/js/jquery-3.1.1.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery.validate.js"></script>
<script>
    $("#FormUserAkses").validate({
        rules: {
            usergroup: {
                required: true
            },
            menu: {
                required: true
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
        usergroup();
        menu();
        // $('#Optusergroup').load("<?php echo base_url(); ?>menu/ajax_get_usergroup2");

        function usergroup() {
            $('#load1').html('<span class="loading dots"></span>');

            $.ajax({
                type: 'POST',
                url: "<?php echo base_url(); ?>menu/ajax_get_usergroup2",
                // dataType: 'JSON',
                success: function(data) {
                    // console.log(data);
                    $('#load1').html('');

                    $('#Optusergroup1').html(data);
                }
            })
        }

        function menu() {
            $('#load2').html('<span class="loading dots"></span>');
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url(); ?>menu/ajax_get_menuakses2",
                // dataType: 'JSON',
                success: function(data) {
                    // console.log(data);
                    $('#load2').html('');
                    $('#Optmenu1').html(data);
                }
            })
        }
        $('#caribtn').click(function() {
            rule();
        })
    });

    function hide() {
        $('#add').attr('disabled', false);
        $('#data_input').html('');
    }
</script>

</body>

</html>