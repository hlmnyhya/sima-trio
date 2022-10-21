<div class="wrapper wrapper-content m-t-xl wrapper wrapper-content animated fadeInRight">
    <form class="form-horizontal" method="post" action="<?php echo base_url('transaksi_auditor/audit_unit') ?>" id="FormJadwalAudit">
    <div class="panel panel-primary">
        <div class="panel-heading" >
            <div class="col-lg-10" ><h4><i class="fa fa-info-circle"></i> Manual Audit</h4></div>
                        <div >
                        <a href="<?php echo base_url('master_data/input_management_inv') ?>" type="submit" class="btn btn-m btn-danger">Batal</a>
                        <button type="submit" class="btn btn-success btn-m" id="btn-simpan">Simpan</button>                        
                        </div>
        </div>

            <div class="panel-body">
                <!-- <div class="row">
                <div class="col-lg 12">
                <div class="panel-body">
                        <div class="form-group"><label class="col-sm-2 control-label">Data Unit </label>
                        <div class="col-sm-7"><input type="text" class="form-control" placeholder="Masukkan No Mesin/ No Rangka"></div>
                        <div>
                        <button class="btn btn-success btn-m" id="getdata" name="getdata" onclick="show()">Get Data</button>
                        </div>
                        </div>

                                <div class="text-right col-sm-11 ">
                                <button class="btn btn-info btn-w-m ">Preview Data</button>
                                </div>
                </div>
                </div>
                </div>
            <hr size="10px">
 -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel-body" id="show()">
                        <form method="post" class="form-horizontal" id="Formcabang" action="<?php echo base_url() ?>transaksi_auditor/post_manual">
                        
                        <div>
                        <!-- <div class="form-group"><label class="col-sm-2 control-label">ID Unit</label>
                            <div class="col-sm-4"><input type="text" class="form-control" name="id_unit" id="id_unit"></div>
                        </div> -->

                        <div class="form-group"><label class="col-sm-2 control-label">No Mesin</label>
                            <div class="col-sm-4"><input type="text" class="form-control" name="no_mesin" id="no_mesin" onkeyup="isi_otomatis()"></div>
                           <!--  <div class="col-sm-6"><button type="button" class="btn btn-success" id="btn-cari">Cari</button> <span id="loading">LOADING...</span></div> -->
                        </div>

                        <div class="form-group"><label class="col-sm-2 control-label">No Rangka</label>
                            <div class="col-sm-4"><input type="text" class="form-control" name="no_rangka" id="no_rangka"></div>
                        </div>

                        <div class="form-group"><label class="col-sm-2 control-label">Lokasi</label>
                            <div class="col-sm-4"><input type="text" class="form-control" name="id_lokasi" id="id_lokasi"></div>
                        </div>

                        <div class="form-group"><label class="col-sm-2 control-label">Kode Item</label>
                            <div class="col-sm-4"><input type="text" class="form-control" name="kode_item" id="kode_item"></div>
                        </div>

                        <div class="form-group"><label class="col-sm-2 control-label">Type Unit</label>
                            <div class="col-sm-4"><input type="text" class="form-control" name="type_unit" id="type_unit"></div>
                        </div>

                        <div>
                            <div class="form-group"><label class="col-sm-2 control-label">Usia Unit</label>
                            <div class="col-sm-4"><input type="text" class="form-control" name="usia_unit" id="usia_unit"></div>
                        </div>

                        <div>
                       
                        <div class="form-group"><label class="col-sm-6 control-label">Kelengkapan</label></div>
                        </div>
                        </div>
                        
                        <div >

                        <div class="form-group"><label class="col-sm-2 control-label">Aki</label>
                        <div class="i-checks"><label> <input type="checkbox" value="1"> <i></i> </label></div>
                        </div> 

                        <div >
                        <div class="form-group"><label class="col-sm-2 control-label">Spion</label>
                        <div class="i-checks"><label> <input type="checkbox" value="1"> <i></i> </label></div>
                        </div> 

                        <div >
                        <div class="form-group"><label class="col-sm-2 control-label">Helm</label>
                        <div class="i-checks"><label> <input type="checkbox" value="1"> <i></i> </label></div>
                        </div> 

                        <div >
                        <div class="form-group"><label class="col-sm-2 control-label">Tools</label>
                        <div class="i-checks"><label> <input type="checkbox" value="1"> <i></i> </label></div>
                        </div> 

                        <div >
                        <div class="form-group"><label class="col-sm-2 control-label">Buku Servis</label>
                        <div class="i-checks"><label> <input type="checkbox" value="1"> <i></i></label></div>
                        </div>  

                        <div>
                            <div class="form-group"><label class="col-sm-2 control-label">Ready</label>
                            <div class="col-sm-4">
                            <select name="status_unit" class="form-control" id="status">
                            <option value="hide">--- Pilih Status Ready Unit ---</option>
                            <option value="Unit Ready" id="unit_ready">Unit Ready</option>
                            <option value="Unit Not Ready" id="unit_not_ready">Unit Not Ready</option>
                            </select>
                            </div>      
                            </div>
                        </div>
            </div>
        </div>
    </div>
</div>
</div>
          </div>      
                        
                </form>     
                    </div>
                </div>
                


</div>
</div>
</div>
</form>
</div>