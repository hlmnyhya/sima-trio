<div class="ibox float-e-margins animated fadeInDown">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <i class="fa fa-info-circle"></i> Edit Data User Group
        </div>

        <div class="panel-body">
            <form method="post" id="FormUsergroup" class="form-horizontal" action="<?php echo base_url() ?>master_data/put_usergroup">
                <?php foreach ($edit as $e) : ?>
                    <div>
                        <div class="form-group"><label class="col-sm-2 control-label">ID User Group</label>
                            <input type="hidden" class="form-control" name="id_usergroup" id="id_usergroup" value="<?php echo $e['id_usergroup'] ?>">
                            <div class="col-sm-4"><input type="text" class="form-control" value="<?php echo $e['id_usergroup'] ?>" disabled></div>
                        </div>
                    </div>

                    <div>
                        <div class="form-group"><label class="col-sm-2 control-label">User Group</label>
                            <div class="col-sm-6"><input type="text" class="form-control" name="user_group" id="user_group" value="<?php echo $e['user_group'] ?>"></div>


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