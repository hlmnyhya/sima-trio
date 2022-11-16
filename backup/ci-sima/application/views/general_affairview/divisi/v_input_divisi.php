<div class="ibox float-e-margins animated fadeInDown">
    <div class="panel panel-success">
        <div class="panel-heading">
            <i class="fa fa-info-circle"></i> Input Divisi
        </div>
            <div class="panel-body">
                <form method="post" class="form-horizontal" id="FormDivisi" action="<?php echo base_url() ?>divisi/post_divisi">
                <div>
                <div class="form-group"><label class="col-sm-2 control-label">ID Divisi</label>
                    <div class="col-sm-4"><input type="text" class="form-control" name="id_divisi" id="id_divisi"></div>
                </div>

                <div>
                    <div class="form-group"><label class="col-sm-2 control-label">Nama Divisi</label>
                    <div class="col-sm-6"><input type="text" class="form-control" name="divisi" id="divisi"></div>
      
                    <div class="col-sm-4 text-right">
                        <input type="button" value="Batal" class="btn btn-m btn-danger" id="batal" onclick="hide()">
                        <input type="submit" class="btn btn-m btn-success" id="submit" name="submit" value="Submit"> 
                    </div>
                </div>
                </form>    
        </div>
    <div>
</div>