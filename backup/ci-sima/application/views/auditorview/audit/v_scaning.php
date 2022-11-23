<div class="wrapper wrapper-content m-t-xl wrapper wrapper-content animated fadeInRight">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="col-lg-10">
                <h4><i class="fa fa-info-circle"></i> Unit</h4>
            </div>
            <div>
                <a href="<?php echo base_url('master_data/input_management_inv') ?>" type="submit" class="btn btn-m btn-danger">Batal</a>
                <button type="submit" class="btn btn-success btn-m" id="btn-simpan">Simpan</button>
            </div>
        </div>
        <div class="panel-body">
            <form method="post" class="form-horizontal" id="Formcabang" action="<?php echo base_url() ?>audit/post_manual">
                <div>
                    <!-- <div class="form-group"><label class="col-sm-2 control-label">ID Unit</label>
                    <div class="col-sm-4"><input type="text" class="form-control" name="id_unit" id="id_unit" ></div>
                </div> -->

                    <div class="form-group"><label class="col-sm-2 control-label">No Mesin</label>
                        <div class="col-sm-4"><input type="text" class="form-control" name="no_mesin" id="no_mesin"></div>
                    </div>

                    <div class="form-group"><label class="col-sm-2 control-label">No Rangka</label>
                        <div class="col-sm-4"><input type="text" class="form-control" name="no_rangka" id="no_rangka"></div>
                    </div>

                    <div class="form-group"><label class="col-sm-2 control-label">Lokasi</label>
                        <div class="col-sm-4"><input type="text" class="form-control" name="id_lokasi" id="id_lokasi" readonly></div>
                    </div>

                    <div class="form-group"><label class="col-sm-2 control-label">Type Unit</label>
                        <div class="col-sm-4"><input type="text" class="form-control" name="type_unit" id="type_unit" readonly></div>
                    </div>


                    <div>
                        <div class="form-group"><label class="col-sm-2 control-label">Usia Unit</label>
                            <div class="col-sm-4"><input type="text" class="form-control" name="usia_unit" id="usia_unit" readonly></div>
                        </div>

                        <div>

                            <div class="form-group"><label class="col-sm-6 control-label">Kelengkapan</label></div>
                        </div>
                    </div>

                    <div>
                        <div class="form-group"><label class="col-sm-2 control-label"></label>
                            <div class="i-checks"><label> <input type="checkbox" value=""> <i></i> Aki</label></div>
                        </div>

                        <div>
                            <div class="form-group"><label class="col-sm-2 control-label"></label>
                                <div class="i-checks"><label> <input type="checkbox" value=""> <i></i> Spion</label></div>
                            </div>

                            <div>
                                <div class="form-group"><label class="col-sm-2 control-label"></label>
                                    <div class="i-checks"><label> <input type="checkbox" value=""> <i></i> Helm</label></div>
                                </div>

                                <div>
                                    <div class="form-group"><label class="col-sm-2 control-label"></label>
                                        <div class="i-checks"><label> <input type="checkbox" value=""> <i></i> Tools</label></div>
                                    </div>

                                    <div>
                                        <div class="form-group"><label class="col-sm-2 control-label"></label>
                                            <div class="i-checks"><label> <input type="checkbox" value=""> <i></i> Buku Servis</label></div>
                                        </div>

            </form>
        </div>
        <div>
        </div>