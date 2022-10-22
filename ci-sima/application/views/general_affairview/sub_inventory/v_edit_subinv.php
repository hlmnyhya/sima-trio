<div class="ibox float-e-margins animated fadeInDown">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <i class="fa fa-info-circle"></i> Edit Data Sub Inventory
        </div>

        <div class="panel-body">
            <form method="post" id="FormSubInv" class="form-horizontal" action="<?php echo base_url() ?>master_data/put_subinv">
                <?php
                foreach ($edit as $e) :
                ?>
                    <div>
                        <div class="form-group"><label class="col-sm-2 control-label">ID Sub Inventory</label>
                            <input type="hidden" class="form-control" name="idsub_inventory" id="idsub_inventory" value="<?php echo $e['idsub_inventory'] ?>">
                            <div class="col-sm-4"><input type="text" class="form-control" value="<?php echo $e['idsub_inventory'] ?>" disabled></div>
                        </div>
                    </div>

                    <div>
                        <div class="form-group"><label class="col-sm-2 control-label">Sub Inventory</label>
                            <div class="col-sm-6"><input type="text" class="form-control" name="sub_inventory" id="sub_inventory" value="<?php echo $e['sub_inventory'] ?>"></div>
                        </div>

                        <div>
                            <div class="form-group"><label class="col-sm-2 control-label">Jenis Inventory</label>
                                <div class="col-sm-6"><select class="form-control m-b" name="jenis_inv" id="jenis_inv">
                                    </select>
                                </div>
                                <div class="col-sm-4 text-right">
                                    <input type="button" value="Cancel" class="btn btn-m btn-danger" id="batal" onclick="hide()">
                                    <input type="submit" class="btn btn-m btn-success" id="submit" name="submit" value="Submit">
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            </form>
        </div>
    </div>
</div>