    <script src="<?php echo base_url() ?>assets/js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/jquery.validate.js"></script>
    <script>
        $("#FormVendor").validate({
            rules: {
                id_vendor: {
                    required: true,
                    maxlength: 5,
                    minlength: 3
                },
                nama_vendor: {
                    required: true
                }

            }
        });
    </script>


    </body>

    </html>