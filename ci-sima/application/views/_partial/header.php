<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo SITE_NAME ?> | <?php echo $judul ?></title>
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url() ?>assets/images/icon.png" />
    <link href="<?php echo base_url() ?>assets/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/plugins/ladda/ladda-themeless.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/plugins/textSpinners/spinners.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/plugins/clockpicker/clockpicker.css" rel="stylesheet">

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
    <style>
        #loading {
            /* text-align: center; */
            background: url('<?php echo base_url() ?>assets/images/loader.gif') no-repeat center;
            background-size: 30px;
            width: 100%;
            height: 100px;
        }
    </style>

</head>

<body class="md-skin fixed-nav fixed-nav-basic fixed-sidebar">

    <div id="wrapper">