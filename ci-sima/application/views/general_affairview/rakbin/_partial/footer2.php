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
        $('#id_cabang').load("<?php echo base_url() ?>transaksi_ga/ajax_get_cabang2");
        lokasi();

        function lokasi() {
        var cabang = "<?php echo $_GET['id'] ?>";
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            data: {
                id_cabang: cabang
            },
            url: "<?php echo base_url() ?>transaksi_auditor/ajax_get_lokasi2",
            success: function(data) {
                $('#id_lokasi').html(data);
            }
                
        });
        console.log(cabang);
    }
    </script>
</body>

</html>
