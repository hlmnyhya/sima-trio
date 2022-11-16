    <script src="<?php echo base_url() ?>assets/js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/jquery.validate.js"></script>
    <script>
        $( "#FormUsergroup" ).validate({
        rules: {
            id_usergroup:{
                required: true,
                maxlength: 5,
                minlength:5
            },
            user_group:{
                required:true
            }

        }
        });
    </script>


</body>

</html>
