
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo SITE_NAME ?> | <?php echo $judul ?></title>

    <link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css-4/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo base_url() ?>assets/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/style2.css" rel="stylesheet">

</head>

<body class="sima-bg">
    <div class="middle-box text-center  animated fadeInUp mb-5">
        <div class="card">
            <div class="bg-light">
                <div class="logo">
            
                    <img src="<?php echo base_url() ?>assets/images/sima-2.png" width="325px" height="100px"></img>
                </div>
            </div>
            <div class="card-body mt-5">
                <form id="FormLog" method="post" action="<?php echo base_url() ?>login/login">
                <?php if ($this->session->userdata('pesan')) {?>
                        <?php echo $this->session->userdata('pesan'); ?>
                <?php
                }?>
                <div class="input-group input-group-lg mb-4">
                    <div class="input-group-prepend bg-light">
                        <span class="input-group-text bg-light"><i class="fa fa-fw fa-user-circle-o"></i></span> 
                    </div>
                    <input type="text" placeholder="Username" class="form-control" name="username">
                </div>
            
                <div class="input-group input-group-lg mb-3">
                <div class="input-group-prepend bg-light">
                    <span class="input-group-text bg-light"><i class="fa fa-fw fa-unlock-alt"></i></span> 
                </div>
                    <input type="password" placeholder="Password" class="form-control" name="password">
                </div>
                    <button type="submit" class="btn btn-danger btn-block pt-3 pb-3 mt-5 mb-5">LOG IN</button>
                </form>
            </div>
        </div>    
        </div>

    <!-- Mainly scripts -->
    <script src="<?php echo base_url() ?>assets/js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js-4/bootstrap.min.js"></script>
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
