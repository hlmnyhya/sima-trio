<div class="ibox float-e-margins animated fadeInDown">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <i class="fa fa-info-circle"></i> Input Vendor
        </div>
        <?php
        $noUrut = $code;
        $noUrut++;

        $id = "VE" . sprintf("%03s", $noUrut);
        ?>
        <div class="panel-body">
            <form method="post" id="FormVendor" class="form-horizontal" action="<?php echo base_url() ?>master_data/post_vendor">
                <div>
                    <div class="form-group"><label class="col-sm-2 control-label">ID Vendor</label>
                        <div class="col-sm-4"><input type="text" class="form-control" name="id_vendor" id="id_vendor" value="<?php echo $id; ?>"></div>
                    </div>

                    <div>
                        <div class="form-group"><label class="col-sm-2 control-label">Vendor</label>
                            <div class="col-sm-6"><input type="text" class="form-control" name="nama_vendor" id="nama_vendor"></div>

                            <div class="col-sm-4 text-right">
                                <input type="button" value="Cancel" class="btn btn-m btn-danger" id="batal" onclick="hide()">
                                <input type="submit" class="btn btn-m btn-success" id="submit" name="submit" value="Submit">
                            </div>
                        </div>
            </form>
        </div>
    </div>
</div>