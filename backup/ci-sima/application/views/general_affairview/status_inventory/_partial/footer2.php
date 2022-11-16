    <script src="<?php echo base_url() ?>assets/js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/jquery.validate.js"></script>
    <script>
        $( "#FormStatusInv" ).validate({
        rules: {
            idstatus_inventory:{
                required: true,
                maxlength: 5,
                minlength:3
            },
            status_inventory:{
                required:true
            }

        }
        });
    </script>


</body>

</html>
