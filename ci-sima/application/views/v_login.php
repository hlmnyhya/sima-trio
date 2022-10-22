
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo SITE_NAME ?> | <?php echo $judul ?></title>

    <link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo base_url() ?>assets/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/style.css" rel="stylesheet">

</head>

<body class="dark-bg watermark">

    <div class="middle-box text-center  animated fadeInDown">
        <div class="panel panel-danger">
            <div class="panel-heading red-bg">
                <div>
                    <h2 class="logo-name text-white">SIMA</h2>
                </div>
                <div class=" m-t-n text-white">
                <h4>Sistem Informasi Management Audit</h4>
                </div>
            </div>
            <div class="panel-body">
                <form id="FormLog" method="post" action="<?php echo base_url() ?>login/login">
                <?php if ($this->session->userdata('pesan')) {?>
                        <?php echo $this->session->userdata('pesan'); ?>
                <?php
                }?>
                <div class="input-group m-b">
                    <span class="input-group-addon"><i class="fa fa-fw fa-user-circle-o"></i></span> 
                    <input type="text" placeholder="Username" class="form-control" name="username">
                </div>
            
                <div class="input-group m-b">
                    <span class="input-group-addon"><i class="fa fa-fw fa-unlock-alt"></i></span> 
                    <input type="password" placeholder="Password" class="form-control" name="password">
                </div>
                    <button type="submit" class="btn btn-danger full-width center sm-b">LOG IN</button>
            
                </form>
            </div>
        </div>
                
        </div>

    <!-- Mainly scripts -->
    <script src="<?php echo base_url() ?>assets/js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/jquery.validate.js"></script>
    <script>
        $( "#FormLog" ).validate({
        rules: {
            username:{
                required: true
            },
            password:{
                required:true
            }

        }
        });
    </script>
</body>

</html>
