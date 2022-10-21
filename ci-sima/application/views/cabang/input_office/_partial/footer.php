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
<script src="<?php echo base_url() ?>assets/js/jquery.validate.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/chosen/chosen.jquery.js"></script>
<script>
    $("#FormInventory").validate({
        rules: {
            id_inventory: {
                required: true,
                minlength: 6
            },
            idstatus_inventory: {
                required: true
            },
            idjenis_inventory: {
                required: true
            },
            idsub_inventory: {
                required: true
            },
            nilai_awal: {
                required: true,
                number: true
            },
            ddp: {
                required: true,
                number: true
            },
            nilai_asset: {
                required: true,
                number: true
            },
            nilai_total_keseluruhan: {
                required: true,
                number: true
            },
            tanggal_barang_terima: {
                required: true
            },
            id_vendor: {
                required: true
            },
            jenis_pembayaran: {
                required: true
            },
            id_cabang: {
                required: true
            },
            id_lokasi: {
                required: true
            },
            nama_pengguna: {
                required: true
            },
            keterangan: {
                required: true
            },
            stok: {
                required: true
            },
            asal_hadiah: {
                required: true
            },
            ppn: {
                required: true
            },
            ket_ppn: {
                required: true
            },
            merk: {
                required: true
            },
            aksesoris_tambahan: {
                required: true
            },
            serial_number: {
                required: true
            },
            uang_muka: {
                required: true,
                number: true
            },
            cicilan_perbulan: {
                required: true,
                number: true
            },
            tenor: {
                required: true,
                number: true
            },
            nilai_total: {
                required: true,
                number: true
            },

        }
    });
</script>
<script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<!-- Idle Timer plugin -->
<script src="<?php echo base_url() ?>assets/js/plugins/idle-timer/idle-timer.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/jasny/jasny-bootstrap.min.js"></script>
<!-- Custom and plugin javascript -->
<script src="<?php echo base_url() ?>assets/js/inspinia.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/pace/pace.min.js"></script>

