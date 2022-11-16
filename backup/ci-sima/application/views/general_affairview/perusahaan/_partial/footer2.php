    <script src="<?php echo base_url() ?>assets/js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/jquery.validate.js"></script>
    <script>
        $( "#FormPerusahaan" ).validate({
        rules: {
            id_perusahaan:{
                required: true,
                maxlength: 5,
                minlength:3
            },
            nama_perusahaan:{
                required:true
            }

        }
        });
    </script>


</body>

</html>
