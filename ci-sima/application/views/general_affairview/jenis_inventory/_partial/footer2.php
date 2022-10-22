    <script src="<?php echo base_url() ?>assets/js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/jquery.validate.js"></script>
    <script>
        $( "#FormJenisInv" ).validate({
        rules: {
            idjenis_inventory:{
                required: true,
                maxlength: 5,
                minlength:3
            },
            jenis_inventory:{
                required:true
            }

        }
        });
    </script>


</body>

</html>
