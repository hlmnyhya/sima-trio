    <script src="<?php echo base_url() ?>assets/js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/jquery.validate.js"></script>
    <script>
        $( "#FormJenisAudit" ).validate({
        rules: {
            idjenis_audit:{
                required: true,
                maxlength: 5,
                minlength:3
            },
            jenis_audit:{
                required:true
            }

        }
        });
    </script>


</body>

</html>
