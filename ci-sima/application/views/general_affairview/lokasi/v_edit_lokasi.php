<div class="ibox float-e-margins animated fadeInDown">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <i class="fa fa-info-circle"></i> Edit Data Lokasi Inventory
        </div>

        <div class="panel-body">
            <form method="post" id="FormLokasiInv" class="form-horizontal" action="<?php echo base_url() ?>master_data/put_lokasi">
                <?php foreach ($edit as $e) : ?>
                    <div>
                        <div class="form-group"><label class="col-sm-2 control-label">ID Lokasi Inventory</label>
                            <input type="hidden" class="form-control" name="id_lokasi" id="id_lokasi" value="<?php echo $e['id_lokasi'] ?>">
                            <div class="col-sm-4"><input type="text" class="form-control" value="<?php echo $e['id_lokasi'] ?>" disabled></div>
                        </div>
                    </div>

                    <div>
                        <div class="form-group"><label class="col-sm-2 control-label">Lokasi Inventory</label>
                            <div class="col-sm-6"><input type="text" class="form-control" name="nama_lokasi" id="nama_lokasi" value="<?php echo $e['nama_lokasi'] ?>"></div>


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