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
                <div class="col-md-2"></div>

                <div class="col-md-8">
                    <div class="wrapper wrapper-content m-t-n-md wrapper wrapper-content animated fadeInRight">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h3><i class="fa fa-info-circle"></i> Audit</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="panel panel-default">
                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <div class="form-group"><label class="col-sm-2 control-label">Lokasi </label>
                                                                <div class="col-sm-9"><input type="text" class="form-control m-b" name="id_lokasi" id="id_lokasi">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="col-sm-2 control-label">Data Unit</label>
                                                                <div class="col-sm-7">
                                                                    <input type="text" class="form-control" placeholder="Cari Data Unit" id="cari">
                                                                    <span class="help-block m-b-none text-danger" id="info"></span>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <a id="doCari" class=" btn btn-primary">Scan Data</a>
                                                                    <a href="transaksi_auditor/temp_unit" class="btn btn-warning">Temporary Data</a>

                                                                    <a id="close" onclick="" class="btn btn-danger">Close Audit</a>
                                                                </div>
                                                            </div>
                                                            <div class="form-group"><label class="col-sm-2 control-label">RFS </label>
                                                                <div class="col-sm-10"><input type="checkbox" name="rfs" id="rfs" value="1">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="manual" class="row">
                                                            <div class="form-group col-sm-12">
                                                                <label>No. Mesin</label>
                                                                <input type="text" class="form-control" placeholder="No Mesin" id="no_mesin" required>
                                                            </div>
                                                            <div class="form-group col-sm-12">
                                                                <label>No. Rangka</label>
                                                                <input type="text" class="form-control" placeholder="No Rangka" id="no_rangka" required>
                                                            </div>
                                                            <div class="form-group col-sm-12">
                                                                <a id="audit" class="btn btn-primary">Audit</a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12">

                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-hover dataTables-example gray-bg">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center" width="3%">No</th>
                                                                <th class="text-center" width="3%">Aksi</th>
                                                                <th class="text-center">No Mesin</th>
                                                                <th class="text-center">No Rangka</th>
                                                                <th class="text-center">Lokasi</th>
                                                                <th class="text-center">Umur Unit</th>
                                                                <th class="text-center">Status Unit</th>
                                                                <th class="text-center">Tahun</th>
                                                                <th class="text-center">Type</th>
                                                                <th class="text-center">Kode Item</th>
                                                                <th class="text-center">Keterangan</th>
                                                                <th class="text-center">RFS</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="audit_unit">
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th class="text-center" width="3%">No</th>
                                                                <th class="text-center" width="3%">Aksi</th>
                                                                <th class="text-center">No Mesin</th>
                                                                <th class="text-center">No Rangka</th>
                                                                <th class="text-center">Lokasi</th>
                                                                <th class="text-center">Umur Unit</th>
                                                                <th class="text-center">Status Unit</th>
                                                                <th class="text-center">Tahun</th>
                                                                <th class="text-center">Type</th>
                                                                <th class="text-center">Kode Item</th>
                                                                <th class="text-center">Keterangan</th>
                                                                <th class="text-center">RFS</th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                                <div class="text-right"> <span id="pagination"></span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
    </div>
    <!-- Mainly scripts -->
    <script src="../js/jquery-3.1.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#doCari').click(function() {
                var cari = $('#cari').val();
                console.log("cari");

                if (cari) {
                    scandata();
                } else {
                    $('#info').html("data Kosong");
                }
            })
            $('#manual').addClass('hidden');
            $('#cari').keyup(function(e) {
                if (e.keyCode == 13) {
                    if (cari) {
                        scandata();
                    } else {
                        $('#info').html("Data Kosong");
                    }
                }
            });

            function scandata() {
                var lokasi = $('#id_lokasi').val();
                var cari = $('#cari').val();
                var rfs = $('#rfs').val();
                var json = (function() {
                    var json = null;
                    $.ajax({
                        'async': false,
                        'global': false,
                        'url': "../json/unit_temp.json",
                        'dataType': "json",
                        'success': function(data) {
                            json = data;
                        }
                    });
                    return json;
                })();

                if (cari != '') {
                    fetch();
                    for (var i = 0; i < json.length; i++) {
                        // look for the entry with a matching `code` value
                        if (json[i].no_mesin == cari) {
                            var cek = (function() {
                                var cek = null;
                                $.ajax({
                                    'async': false,
                                    'global': false,
                                    'url': "../json/audited.json",
                                    'dataType': "json",
                                    'success': function(data) {
                                        cek = data;
                                    }
                                });
                                return cek;
                            })();
                            console.log("matched", json[i]);
                            var ket = '';
                            if (json[i].id_lokasi != lokasi) {
                                ket = 'Lokasi Tidak Sesuai'
                            }
                            $.ajax({
                                type: "post",
                                dataType: 'JSON',
                                url: "audit_proses.php",
                                data: {
                                    no_mesin: json[i].no_mesin,
                                    no_rangka: json[i].no_rangka,
                                    id_cabang: json[i].id_cabang,
                                    id_lokasi: lokasi,
                                    kode_item: json[i].kode_item,
                                    type: json[i].type,
                                    tahun: json[i].tahun,
                                    ket: ket,
                                    status: 'Sesuai',
                                    rfs: rfs
                                },
                                success: function(data) {
                                    fetch();
                                    $('#cari').val('');
                                }
                            })

                        }
                    }
                }
            }
            fetch();

            function fetch() {
                var cek = (function() {
                    var cek = null;
                    $.ajax({
                        'async': false,
                        'global': false,
                        'url': "../json/audited.json",
                        'dataType': "json",
                        'success': function(data) {
                            cek = data;
                        }
                    });
                    return cek;
                })();

                if (cek.length > 0) {
                    var temp = "";
                    for (let i = 0; i < cek.length; i++) {
                        var x = i + 1;
                        temp += "<tr>";
                        temp += "<td>" + x + "</td>";
                        temp += "<td></td>";
                        temp += "<td>" + cek[i].no_mesin + "</td>";
                        temp += "<td>" + cek[i].no_rangka + "</td>";
                        temp += "<td>" + cek[i].id_lokasi + "</td>";
                        temp += "<td></td>";
                        temp += "<td>" + cek[i].status_unit + "</td>";
                        temp += "<td>" + cek[i].tahun + "</td>";
                        temp += "<td>" + cek[i].type + "</td>";
                        temp += "<td>" + cek[i].kode_item + "</td>";
                        temp += "<td>" + cek[i].keterangan + "</td>";
                        temp += "<td>" + cek[i].is_ready + "</td>";
                        temp += "</tr>";

                    }
                    $('#audit_unit').html(temp);
                }
            }
        })
    </script>


</body>

</html>