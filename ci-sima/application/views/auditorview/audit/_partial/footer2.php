<div class="footer fixed">
    <div class="pull-right">
        <div id="stat">
            <span class="label label-success"> <span class="text-info"><i class="fa fa-circle"></i></span> Online</span>
        </div>
    </div>
    <div>
        &copy; <Strong> Trio Motor</strong> 2020 - <?php echo date("Y"); ?>
    </div>
</div>

</div>


<!-- Mainly scripts -->
<script src="<?php echo base_url() ?>assets/js/jquery-3.1.1.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<!-- Idle Timer plugin -->
<script src="<?php echo base_url() ?>assets/js/plugins/idle-timer/idle-timer.min.js"></script>
<!-- Custom and plugin javascript -->
<script src="<?php echo base_url() ?>assets/js/inspinia.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/pace/pace.min.js"></script>

<script src="<?php echo base_url() ?>assets/js/plugins/toastr/toastr.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/iCheck/icheck.min.js"></script>


<script>
    $(document).ready(function() {
        <?php if ($this->session->flashdata('berhasil')) { ?>
            setTimeout(function() {
                toastr.options = {
                    positionClass: 'toast-bottom-left',
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 4000
                };
                toastr.success('<?php echo $this->session->flashdata('berhasil') ?>', 'Status');

            }, 1300);
        <?php } ?>
        <?php if ($this->session->flashdata('gagal')) { ?>
            setTimeout(function() {
                toastr.options = {
                    positionClass: 'toast-bottom-left',
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 4000
                };
                toastr.error('<?php echo $this->session->flashdata('gagal') ?>', 'Status');

            }, 1300);
        <?php } ?>
        <?php if ($this->session->flashdata('warning')) { ?>
            setTimeout(function() {
                toastr.options = {
                    positionClass: 'toast-bottom-left',
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 4000
                };
                toastr.warning('<?php echo $this->session->flashdata('warning') ?>', 'Status');

            }, 1300);
        <?php } ?>
        $(document).idleTimer(10000);
    });

    $(document).on("idle.idleTimer", function(event, elem, obj) {
        document.getElementById("stat").innerHTML = "<span class='label label-danger'> <span class='text-warning'><i class='fa fa-circle'></i></span> Offline</span>";
    });

    $(document).on("active.idleTimer", function(event, elem, obj, triggerevent) {
        // function you want to fire when the user becomes active again
        document.getElementById("stat").innerHTML = "<span class='label label-success'> <span class='text-info'><i class='fa fa-circle'></i></span> Online</span>";
    });
