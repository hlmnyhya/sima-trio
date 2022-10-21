<div class="ibox float-e-margins animated fadeInDown">
    <div class="panel panel-success">
        <div class="panel-heading">
            <i class="fa fa-info-circle"></i> Input Cabang
        </div>
            <div class="panel-body">
                <form method="post" class="form-horizontal" id="Formcabang" action="<?php echo base_url() ?>master_data/post_cabang">
                <div>
                <div class="form-group"><label class="col-sm-2 control-label">ID Cabang</label>
                    <div class="col-sm-4"><input type="text" class="form-control" name="id_cabang" id="id_cabang"></div>
                </div>

                <div>
                    <div class="form-group"><label class="col-sm-2 control-label">Nama Cabang</label>
                    <div class="col-sm-6"><input type="text" class="form-control" name="nama_cabang" id="nama_cabang"></div>
      
                    <div class="col-sm-4 text-right">
                        <input type="button" value="Batal" class="btn btn-m btn-danger" id="batal" onclick="hide()">
                        <input type="submit" class="btn btn-m btn-success" id="submit" name="submit" value="Submit"> 
                    </div>
                </div>
                </form>    
        </div>
    <div>
</div>