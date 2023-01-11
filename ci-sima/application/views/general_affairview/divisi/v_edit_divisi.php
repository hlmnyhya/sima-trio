<div class="ibox float-e-margins animated fadeInDown">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <i class="fa fa-info-circle"></i> Edit Data Divisi
        </div>

        <div class="panel-body">
            <form method="post" id="FormDivisi" class="form-horizontal" action="<?php echo base_url() ?>divisi/edit_divisi">
                <?php foreach ($edit as $e) : ?>
                    <div>
                        <div class="form-group"><label class="col-sm-2 control-label">ID Divisi</label>
                            <input type="hidden" class="form-control" name="id_divisi" id="id_divisi" value="<?php echo $e['id_divisi'] ?>">
                            <div class="col-sm-4"><input type="text" class="form-control" value="<?php echo $e['id_divisi'] ?>"></div>
                        </div>
                    </div>

                    <div>
                        <div class="form-group"><label class="col-sm-2 control-label">Divisi</label>
                            <div class="col-sm-6"><input type="text" class="form-control" name="divisi" id="divisi" value="<?php echo $e['divisi'] ?>"></div>


                            <div class="col-sm-4 text-right">
                                <input type="button" value="Batal" class="btn btn-m btn-danger" id="batal" onclick="hide()">
                                <input type="submit" class="btn btn-m btn-success" id="submit" name="submit" value="Submit">
                            </div>
                        </div>
                    <?php endforeach; ?>
            </form>
        </div>
    </div>
</div>