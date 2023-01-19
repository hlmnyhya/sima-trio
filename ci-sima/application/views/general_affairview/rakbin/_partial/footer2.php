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

<script>
         $('#id_cabang').load("<?php echo base_url() ?>master_data/ajax_get_cabang2");
         $('#id_lokasi').load("<?php echo base_url() ?>master_data/ajax_get_lokasi2");
    </script>
</body>

</html>
