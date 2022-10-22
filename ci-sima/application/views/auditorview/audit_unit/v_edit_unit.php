<div class="wrapper wrapper-content m-t-xl wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <form method="post" id="FormUnit" class="" action="<?php echo base_url() ?>transaksi_auditor/edit_audit_unit">
                <div class="panel panel-bluedark">
                    <div class="panel-heading">

                        <!-- <form name ="FormUnit" id="FormUnit"> -->
                        <div class="col-lg-10">
                            <h4><i class="fa fa-info-circle"></i> Edit Unit</h4>
                        </div>
                        <div>
                            <a href="<?php echo base_url() ?>" type="submit" class="btn btn-m btn-danger">Batal</a>
                            <button type="submit" class="btn btn-success btn-m" id="btn-simpan">Simpan</button>
                        </div>

                    </div>
                    <div class="panel-body form-horizontal">


                        <div class="form-group">
                            <div class="col-sm-10"><input type="hidden" class="form-control" name="id_unit" id="id_unit" value="<?php echo $edit['id_unit'] ?>" readonly></div>
                        </div>

                        <div class="form-group"><label class="col-sm-2 control-label">No Mesin</label>
                            <div class="col-sm-10"><input type="text" readonly class="form-control" name="no_mesin" id="no_mesin" value="<?php echo $edit['no_mesin'] ?>"></div>
                        </div>


                        <div class="form-group"><label class="col-sm-2 control-label">No Rangka</label>
                            <div class="col-sm-10"><input type="text" readonly class="form-control" name="no_rangka" id="no_rangka" value="<?php echo $edit['no_rangka'] ?>"></div>
                        </div>

                        <div class="hidden"><label class="col-sm-2 control-label">Cabang</label><input type="hidden" class="form-control" name="temp" id="temp" value="<?php echo $edit['id_lokasi'] ?>">
                            <div class="col-sm-10"><input type="text" class="form-control" name="id_cabang" id="id_cabang" value="<?php echo $edit['id_cabang'] ?>"></div>
                        </div>

                        <div class="form-group"><label class="col-sm-2 control-label">Lokasi</label>
                            <div class="col-sm-10"><select class="form-control" name="id_lokasi" id="OptLokasi"></select></div>
                        </div>


                        <div class="form-group"><label class="col-sm-2 control-label">Umur Unit</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="umur_unit" id="umur_unit" value="<?php echo $edit['umur_unit']; ?>">
                                    <div class="input-group-addon">
                                        <span class="">Tahun</span>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group"><label class="col-sm-2 control-label">Tahun</label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="tahun" id="tahun" value="<?php echo $edit['tahun'] ?>"></div>
                        </div>

                        <div class="form-group "><label class="col-sm-2 control-label">Type</label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="type" id="type" value="<?php echo $edit['type'] ?>"></div>
                        </div>

                        <div class="form-group"><label class="col-sm-2 control-label">Kode Item</label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="kode_item" id="kode_item" value="<?php echo $edit['kode_item'] ?>"></div>
                        </div>

                        <div class="form-group"><label class="col-sm-2 control-label">Keterangan</label>
                            <div class="col-sm-10"><select name="keterangan" id="keterangan" class="form-control">
                                    <option value="">--Keterangan--</option>
                                    <option value="Terjual" <?php if ($edit['keterangan'] == 'Terjual') echo 'selected'; ?>>Terjual</option>
                                    <option value="Penjualan Antar Cabang" <?php if ($edit['keterangan'] == 'Penjualan Antar Cabang') echo 'selected'; ?>>Penjualan Antar Cabang</option>
                                    <option value="Mutasi Antar Cabang" <?php if ($edit['keterangan'] == 'Mutasi Antar Cabang') echo 'selected'; ?>>Mutasi Antar Cabang</option>
                                </select></div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Kondisi Unit</label>
                            <div class="col-sm-10"><select name="is_ready" id="is_ready" class="form-control">
                                    <option value="">--Kondisi Unit--</option>
                                    <option value="RFS" <?php if ($edit['is_ready'] == 'RFS') echo 'selected'; ?>>Ready For Sale</option>
                                    <option value="NFRS" <?php if ($edit['is_ready'] == 'NFRS') echo 'selected'; ?>>Not Ready For Sale</option>
                                </select></div>
                        </div>
                        <div id="noready" class="hidden">
                            <div id="rows">
                                <div class="form-group text-center col-sm-12 m-t-md">
                                    <h4>Part#1</h4>
                                </div>
                                <div class="form-group col-sm-5"><label class="col-sm-4 control-label">Part Number</label>
                                    <div class="col-sm-8"><input type="text" class="form-control" name="part_number[]" id="part_number"></div>
                                </div>
                                <div class="form-group col-sm-5"><label class="col-sm-4 control-label">Kondisi Part</label>
                                    <div class="col-sm-8"><select name="kondisi_part[]" id="kondisi_part" class="form-control">
                                            <option value="">--Kondisi Part--</option>
                                            <option value="Patah">Patah</option>
                                            <option value="Pecah">Pecah</option>
                                            <option value="Rusak">Rusak</option>
                                            <option value="Hilang">Hilang</option>
                                        </select></div>
                                </div>
                                <div class="form-group col-sm-5"><label class="col-sm-4 control-label">Keterangan</label>
                                    <div class="col-sm-8"><input type="text" class="form-control" name="ket[]" id="ket"></div>
                                </div>
                                <div class="form-group col-sm-5"><label class="col-sm-4 control-label">Penanggung Jawab</label>
                                    <div class="col-sm-8"><select name="penanggungjawab[]" id="penanggungjawab" class="form-control">
                                            <option value="">--Penanggung Jawab--</option>
                                            <option value="Claim C1/C2">Claim C1/C2</option>
                                            <option value="Claim Main Dealer">Claim Main Dealer</option>
                                            <option value="Pribadi">Pribadi</option>
                                        </select></div>
                                </div>
                                <div class="col-sm-2">
                                    <a name="add" id="add" class="btn btn-success"> <i class="fa fa-plus"></i></a>
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