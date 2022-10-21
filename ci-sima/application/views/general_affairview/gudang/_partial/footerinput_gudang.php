    <script src="<?php echo base_url() ?>assets/js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/jquery.validate.js"></script>
    <script>
        $("#FormLokasiInv").validate({
            rules: {
                kd_gudang: {
                    required: true,
                    maxlength: 15,
                    minlength: 3
                },
                nama_gudang: {
                    required: true
                },
                jenis_gudang: {
                    required: true
                },
                alamat: {
                    required: true
                }
            }
        });
    </script>


    </body>

    </html>