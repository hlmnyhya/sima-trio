<div class="ibox float-e-margins animated fadeInDown">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <i class="fa fa-info-circle"></i> Edit Data Gudang
        </div>

        <div class="panel-body">
            <form method="post" id="FormLokasiInv" class="form-horizontal" action="<?php echo base_url() ?>master_data/put_gudang">
                <?php foreach ($edit as $e) : ?>
                    <div>
                        <div class="form-group"><label class="col-sm-2 control-label">Kode Gudang</label>
                            <input type="hidden" class="form-control" name="kd_gudang" id="kd_gudang" value="<?php echo $e['kd_gudang'] ?>">
                            <div class="col-sm-4"><input type="text" class="form-control" value="<?php echo $e['kd_gudang'] ?>" disabled></div>
                        </div>
                    </div>
                    <div>
                        <div class="form-group"><label class="col-sm-2 control-label">Nama Gudang</label>
                            <div class="col-sm-4"><input type="text" class="form-control" id="nama_gudang" name="nama_gudang" value="<?php echo $e['nama_gudang'] ?>"></div>
                        </div>
                    </div>
                    <div>
                        <div class="form-group"><label class="col-sm-2 control-label">Jenis Gudang</label>
                            <div class="col-sm-4">
                                <select type="text" class="form-control" id="jenis_gudang" name="jenis_gudang">
                                    <option <?php echo (($e['jenis_gudang'] == "") ?  "selected" : "") ?> value="">-- Pilih Jenis Gudang --</option>
                                    <option <?php echo (($e['jenis_gudang'] == "Event") ?  "selected" : "") ?> value="Event">Event</option>
                                    <option <?php echo (($e['jenis_gudang'] == "Part") ? "selected" : "") ?> value="Part">Part</option>
                                    <option <?php echo (($e['jenis_gudang'] == "Unit") ? "selected" : "") ?> value="Unit">Unit</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="form-group"><label class="col-sm-2 control-label">Alamat Gudang</label>
                            <div class="col-sm-6"><textarea type="text" class="form-control" name="alamat" id="alamat"><?php echo $e['alamat'] ?></textarea></div>


                            <div class="col-sm-4 text-right">
                                <input type="button" value="Cancel" class="btn btn-m btn-danger" id="batal" onclick="hide()">
                                <input type="submit" class="btn btn-m btn-success" id="submit" name="submit" value="Submit">
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </form>
        </div>
    </div>
</div>