<div class="ibox float-e-margins animated fadeInDown">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <i class="fa fa-info-circle"></i> Input Status Inventory
        </div>

        <?php
        $noUrut = $code;
        $noUrut++;

        $id = "ST" . sprintf("%03s", $noUrut);
        ?>
        <div class="panel-body">
            <form method="post" id="FormStatusInv" class="form-horizontal" action="<?php echo base_url() ?>master_data/post_status_inv">
                <div>
                    <div class="form-group"><label class="col-sm-2 control-label">ID Status Inventory</label>
                        <div class="col-sm-4"><input type="text" class="form-control" name="idstatus_inventory" id="idstatus_inventory" value="<?php echo $id; ?>" readonly></div>
                    </div>

                    <div>
                        <div class="form-group"><label class="col-sm-2 control-label">Status Inventory</label>
                            <div class="col-sm-6"><input type="text" class="form-control" name="status_inventory" id="status_inventory"></div>



                            <div class="col-sm-4 text-right">
                                <input type="button" value="Cancel" class="btn btn-m btn-danger" id="batal" onclick="hide()">
                                <input type="submit" class="btn btn-m btn-success" id="submit" name="submit" value="Submit">
                            </div>
                        </div>

            </form>
        </div>
    </div>
</div>