<div class="ibox float-e-margins animated fadeInDown">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <i class="fa fa-info-circle"></i> Input Gudang
        </div>
        <div class="panel-body">
            <form method="post" id="FormLokasiInv" class="form-horizontal" action="<?php echo base_url() ?>master_data/post_gudang">
                <div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Kode</label>
                        <div class="col-sm-4"><input type="text" class="form-control" name="kd_gudang" id="kd_gudang" placeholder="XXX-XXX"></div>
                        <div class="col-sm-4">Frmt : Kode Dealer-Kode Gudang (Cth : T13-GUD 81)
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nama</label>
                        <div class="col-sm-4"><input type="text" class="form-control" name="nama_gudang" id="nama_gudang"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Jenis</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="jenis_gudang" id="jenis_gudang">
                                <option value="">-- Pilih Jenis Gudang --</option>
                                <option value="Event">Event</option>
                                <option value="Part">Part</option>
                                <option value="Unit">Unit</option>
                            </select>
                        </div>

                    </div>
                    <div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Alamat</label>
                            <div class="col-sm-6"><input type="text" class="form-control" name="alamat" id="alamat"></div>

                            <div class="col-sm-4 text-right">
                                <input type="button" value="Cancel" class="btn btn-m btn-danger" id="batal" onclick="hide()">
                                <input type="submit" class="btn btn-m btn-success" id="submit" name="submit" value="Submit">
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>