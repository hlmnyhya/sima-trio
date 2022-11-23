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
                nama_lokasi: {
                    required: true
                }

            }
        });
    </script>


    </body>

    </html>