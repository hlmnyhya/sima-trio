    <script src="<?php echo base_url() ?>assets/js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/jquery.validate.js"></script>
    <script>
     $('#OptCabang').load("<?php echo base_url() ?>master_data/ajax_get_cabang2");
        $( "#FormJadwalAudit" ).validate({
        rules: {
            idjadwal_audit:{
                required: true,
                minlength:3
            },
            idjenis_audit:{
                required:true
            },
            tanggal:{
                required:true
            },
            waktu:{
                required:true
            },
            auditor:{
                required:true
            }

        }
        });
    </script>


</body>

</html>
