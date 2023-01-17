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
            var idaudit = "<?php echo base64_decode($this->input->get('a')) ?>";
            $('#info').html("<div id='loading'></div>");
            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: "<?php echo base_url() ?>transaksi_auditor/downloadunit",
                data: {
                    id: id,
                    idaudit: idaudit
                },
                success: function(data) {
                    $('#info').html(data);
                }
            })
        }
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


        $('#jadwal_audit').load("<?php echo base_url() ?>audit/ajax_get_jadwal_audit");
        $('#close').click(function() {
            var confirmText = "Anda yakin ingin menghentikan proses audit?";
            if (confirm(confirmText)) {
                close_audit();
            }
            return false;
        })
   
        function close_audit() {
            var id = "<?php echo $_GET['id'] ?>";
            var a = "<?php echo $_GET['a'] ?>";
            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                data: {
                    id: id,
                    a: a
                },
                url: "<?php echo base_url() ?>transaksi_auditor/closeaudit",
                success: function(data) {
                    if (data.status == true) {
                        window.alert('Audit Scan Succsessful');
                        window.opener.location.reload(true);
                        window.close();
                    } else {
                        window.alert('Audit Scan Failed');
                        window.opener.location.reload(true);
                        window.close();
                    }

                }
            });
        }

        $('#audit').click(function() {
            var no_mesin = $('#no_mesin').val();
            var no_rangka = $('#no_rangka').val();
            var lokasi = $('#id_lokasi').val();
            var cabang = "<?php echo $_GET['id'] ?>";
            var idjadwal_audit = "<?php echo base64_decode($_GET['a']) ?>";
            $('#audit_unit').html('<tr> <td colspan="13" id="loading"></td></tr>');

            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                data: {
                    no_mesin: no_mesin,
                    no_rangka: no_rangka,
                    lokasi: lokasi,
                    cabang: cabang,
                    idjadwal_audit: idjadwal_audit
                },
                url: "<?php echo base_url() ?>transaksi_auditor/doaudit",
                success: function(data) {
                    console.log(data);
                    $('#doCari').attr('disabled', false);
                    $('#pagination').html(data.pagination);
                    $('#audit_unit').html(data.output);
                    $('#info').html(data.info);
                    $('#manual').addClass('hidden');
                }
            });
        });
        $('#doCari').click(function() {
            var cari = $('#cari').val();
            if (cari) {
                scan_getdata();
            } else {
                $('#info').html("Data Kosong");
            }
        });

        function get_data(page) {
            $('#audit_unit').html('<tr> <td colspan="13" id="loading"></td></tr>');
            $('#manual').addClass('hidden');
            var cabang = "<?php echo $_GET['id'] ?>";
            var idjadwal_audit = "<?php echo base64_decode($_GET['a']) ?>"
            console.log("jadwal_audit get_data : " + idjadwal_audit);
            $.ajax({
                type: "post",
                dataType: 'JSON',
                url: "<?php echo base_url() ?>transaksi_auditor/ajax_unitvalid/" + page,
                data: {
                    cabang: cabang,
                    idjadwal_audit: idjadwal_audit
                },
                success: function(data) {
                    console.log(data);
                    $('#pagination').html(data.pagination);
                    $('#audit_unit').html(data.output);
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

            $('#audit_unit').html('<tr> <td colspan="13" id="loading"></td></tr>');
            if (cari != '') {
                $.ajax({
                    type: "post",
                    dataType: 'JSON',
                    url: "<?php echo base_url() ?>transaksi_auditor/scan_data_unit",
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
                        $('#audit_unit').html(data.output);
                        if (data.manual == true) {
                            $('#manual').removeClass('hidden');
                            $('#doCari').attr('disabled', true);
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

    });

    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
    });
</script>

</body>

</html>