<script src="<?php echo base_url() ?>assets/js/plugins/toastr/toastr.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>


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
        $('.chosen-select').chosen({
            width: "100%"
        });
        $('#foto').on('change', function() {

            $("#image").show();

            var imgpreview = DisplayImagePreview(this);
            $("#image").hide();
            $(".img_preview").show();
        });

        function DisplayImagePreview(input) {
            console.log(input.files);
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    // $('#image').html('');
                    $('#img_preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        // $('#user').load("<?php echo base_url(); ?>master_data/ajax_get_user");
        $('#OptStatusInv').load("<?php echo base_url() ?>transaksi_cabang/ajax_get_statusinv2");
        $('#OptVendor').load("<?php echo base_url() ?>transaksi_cabang/ajax_get_vendor2");
        $('#OptJenisInv').load("<?php echo base_url() ?>transaksi_cabang/ajax_get_jenisinv2");
        $('#tanggal_barang_terima').datepicker({
            format: 'mm/dd/yyyy',
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true
        });
        $('#OptJenisInv').on('change', function() {
            var idjenis_inventory = $(this).val();

            if (idjenis_inventory == "") {
                $('#OptSubInv').prop('disabled', true);
            } else {
                $('#OptSubInv').prop('disabled', false);
                $('#load1').html('<span class="loading dots"></span>');
                $.ajax({
                    url: "<?php echo base_url(); ?>transaksi_cabang/ajax_get_subinv2",
                    type: "POST",
                    data: {
                        'idjenis_inventory': idjenis_inventory
                    },
                    success: function(data) {
                        $('#load1').html('');
                        $('#OptSubInv').html(data);
                    }
                });
            }
        })
        var id_cabang = "<?php echo $this->session->userdata('id_cabang') ?>";

        if (id_cabang == "") {
            $('#OptLokasi').prop('disabled', true);
        } else {
            $('#OptLokasi').prop('disabled', false);
            $('#load').html('<span class="loading dots"></span>');
            $.ajax({
                url: "<?php echo base_url(); ?>transaksi_cabang/ajax_get_lokasi2",
                type: "POST",
                data: {
                    'id_cabang': id_cabang
                },
                success: function(data) {
                    $('#OptLokasi').html(data);
                    $('#load').html('');
                }
            });
        }

        function search() {
            var username = $('#username').val();
            var nama = $('#nama').val();

            if (username != '' && nama != '') {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url() ?>master_data/search_data_user",
                    data: "username=" + username + "&nama=" + nama,
                    success: function(data) {
                        $("#user").html(data);
                        $("#search").val("");
                    }
                });
            } else {
                if (username != '' && nama == '') {
                    $.ajax({
                        type: "post",
                        url: "<?php echo base_url() ?>master_data/search_data_user",
                        data: "username=" + username,
                        success: function(data) {
                            $("#user").html(data);
                            $("#search").val("");
                        }
                    });
                } else {
                    if (username == '' && nama != '') {
                        $.ajax({
                            type: "post",
                            url: "<?php echo base_url() ?>master_data/search_data_user",
                            data: "nama=" + nama,
                            success: function(data) {
                                $("#user").html(data);
                                $("#search").val("");
                            }
                        });
                    } else {
                        $('#user').load("<?php echo base_url(); ?>master_data/ajax_get_user");
                    }
                }
            }
        }

        $('#caribtn').click(function() {
            search();
        });

        $('#username').keyup(function(e) {
            if (e.keyCode == 13) {
                search();
            } else {
                if (e.keyCode == 9) {
                    $('#nama').focus();
                }
            }
        });

        $('#nama').keyup(function(e) {
            if (e.keyCode == 13) {
                search();
            }
        });

        $('#OptStatusInv').change(function() {
            var asal = $('#OptStatusInv').val();
            var hadiah = $('#asal_hadiah').val();

            if (asal == 'ST004') {
                console.log('berhasil');
                hadiah = null;
                $('#hadiah').removeClass('hidden');
                $('#hadiah').addClass('form-group');
            } else {
                $('#hadiah').removeClass('form-group');
                $('#hadiah').addClass('hidden');
                console.log('gagal');

            }

        });

        $('#OptJenisPemb').change(function() {
            var jenisPem = $('#OptJenisPemb').val();
            console.log(jenisPem);

            if (jenisPem == 'Kredit') {
                $('#kredit').removeClass('hidden');
                // $('#kredit').addClass('form-group');
            } else {
                $('#kredit').addClass('hidden');
                // $('#kredit').removeClass('form-group');
            }
        });

        $('#OptJenisInv').change(function() {
            var jenisInv = $('#OptJenisInv').val();
            console.log(jenisInv);

            if (jenisInv == 'ELEC') {
                $('#elec').removeClass('hidden');
                // $('#elec').addClass('form-group');
            } else {
                $('#elec').addClass('hidden');
                // $('#elec').removeClass('form-group');
            }
            if (jenisInv == 'OTO') {
                $('#oto').removeClass('hidden');
                // $('#oto').addClass('form-group');
            } else {
                $('#oto').addClass('hidden');
                // $('#oto').removeClass('form-group');
            }
        });
        $('#total').click(function() {
            console.log('test');

            nilai_total();
        });

        function nilai_total() {
            var uang_muka = parseInt($('#uang_muka').val());
            var cicilan = parseInt($('#cicilan_perbulan').val());
            var tenor = parseInt($('#tenor').val());
            var nilai_total = 0;

            nilai_total = (cicilan * tenor) + uang_muka;

            $('#nilai_total').val(nilai_total);
        }
    });

    function edit(id) {
        // var id = $(this).attr('data-id');
        $.ajax({
            url: "<?php echo base_url() . $this->uri->segment(1) ?>/edit_user",
            type: 'post',
            data: "id=" + id,
            dataType: 'html',
            success: function(data) {
                $('#data_input').html(data);
            }

        });
    }

    function hitung() {
        var dpp = parseInt($('#dpp').val());
        var nilai_asset = parseInt($('#nilai_asset').val());
        var nilai = dpp + nilai_asset;
        $('#nilai_awal').val(nilai);

        console.log(nilai);
        //    return nilai;
    }

    function generate() {
        var id = $('#OptSubInv').val();
        var dealer = 'MD';
        var bln = new Date();
        a = (bln.getMonth() + 1);
        b = bln.getFullYear();
        max = '<?php echo sprintf("%05s", ($max + 1)) ?>';
        switch (a) {
            case 1:
                a = 'I';
                break;
            case 2:
                a = 'II';
                break;
            case 3:
                a = 'III';
                break;
            case 4:
                a = 'IV';
                break;
            case 5:
                a = 'V';
                break;
            case 6:
                a = 'VI';
                break;
            case 7:
                a = 'VII';
                break;
            case 8:
                a = 'VIII';
                break;
            case 9:
                a = 'IX';
                break;
            case 10:
                a = 'X';
                break;
            case 11:
                a = 'XI';
                break;
            case 12:
                a = 'XII';
                break;
        }
        var id_inventory = id + '/TRIO' + dealer + '/' + a + '/' + b + '/' + max;
        if (id == null) {
            $('#id_inventory').val('');
        } else {
            $('#id_inventory').val(id_inventory);
        }

    }
</script>

</html>