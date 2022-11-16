<div class="wrapper wrapper-content m-t-xl wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">

                    <div class="col-lg-10">
                        <h4><i class="fa fa-info-circle"></i> Edit Unit</h4>
                    </div>
                    <div>
                        <a href="<?php echo base_url('audit/input_jadwal') ?>" type="submit" class="btn btn-m btn-danger">Batal</a>
                        <button type="submit" class="btn btn-success btn-m" id="btn-simpan">Simpan</button>
                    </div>

                </div>
                <div class="panel-body">
                    <form method="post" id="FormUnit" class="form-horizontal" action="<?php echo base_url() ?>transaksi_auditor/audit_unit">


                        <div class="form-group">
                            <div class="col-sm-10"><input type="hidden" class="form-control" name="id_unit" id="id_unit" value="<?php echo $edit['id_unit'] ?>" disabled></div>
                        </div>

                        <div class="form-group"><label class="col-sm-2 control-label">No Mesin</label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="no_mesin" id="no_mesin" value="<?php echo $edit['no_mesin'] ?>"></div>
                        </div>


                        <div class="form-group"><label class="col-sm-2 control-label">No Rangka</label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="no_rangka" id="no_rangka" value="<?php echo $edit['no_rangka'] ?>"></div>
                        </div>

                        <div class="form-group"><label class="col-sm-2 control-label">Cabang</label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="id_cabang" id="id_cabang" value="<?php echo $edit['nama_cabang'] ?>"></div>
                        </div>

                        <div class="form-group"><label class="col-sm-2 control-label">Lokasi</label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="id_lokasi" id="id_lokasi" value="<?php echo $edit['nama_lokasi'] ?>"></div>
                        </div>

                        <div class="form-group"><label class="col-sm-2 control-label">Umur Unit</label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="umur_unit" id="umur_unit" value="<?php echo $edit['umur_unit'] ?>"></div>
                        </div>

                        <div class="form-group"><label class="col-sm-2 control-label">Aki</label>
                            <div class="i-checks"><label> <input type="checkbox" value="1"> <i></i> </label></div>
                        </div>

                        <div>
                            <div class="form-group"><label class="col-sm-2 control-label">Spion</label>
                                <div class="i-checks"><label> <input type="checkbox" value="1"> <i></i> </label></div>
                            </div>

                            <div>
                                <div class="form-group"><label class="col-sm-2 control-label">Helm</label>
                                    <div class="i-checks"><label> <input type="checkbox" value="1"> <i></i> </label></div>
                                </div>

                                <div>
                                    <div class="form-group"><label class="col-sm-2 control-label">Tools</label>
                                        <div class="i-checks"><label> <input type="checkbox" value="1"> <i></i> </label></div>
                                    </div>

                                    <div>
                                        <div class="form-group"><label class="col-sm-2 control-label">Buku Servis</label>
                                            <div class="i-checks"><label> <input type="checkbox" value="1"> <i></i></label></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group"><label class="col-sm-2 control-label">Tahun</label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="tahun" id="tahun" value="<?php echo $edit['tahun'] ?>"></div>
                        </div>

                        <div class="form-group"><label class="col-sm-2 control-label">Type</label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="type" id="type" value="<?php echo $edit['type'] ?>"></div>
                        </div>

                        <div class="form-group"><label class="col-sm-2 control-label">Kode Item</label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="kode_item" id="kode_item" value="<?php echo $edit['kode_item'] ?>"></div>
                        </div>

                        <div class="form-group"><label class="col-sm-2 control-label">Foto</label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="foto" id="foto" value="<?php echo $edit['foto'] ?>"></div>
                        </div>

                        <div class="form-group"><label class="col-sm-2 control-label">Keterangan</label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="keterangan" id="keterangan" value="<?php echo $edit['keterangan'] ?>"></div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>