</script>
<script>
    $(document).ready(function() {
        download();
        get_data(1);
        lokasi();

        function download() {
            var id = "<?php echo $this->input->get('id') ?>";
            var idjadwal_audit = "<?php echo base64_decode($this->input->get('a')) ?>";
            $('#info').html("<div id='loading'></div>");
            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: "<?php echo base_url() ?>transaksi_auditor/downloadpart",
                data: {
                    id: id,
                    idjadwal_audit: idjadwal_audit
                },
                success: function(data) {
                    $('#info').html(data);
                }
            })
        }
        get_data(1);
        $('#doCariPart').click(function() {
            var cari = $('#cari').val();
            if (cari) {
                scan_getdata();
            } else {
                $('#info').html("data Kosong");
            }
        });

        function get_data(page) {
            $('#audit_part').html('<tr> <td colspan="7" id="loading"></td></tr>');
            var cabang = "<?php echo $_GET['id'] ?>";
            var idjadwal_audit = "<?php echo base64_decode($_GET['a']) ?>";
            var rakbin = $('#rakbin').val();
            $.ajax({
                type: "post",
                dataType: 'JSON',
                url: "<?php echo base_url() ?>transaksi_auditor/ajax_partvalid/" + page,
                data: {
                    cabang: cabang,
                    rakbin: rakbin,
                    idjadwal_audit: idjadwal_audit
                },
                success: function(data) {
                    console.log(data);
                    $('#pagination').html(data.pagination);
                    $('#audit_part').html(data.output);
                }
            });
        }
        $(document).on('click', '.pagination li a', function(event) {
            event.preventDefault();
            var page = $(this).data('ci-pagination-page');
            get_data(page);

        });

        function scan_getdata() {
            $('#manual').addClass('hidden');
            var cari = $('#cari').val();
            var lokasi = $('#id_lokasi').val();
            var rakbin = $('#rakbin').val();
            var kondisi = $('#kondisi').val();
            var cabang = "<?php echo $_GET['id'] ?>";
            var idjadwal_audit = "<?php echo base64_decode($_GET['a']) ?>";
            console.log(cari);
            $('#audit_part').html('<tr> <td colspan="7" id="loading"></td></tr>');
            if (cari != '') {
                $.ajax({
                    type: "post",
                    dataType: 'JSON',
                    url: "<?php echo base_url() ?>transaksi_auditor/scan_data_part",
                    data: {
                        id: cari,
                        cabang: cabang,
                        lokasi: lokasi,
                        rakbin: rakbin,
                        kondisi: kondisi,
                        idjadwal_audit: idjadwal_audit
                    },
                    success: function(data) {
                        $('#cari').val('');
                        $('#info').html(data.info);
                        $('#audit_part').html(data.output);
                        $('#pagination').html(data.pagination);
                    }
                });
            } else {
                get_data(1);
            }
        }
        $('#cari').keyup(function(e) {
            if (e.keyCode == 13) {
                if (cari) {
                    scan_getdata();
                } else {
                    $('#info').html("Data Kosong");
                } 
            }
        });

    });
    function lokasi() 
        {
            var cabang = "<?php echo $_GET['id'] ?>";
            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                data: {
                    id_cabang: cabang
                },
                url: "<?php echo base_url() ?>transaksi_auditor/ajax_get_lokasi2",
                success: function(data) {
                    $('#id_lokasi').html(data);
                }

            });

        }

        function rakbin() 
        {
            var rak = "<?php echo $_GET['id'] ?>";
            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                data: {
                    kd_lokasi_rak: rak
                },
                url: "<?php echo base_url() ?>transaksi_auditor/ajax_get_rakbin",
                success: function(data) {
                    $('#rakbin').html(data);
                }

            });
            console.log(rak);

        }


    // function lokasi() {
    //     var cabang = "<?php echo $_GET['id'] ?>";
    //     $.ajax({
    //         type: 'POST',
    //         dataType: 'JSON',
    //         data: {
    //             id_cabang: cabang
    //         },
    //         url: "<?php echo base_url() ?>transaksi_auditor/ajax_get_lokasi2",
    //         success: function(data) {
    //             $('#id_lokasi').html(data);
    //         }

    //     });

    // }
    // $('.i-checks').iCheck({
    //     checkboxClass: 'icheckbox_square-green',
    //     radioClass: 'iradio_square-green',
    // });

 
        $('#jadwal_audit').load("<?php echo base_url() ?>audit/ajax_get_jadwal_audit");
        $('#close_part').click(function() {
            var confirmText = "Anda yakin ingin menghentikan proses audit?";
            if (confirm(confirmText)) {
                close_part();
            }
            return false;
        })

        function close_part() {
            var id = "<?php echo $_GET['id'] ?>";
            var a = "<?php echo $_GET['a'] ?>";
            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                data: {
                    id: id,
                    a: a
                },
                url: "<?php echo base_url() ?>transaksi_auditor/closepart",
                success: function(data) {
                    if (data.status == true) {
                        window.alert('Audit Scan Successful');
                       indow.opener.location.reload(true);
                        window.close();
                    } else {
                        window.alert('Audit Close Successful');
                        window.opener.location.reload(true);
                        window.close();
                    }

                }
            });
        }
        $('#auditPart').click(function() {
            var part_number = $('#part_number').val();
            var rakbin = $('#rakbin').val();
            var lokasi = $('#id_lokasi').val();
            var keterangan = $('#keterangan').val();
            var cabang = "<?php echo $_GET['id'] ?>";
            var idjadwal_audit = "<?php echo base64_decode($_GET['a']) ?>";
            $('#Audit_Part').html('<tr> <td colspan="13" id="loading"></td></tr>');

            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                data: {
                    part_number: part_number,
                    rakbin: rakbin,
                    lokasi: lokasi,
                    cabang: cabang,
                    keterangan: keterangan,
                    idjadwal_audit: idjadwal_audit
                },
                url: "<?php echo base_url() ?>transaksi_auditor/doPart",
                success: function(data) {
                    console.log(data);
                    $('#doCariPart').attr('disabled', false);
                    $('#pagination').html(data.pagination);
                    $('#Audit_Part').html(data.output);
                    $('#info').html(data.info);
                    $('#manual').addClass('hidden');
                }
            });
        });
        $('#doCariPart').click(function() {
            var cari = $('#cari').val();
            if (cari) {
                scan_getdata();
            } else {
                $('#info').html("data Kosong");
            }
        });

        function get_data(page) {
            $('#audit_part').html('<tr> <td colspan="13" id="loading"></td></tr>');
            $('#manual').addClass('hidden');
            var cabang = "<?php echo $_GET['id'] ?>";
            var idjadwal_audit = "<?php echo base64_decode($_GET['a']) ?>"
            console.log("jadwal_audit get_data : " + idjadwal_audit);
            $.ajax({
                type: "post",
                dataType: 'JSON',
                url: "<?php echo base_url() ?>transaksi_auditor/ajax_partvalid/" + page,
                data: {
                    cabang: cabang,
                    idjadwal_audit: idjadwal_audit
                },
                success: function(data) {
                    console.log(data);
                    $('#pagination').html(data.pagination);
                    $('#audit_part').html(data.output);
                }
            });
        }
        $(document).on('click', '.pagination li a', function(event) {
            event.preventDefault();
            var page = $(this).data('ci-pagination-page');
            get_data(page);

        });  

        function scan_getdata() {
            $('#manual').addClass('hidden');
            var cari = $('#cari').val();
            var cabang = "<?php echo $_GET['id'] ?>";
            var idjadwal_audit = "<?php echo base64_decode($_GET['a']) ?>";
            console.log("jadwal_audit scan_getdata : " + idjadwal_audit)
            var lokasi = $('#id_lokasi').val();

            $('#audit_part').html('<tr> <td colspan="13" id="loading"></td></tr>');
            if (cari != '') {
                $.ajax({
                    type: "post",
                    dataType: 'JSON',
                    url: "<?php echo base_url() ?>transaksi_auditor/scan_data_part",
                    data: {
                        id: cari,
                        cabang: cabang,
                        idjadwal_audit: idjadwal_audit,
                        lokasi: lokasi,
                    },
                    success: function(data) {
                        $('#cari').val('');
                        $('#info').html(data.info);
                        $('#pagination').html(data.pagination);
                        $('#audit_part').html(data.output);
                        if (data.manual == true) {
                            $('#manual').removeClass('hidden');
                            $('#doCariPart').attr('disabled', true);
                        }
                    }
                });
            } else {
                get_data();
            }
        }
        $('#cari').keyup(function(e) {
            if (e.keyCode == 13) {
                if (cari) {
                    scan_getdata();
                } else {
                    $('#info').html("Data Kosong");
                }
            }
        });

    

    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
    });
</script>

</body>

</html>