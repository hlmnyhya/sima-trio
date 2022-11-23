    <script src="<?php echo base_url() ?>assets/js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/jquery.validate.js"></script>
    <script>
    
    $(document).ready(function() {
        $('#jenis_inv').load("<?php echo base_url() ?>master_data/ajax_get_jenis_inv2/<?php echo $id ?>");
        });
        $( "#FormSubInv" ).validate({
        rules: {
            idsub_inventory:{
                required: true,
                maxlength: 5,
                minlength:3
            },
            sub_inventory:{
                required:true
            },
            idjenis_inventory:{
                required:true
            }

        }
        });
    </script>


</body>

</html>
