<div class="ibox float-e-margins animated fadeInDown">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <i class="fa fa-info-circle"></i> Input Jenis Audit
        </div>
        <?php
        $noUrut = $code;
        $noUrut++;

        $id = "JA" . sprintf("%03s", $noUrut);
        ?>
        <div class="panel-body">
            <form method="post" class="form-horizontal" id="FormJenisAudit" action="<?php echo base_url() ?>master_data/post_jenis_audit">
                <div>
                    <div class="form-group"><label class="col-sm-2 control-label">ID Jenis Audit</label>
                        <div class="col-sm-4"><input type="text" class="form-control" name="idjenis_audit" id="idjenis_audit" value="<?php echo $id; ?>"></div>
                    </div>

                    <div>
                        <div class="form-group"><label class="col-sm-2 control-label">Nama Jenis Audit</label>
                            <div class="col-sm-6"><input type="text" class="form-control" name="jenis_audit" id="jenis_audit"></div>

                            <div class="col-sm-4 text-right">
                                <input type="button" value="Cancel" class="btn btn-m btn-danger" id="batal" onclick="hide()">
                                <input type="submit" class="btn btn-m btn-success" id="submit" name="submit" value="Submit">
                            </div>
                        </div>
            </form>
        </div>
    </div>
</div>