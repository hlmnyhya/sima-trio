    <script src="<?php echo base_url(); ?>assets/js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.validate.js"></script>
    <script>
     $('#Optcabang').load("<?php echo base_url(); ?>master_data/ajax_get_cabang2");
        $( "#FormJadwalAudit" ).validate({
        rules: {
            idjadwal_audit:{
                required: true,
                maxlength: 5,
                minlength:3
            },
            auditor:{
                required:true
            },
            tanggal:{
                required:true
            },
            waktu:{
                required:true
            },
            auditor:{
                required:true
            }

        }
        });
    </script>
    <script>
        <script>
    $(document).ready(function() {
        var i = 0;
        $('#add').click(function() {
            i++;
            $('#rows').append('<div id="rows' + i + '"><div class="form-group text-center col-sm-12 m-t-md"><h4>Part#' + (i + 1) + '</h4></div><div class="form-group col-sm-5"><label class="col-sm-4 control-label">Part Number</label><div class="col-sm-8"><input type="text" class="form-control" name="part_number[' + i + ']" id="part_number"></div></div><div class="form-group col-sm-5"><label class="col-sm-4 control-label">Kondisi Part</label><div class="col-sm-8"><select name="kondisi_part[' + i + ']" id="kondisi_part" class="form-control"><option value="">--Kondisi Part--</option><option value="Patah">Patah</option><option value="Pecah">Pecah</option><option value="Rusak">Rusak</option><option value="Hilang">Hilang</option></select></div></div><div class="form-group col-sm-5"><label class="col-sm-4 control-label">Keterangan</label><div class="col-sm-8"><input type="text" class="form-control" name="ket[' + i + ']" id="ket"></div></div><div class="form-group col-sm-5"><label class="col-sm-4 control-label">Penanggung Jawab</label><div class="col-sm-8"><select name="penanggungjawab[' + i + ']" id="penanggungjawab" class="form-control"><option value="">--Penanggung Jawab--</option><option value="Claim C1/C2">Claim C1/C2</option><option value="Claim Main Dealer">Claim Main Dealer</option><option value="Pribadi">Pribadi</option></select></div></div><div class="col-sm-2"><a name="remove" id="' + i + '" class="btn btn-danger btn_remove"> <i class="fa fa-minus "></i></a></div></div>');

        });
        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr('id');
            $('#rows' + button_id + '').remove();
        });

        //    $('#btn-simpan').click(function(){
        //    console.log($('#FormUnit').serialize());

        //    $.ajax({
        //        url: "<?php echo base_url(); ?>transaksi_auditor/edit_audit_unit" ,
        //        method: 'POST',
        //        data: $('#FormUnit').serialize(),
        //        success:function(data){
        //         console.log(data);

        //         //    alert(data);
        //         //    window.location("<?php echo base_url(); ?>transaksi/audit_unit");
        //        }

        //    })
        //    })
        lokasi();

        function lokasi() {
            var id = "<?php echo base64_decode($_GET['a']); ?>";
            //var id = '2NG-GUD'; //document.getElementById("id_lokasi").val
            var id_cabang = "<?php echo base64_decode($_GET['s']); ?>";
            //var id_cabang = '2NG';
            $.ajax({
                url: "<?php echo base_url(); ?>transaksi_auditor/ajax_get_lokasi2",
                type: "POST",
                dataType: 'JSON',
                data: {
                    'id_cabang': id_cabang,
                    key: id
                },
                success: function(data) {
                    $('#OptLokasi').html(data);
                    $('#load').html('');
                }
            });
        }
        $('#is_ready').change(function() {
            var id = $(this).val();
            console.log(id);

            if (id == 'NFRS') {
                $('#noready').removeClass('hidden');
            } else {
                $('#noready').addClass('hidden');
            }
        });

        $('#OptCabang').load("<?php echo base_url(); ?>transaksi_auditor/ajax_get_cabang2");


        $('#data_1 .input-group.date').datepicker({
            format: 'mm/dd/yyyy',
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });

        $('#data_5 .input-daterange').datepicker({
            format: 'mm/dd/yyyy',
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true
        });

        $('#preview').click(function(e) {
            e.preventDefault();
            preview(1);
        });

        $(document).on('click', '.pagination li a', function(event) {
            event.preventDefault();
            var page = $(this).data('ci-pagination-page');
            preview(page);

        });

        function preview(page) {
            var cabang = $('#OptCabang').val();
            var tgl_awal = $('#tgl_awal').val();
            var tgl_akhir = $('#tgl_akhir').val();
            var status = $('#status').val();
            var action = 'preview';
            $.ajax({
                method: 'post',
                dataType: 'JSON',
                url: '<?php echo base_url(); ?>transaksi_auditor/preview/' + page,
                data: {
                    id_cabang: cabang,
                    tgl_awal: tgl_awal,
                    tgl_akhir: tgl_akhir,
                    status: status,
                    action: action
                },
                // data: 'id_cabang='+cabang+'&&tgl_awal='+tgl_awal+'&&tgl_akhir='+tgl_akhir+'&&status='+status+'&&pages='+valu,
                success: function(data) {

                    $('#audit_unit').html(data.unit_list);
                    $('#pagination').html(data.pagination_link);
                    $('#rows_entry').html(data.row_entry);

                }
            });
        }


    })

    </script>


</body>

</html>
