<div class="ibox float-e-margins animated fadeInDown">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <i class="fa fa-info-circle"></i> Edit Data Jenis Inventory
        </div>

        <div class="panel-body">
            <form method="post" id="FormJenisInv" class="form-horizontal" action="<?php echo base_url() ?>master_data/put_jenisinv">
                <?php foreach ($edit as $e) : ?>
                    <div>
                        <div class="form-group"><label class="col-sm-2 control-label">ID Jenis Inventory</label>
                            <input type="hidden" class="form-control" name="idjenis_inventory" id="idjenis_inventory" value="<?php echo $e['idjenis_inventory'] ?>">
                            <div class="col-sm-4"><input type="text" class="form-control" value="<?php echo $e['idjenis_inventory'] ?>" disabled></div>
                        </div>
                    </div>

                    <div>
                        <div class="form-group"><label class="col-sm-2 control-label">Jenis Inventory</label>
                            <div class="col-sm-6"><input type="text" class="form-control" name="jenis_inventory" id="jenis_inventory" value="<?php echo $e['jenis_inventory'] ?>"></div>


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