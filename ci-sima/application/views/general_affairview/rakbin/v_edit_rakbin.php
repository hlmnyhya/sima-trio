<div class="ibox float-e-margins animated fadeInDown">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <i class="fa fa-info-circle"></i> Edit Data Rakbin
        </div>

        <div class="panel-body">
            <form method="post" id="FormRakbin" class="form-horizontal" action="<?php echo base_url() ?>master_data/put_rakbin">
                <?php foreach ($edit as $e) : ?>
                    <div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Rakbin</label>
                            <input type="hidden" class="form-control" name="kd_lokasi_rak_baru" id="kd_lokasi_rak_baru" value="<?php echo $e['kd_lokasi_rak_baru'] ?>">
                            <div class="col-sm-4">
                                <input type="text" class="form-control" value="<?php echo $e['kd_lokasi_rak_baru'] ?>">
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="form-group"><label class="col-sm-2 control-label">perusahaan</label>
                            <div class="col-sm-6"><input type="text" class="form-control" name="id_lokasi" id="id_lokasi" value="<?php echo $e['id_lokasi'] ?>">
                        </div>


                            <div class="col-sm-4 text-right">
                                <input type="button" value="Cancel" class="btn btn-m btn-danger" id="batal" onclick="hide()">
                                <input type="submit" class="btn btn-m btn-success" id="submit" name="submit" value="Submit">
                            </div>
                        </div>
                    <?php endforeach; ?>
            </form>
        </div>
    </div>
</div>