    <script src="<?php echo base_url() ?>assets/js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/jquery.validate.js"></script>
    <script>
        $( "#FormDivisi" ).validate({
        rules: {
            id_divisi:{
                required: true,
                maxlength: 5,
                minlength:3
            },
            divisi:{
                required:true
            }

        }
        });
    </script>


</body>

</html>
