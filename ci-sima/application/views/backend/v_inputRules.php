<div class="ibox float-e-margins animated fadeInDown">
    <div class="panel panel-success">
        <div class="panel-heading">
            <i class="fa fa-info-circle"></i> Input User Akses
        </div>

        <div class="panel-body">
            <form method="post" id="FormUserAkses" class="form-horizontal" action="<?php echo base_url() ?>menu/post_menuakses">

                <div class="col-sm-8">
                    <div class="form-group"><label class="col-sm-4 control-label">User Group <span id="load1"></span></label>
                        <div class="col-sm-8"><select class="form-control" name="usergroup" id="Optusergroup1"></select></div>
                    </div>

                    <div class="form-group"><label class="col-sm-4 control-label">Menu <span id="load2"></span></label>
                        <div class="col-sm-8"><select class="form-control" name="menu" id="Optmenu1"></select></div>
                    </div>
                </div>
                <div class="col-sm-3 text-right">
                    <input type="button" value="Batal" class="btn btn-m btn-danger" id="batal" onclick="hide()">
                    <input type="submit" class="btn btn-m btn-success" id="submit" name="submit" value="Submit">
                </div>

            </form>
        </div>
    </div>
</div>