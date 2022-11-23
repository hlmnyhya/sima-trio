<?php
$file = '../json/audit.json';

$isi = file_get_contents($file);

$data= json_decode($isi,true);
// var_dump($data);die;
if (!empty($data)) {
    header('location:audit_unit.php');
}
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SIMA Offline</title>

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../css/animate.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">

</head>

<body class="top-navigation">
<div id="wrapper">
        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom white-bg">
        <nav class="navbar navbar-static-top " role="navigation">
            <div class="navbar-header red-bg">
                <a href="#" class="navbar-brand">SIMA</a>
            </div>
            
        </nav>
        </div>
<div class="row">
    <div class="col-md-4"></div>
    
    <div class="col-md-4">
    <div class="ibox float-e-margins animated fadeInDown m-t-xl">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <i class="fa fa-info-circle"></i> Input Data Auidt
            </div>
            <div class="panel-body">
                <form method="post" class="form-horizontal" id="FormInput" action="down_data.php">
                    <div>
                        <div class="form-group"><label class="col-sm-2 control-label">Kode Cabang</label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="id_cabang" id="id_cabang"></div>
                        </div>
                        <div class="form-group">
                            <div class="text-center">
                                <input type="reset" value="Cancel" class="btn btn-m btn-danger" id="batal" >
                                <input type="submit" class="btn btn-m btn-success" id="submit" name="submit" value="Submit">
                            </div>
                        </div>
                </form>
            </div>
        </div></div>
    </div>
    <div class="col-md-4"></div>
</div>
        </div>
        </div>
        <!-- Mainly scripts -->
        <script src="../js/jquery-3.1.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>


    

</body>

</html>