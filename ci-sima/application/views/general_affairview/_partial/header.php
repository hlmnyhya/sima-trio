<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo SITE_NAME ?> | <?php echo $judul ?></title>
    <link href="<?php echo base_url() ?>assets/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/style.css" rel="stylesheet">
    <script>
        function redirectCU(e) {
            if (e.ctrlKey && e.which == 85) {
                return true;
            }
        }
        document.onkeydown = redirectCU;


        function redirectKK(e) {
            if (e.which == 3) {
                return false;
            }
        }
        document.oncontextmenu = redirectKK;
</script>

</head>