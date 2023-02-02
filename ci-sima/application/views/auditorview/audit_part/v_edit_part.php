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
                            <div class="col-sm-10">
                                <input type="hidden" class="form-control" name="id_part" id="id_part"  value="<?php echo $edit_part['id_part'] ?>" readonly></input>
                            </div>
                        </div>

                        <div class="form-group"><label class="col-sm-2 control-label">Cabang</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control" name="id_cabang" id="id_cabang" value="<?php echo $edit_part['id_cabang'] ?>">
                            </input>
                            </div>
                        </div>

                        <div class="form-group"><label class="col-sm-2 control-label">LOKASI</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="id_lokasi" id="OptLokasi"  value="<?php echo $edit_part['id_lokasi'] ?>"> </select>
                      </div>
                        </div>

                        

                        <div class="form-group"><label class="col-sm-2 control-label">DESKRIPSI</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="deskripsi" id="deskripsi" value="<?php echo $edit_part['deskripsi'] ?>">
                        </div>
                        </div>

                        <div class="form-group" ><label class="col-sm-2 control-label">PART NUMBER</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="part_number" id="part_number" value="<?php echo $edit_part['part_number'] ?>">
                        </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Rak Bin Lama</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="kd_lokasi_rak" id="kd_lokasi_rak" value="<?php  echo  $edit_part['kd_lokasi_rak'] ?>"></select>
                        </div>
                        </div>
                        <div class="form-group" id="rakbin_baru">
                                <label class="col-sm-2 control-label">Rak Bin Baru </label>
                                 <div class="col-sm-6">
                                     <select  class="form-control" name="id-rakbin" id="id_rakbin" ></select>
                                </div>
                                 <div class="col-sm-4">
                                            <?php 
                                                $link = base_url("master_data/viewRakbinBaru"); 
                                            ?>
                                         <a id="add" class="btn btn-primary" onclick="
                                            myWindow = window.open('<?php echo $link ?>', 'myWindow', 'width=800, height=600');
                                            " >Tambah Rakbin</a>
                                    </div>
                                 </div>
                                            

                        <div class="form-group"><label class="col-sm-2 control-label">QTY Simande</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="qty" id="qty" value="<?php echo $edit_part['qty'] ?>">
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">QTY Fisik</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="qty_fsk" id="qty_fsk" value="<?php echo $edit_part['qty_fsk'] ?>">
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Selisih</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="selisih" id="selisih" value="<?php echo $edit_part['selisih'] ?>">
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">amount</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="amount" id="amount" value="<?php echo $edit_part['amount'] ?>">
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">HET</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="harga_jual" id="harga_jual" value="<?php echo $edit_part['harga_jual'] ?>">
                            </div>
                        </div>

                        <div class="form-group "><label class="col-sm-2 control-label">KETERANGAN</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="keterangan" id="keterangan" >
                                    <option value="">--Keterangan--</option>
                                    <option value="Part Sesuai" <?php if ($edit_part['keterangan'] == 'Part Sesuai') echo 'selected' ?>>Part Sesuai</option>
                                    <option value="Part Lebih" <?php if ($edit_part['keterangan'] == 'Part Lebih') echo 'selected' ?>>Part Lebih</option>
                                    <option value="Part Kurang" <?php if ($edit_part['keterangan'] == 'Part Kurang') echo 'selected' ?>>Part Kurang</option>
                                </select>
                                <!-- <input type="text" class="form-control" name="keterangan" id="keterangan" value="<?php echo $edit_part['keterangan'] ?>"> -->
                            </div>
                        </div>

                        <div class="form-group "><label class="col-sm-2 control-label">STATUS</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="status" id="status" >
                                    <option value="">--Status--</option>
                                    <option value="Sesuai" <?php if ($edit_part['status'] == 'Sesuai') echo 'selected' ?>>Sesuai</option>
                                    <option value="Tidak Ditemukan" <?php if ($edit_part['status'] == 'Tidak Ditemukan') echo 'selected' ?>>Tidak Ditemukan</option>
                                </select>
                                <!-- <input type="text" class="form-control" name="status" id="status" value="<?php echo $edit_part['status'] ?>"> -->
                            </div>
                        </div>
                        <div class="form-group "><label class="col-sm-2 control-label">KONDISI</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="kondisi" id="kondisi" >
                                    <option value="">--Kondisi--</option>
                                    <option value="Baik" <?php if ($edit_part['kondisi'] == 'Baik') echo 'selected' ?>>Baik</option>
                                    <option value="Rusak" <?php if ($edit_part['kondisi'] == 'Rusak') echo 'selected' ?>>Rusak</option>
                                </select>
                                <!-- <input type="text" class="form-control" name="kondisi" id="kondisi" value="<?php echo $edit_part['kondisi'] ?>">
                            </div> -->
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