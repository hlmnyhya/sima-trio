<div class="wrapper wrapper-content m-t-xl wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <form method="post" id="Formpart" class="" action="<?php echo base_url() ?>transaksi_auditor/edit_audit_part">
                <div class="panel panel-bluedark">
                    <div class="panel-heading">

                        <!-- <form name ="Formpart" id="Formpart"> -->
                        <div class="col-lg-10">
                            <h4><i class="fa fa-info-circle"></i> Edit part</h4>
                        </div>
                        <div>
                            <a href="<?php echo base_url() ?>" type="submit" class="btn btn-m btn-danger">Batal</a>
                            <button type="submit" class="btn btn-success btn-m" id="btn-simpan">Simpan</button>
                        </div>

                    </div>
                    <div class="panel-body form-horizontal">


                        <div class="form-group">
                            <div class="col-sm-10"><input type="hidden" class="form-control" name="id_part" id="id_part" value="<?php echo $edit['id_part'] ?>" readonly></div>
                        </div>

                        <div class="form-group"><label class="col-sm-2 control-label">Cabang</label>
                            <div class="col-sm-10"><input type="text" readonly class="form-control" name="id_cabang" id="id_cabang" value="<?php echo $edit['id_cabang'] ?>"></div>
                        </div>


                        <div class="form-group"><label class="col-sm-2 control-label">LOKASI</label>
                        <div class="col-sm-10"><select class="form-control" name="id_lokasi" id="OptLokasi"></select></div>
                        </div>

                        <div class="hidden"><label class="col-sm-2 control-label">PART NUMBER</label><input type="hidden" class="form-control" name="temp" id="temp" value="<?php echo $edit['id_lokasi'] ?>">
                            <div class="col-sm-10"><input type="text" class="form-control" name="part_number" id="part_number" value="<?php echo $edit['part_number'] ?>"></div>
                        </div>

                        <div class="form-group"><label class="col-sm-2 control-label">KD BIN BOX</label>
                        <div class="col-sm-10"><input type="text" class="form-control" name="kd_lokasi_rak" id="kd_lokasi_rak" value="<?php echo $edit['kd_lokasi_rak'] ?>"></div>
                        </div>


                        <div class="form-group"><label class="col-sm-2 control-label">DESKRIPSI</label>
                        <div class="col-sm-10"><input type="text" class="form-control" name="deskripsi" id="deskripsi" value="<?php echo $edit['deskripsi'] ?>"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group"><label class="col-sm-2 control-label">QTY</label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="qty" id="qty" value="<?php echo $edit['qty'] ?>"></div>
                        </div>

                        <div class="form-group "><label class="col-sm-2 control-label">STATUS</label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="status" id="status" value="<?php echo $edit['status'] ?>"></div>
                        </div>
                        <select name="status_unit" class="form-control" id="status">
                                                    <option value="">--- ALL ---</option>
                                                    <option value="Sesuai" id="sesuai">Terjual</option>
                                                    <option value="Belum Sesuai" id="belum_sesuai">Ready For Sale</option>
                                                </select>


                       
                       
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
</div>