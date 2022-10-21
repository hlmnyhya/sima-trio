<div class="ibox float-e-margins animated fadeInDown">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <i class="fa fa-info-circle"></i> Edit Data Jenis Audit
        </div>

        <div class="panel-body">
            <form method="post" id="FormJenisAudit" class="form-horizontal" action="<?php echo base_url() ?>master_data/put_jenisaudit">
                <?php foreach ($edit as $e) : ?>

                    <div>
                        <div class="form-group"><label class="col-sm-2 control-label">ID Jenis Audit</label>
                            <input type="hidden" class="form-control" name="idjenis_audit" id="idjenis_audit" value="<?php echo $e['idjenis_audit'] ?>">
                            <div class="col-sm-4"><input type="text" class="form-control" value="<?php echo $e['idjenis_audit'] ?>" disabled></div>
                        </div>
                    </div>

                    <div>
                        <div class="form-group"><label class="col-sm-2 control-label">Jenis Audit</label>
                            <div class="col-sm-6"><input type="text" class="form-control" name="jenis_audit" id="jenis_audit" value="<?php echo $e['jenis_audit'] ?>"></div>


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