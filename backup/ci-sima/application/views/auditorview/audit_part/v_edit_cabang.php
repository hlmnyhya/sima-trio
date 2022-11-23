
<div class="ibox float-e-margins animated fadeInDown">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <i class="fa fa-info-circle"></i> Edit Data cabang
            </div>
            
            <div class="panel-body">
                <form method="post" id="FormCabang" class="form-horizontal" action="<?php echo base_url() ?>master_data/put_cabang">
                <?php foreach($edit as $e):?>
                    <div>
                        <div class="form-group"><label class="col-sm-2 control-label">ID Cabang</label>
                        <input type="hidden" class="form-control" name="id_cabang" id="id_cabang" value="<?php echo $e['id_cabang'] ?>">
                           <div class="col-sm-4"><input type="text" class="form-control" value="<?php echo $e['id_cabang'] ?>" disabled></div>
                        </div>
                    </div>

                    <div>
                        <div class="form-group"><label class="col-sm-2 control-label">Cabang</label>
                            <div class="col-sm-6"><input type="text" class="form-control" name="nama_cabang" id="nama_cabang" value="<?php echo $e['nama_cabang'] ?>"></div>
                        
                                
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