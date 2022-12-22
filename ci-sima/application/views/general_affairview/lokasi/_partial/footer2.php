    <script src="<?php echo base_url() ?>assets/js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/jquery.validate.js"></script>
    <script>
        $("#FormLokasiInv").validate({
            rules: {
                id_lokasi: {
                    required: true,
                    maxlength: 5,
                    minlength: 3
                },
                id_cabang: {
                    required: true,
                    
                },
                nama_lokasi: {
                    required: true
                }

            }
        });
    </script>

    <script>
        $('#id_cabang').load("<?php echo base_url() ?>transaksi_ga/ajax_get_cabang2");
    </script>


    </body>

    </html>