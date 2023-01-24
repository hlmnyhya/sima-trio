    <script src="<?php echo base_url() ?>assets/js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/jquery.validate.js"></script>
    <script>
        $( "#FormRakbin" ).validate({
        rules: {
            kd_lokasi_rak_baru:{
                required: true,
                maxlength: 5,
                minlength:3
            },
            id_lokasi:{
                required:true
            }

        }
        });
    </script>

<script>
         $('#id_cabang').load("<?php echo base_url() ?>master_data/ajax_get_cabang2");
         $('#id_lokasi').load("<?php echo base_url() ?>master_data/ajax_get_lokasi2");
    </script>
</body>

</html>
