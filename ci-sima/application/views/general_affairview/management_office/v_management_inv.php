<div class="wrapper wrapper-content m-t-xl wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url('transaksi_ga/post_inventory') ?>" id="FormInventory">
                <div class="panel panel-primary">
                    <div class="panel-heading">

                        <div class="col-lg-10">
                            <h4><i class="fa fa-info-circle"></i> Input Inventory</h4>
                        </div>
                        <div>
                            <a href="<?php echo base_url('transaksi/monitoring_office') ?>" type="submit" class="btn btn-m btn-danger">Cancel</a>
                            <button type="submit" class="btn btn-success btn-m" id="btn-simpan">Submit</button>
                        </div>

                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group"><label class="col-sm-3 control-label">ID Inventory</label>
                                    <div class="col-sm-9"><input type="text" class="form-control" name="id_inventory" id="id_inventory" readonly /></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="col-sm-3">
                                    <a class="btn btn-warning" onclick="generate()">Generate </a><span id="load2"></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group"><label class="col-sm-3 control-label">Status Inventory</label>
                                <div class="col-sm-9"><select class="form-control m-b" name="idstatus_inventory" id="OptStatusInv">

                                    </select>
                                </div>
                            </div>

                            <div class="form-group"><label class="col-sm-3 control-label">Jenis Inventory</label>
                                <div class="col-sm-9"><select class="form-control m-b" name="idjenis_inventory" id="OptJenisInv">

                                    </select>
                                </div>
                            </div>

                            <div class="form-group"><label class="col-sm-3 control-label">Sub Inventory <span id="load1"></span></label>
                                <div class="col-sm-9"><select class="form-control m-b" name="idsub_inventory" id="OptSubInv" disabled>

                                    </select>
                                </div>
                            </div>


                            <div class="form-group"><label class="col-sm-3 control-label">Nilai Awal</label>
                                <div class="col-sm-9"><input type="text" class="form-control" name="nilai_awal" id="nilai_awal" readonly>
                                    <span class="help-block m-b-none">* Harga Sebelum PPn</span>
                                </div>
                            </div>

                            <div class="form-group"><label class="col-sm-3 control-label">DDP</label>
                                <div class="col-sm-9"><input type="text" class="form-control" name="ddp" id="dpp">
                                </div>
                            </div>

                            <div class="form-group"><label class="col-sm-3 control-label">Nilai Asset</label>
                                <div class="col-sm-6"><input type="text" class="form-control" name="nilai_asset" id="nilai_asset">
                                </div>
                                <div class="col-sm-2"><a onclick="hitung()" class="btn btn-primary"> Hitung</a></div>
                            </div>

                            <div class="form-group"><label class="col-sm-3 control-label">Nilai Total Keseluruhan</label>
                                <div class="col-sm-9"><input type="text" class="form-control" name="nilai_total_keseluruhan">
                                </div>
                            </div>

                            <div class="form-group" id="data_1"><label class="col-sm-3 control-label">Tanggal Barang Terima</label>
                                <div class="col-sm-9">
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="text" class="form-control" name="tanggal_barang_terima" id="tanggal_barang_terima">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group"><label class="col-sm-3 control-label">Vendor</label>
                                <div class="col-sm-9"><select class="form-control m-b" name="id_vendor" id="OptVendor">
                                    </select>
                                </div>
                            </div>


                            <div class="form-group"><label class="col-sm-3 control-label">Jenis Pembayaran</label>
                                <div class="col-sm-9"><select class="form-control m-b" name="jenis_pembayaran" id="OptJenisPemb">
                                        <option value="">--- Pilih Jenis Pembayaran ---</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Kredit">Kredit</option>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group"><label class="col-sm-3 control-label">Cabang</label>
                                <div class="col-sm-9"><select class="form-control m-b" name="id_cabang" id="OptCabang">
                                    </select>
                                </div>
                            </div>


                            <div class="form-group"><label class="col-sm-3 control-label">Lokasi <span id="load"></span></label>
                                <div class="col-sm-9"><select class="form-control m-b" name="id_lokasi" id="OptLokasi" disabled>
                                    </select>

                                </div>
                            </div>


                            <div class="form-group"><label class="col-sm-3 control-label">Pengguna</label>
                                <div class="col-sm-9"><input type="text" class="form-control" name="nama_pengguna">
                                </div>
                            </div>

                            <div class="form-group"><label class="col-sm-3 control-label">Keterangan</label>
                                <div class="col-sm-9"><input type="text" class="form-control" name="keterangan">
                                </div>
                            </div>

                        </div>



                        <div class="col-sm-6">

                            <div class="form-group"><label class="col-sm-3 control-label">Stok</label>
                                <div class="col-sm-9"><select class="form-control m-b" name="stok" id="stok">
                                        <option value="YA">YA</option>
                                        <option valuer="TIDAK">TIDAK</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group"><label class="col-sm-3 control-label">Foto</label>
                                <div class="col-sm-9">
                                    <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                        <div class="form-control" data-trigger="fileinput">
                                            <span class="fileinput-filename"></span>
                                        </div>
                                        <span class="input-group-addon btn btn-default btn-file">
                                            <span class="fileinput-new">Select file</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="file" name="foto" id="foto" accept="image/x-png,image/gif,image/jpeg" />
                                        </span>
                                        <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                    </div>
                                </div>
                                <div class="col-sm-9 pull-right">
                                    <div class="img_preview">
                                        <div id="image">
                                            <div id="loading"></div>
                                        </div>
                                        <img src="" id="img_preview">
                                    </div>
                                </div>
                            </div>

                            <div id="hadiah" class="hidden"><label class="col-sm-3 control-label">Asal Hadiah</label>
                                <div class="col-sm-9"><input type="text" class="form-control" name="asal_hadiah" id="asal_hadiah">
                                </div>
                            </div>


                            <div class="form-group"><label class="col-sm-3 control-label">PPn</label>
                                <div class="col-sm-9"><input type="text" class="form-control" name="ppn" id="ppn">
                                </div>
                            </div>

                            <div class="form-group"><label class="col-sm-6 control-label">Apakah Menggunakan PPn atau Tidak?</label>
                                <div class="col-sm-6"><select class="form-control m-b" name="ket_ppn" id="ket_ppn">
                                        <option value="YA">YA</option>
                                        <option valuer="TIDAK">TIDAK</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group"><label class="col-sm-3 control-label">Merk</label>
                                <div class="col-sm-9"><input type="text" class="form-control" name="merk" id="merk">
                                </div>
                            </div>

                            <div class="form-group"><label class="col-sm-3 control-label">Aksesoris Tambahan</label>
                                <div class="col-sm-9"><input type="text" class="form-control" name="aksesoris_tambahan">
                                </div>
                            </div>
                            <div id="elec" class="hidden">
                                <div class="form-group"><label class="col-sm-3 control-label">Serial Number</label>
                                    <div class="col-sm-9"><input type="text" class="form-control" name="serial_number">
                                    </div>
                                </div>
                            </div>
                            <div id="oto" class="hidden">
                                <div class="form-group"><label class="col-sm-3 control-label">No. Mesin</label>
                                    <div class="col-sm-9"><input type="text" class="form-control" name="no_mesin" id="no_mesin">
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-3 control-label">No. Rangka</label>
                                    <div class="col-sm-9"><input type="text" class="form-control" name="no_rangka" id="no_rangka">
                                    </div>
                                </div>
                            </div>
                            <div id="kredit" class="hidden">
                                <div class="form-group"><label class="col-sm-3 control-label">Uang Muka</label>
                                    <div class="col-sm-9"><input type="text" class="form-control" name="uang_muka" id="uang_muka">
                                    </div>
                                </div>

                                <div class="form-group"><label class="col-sm-3 control-label">Cicilan Perbulan</label>
                                    <div class="col-sm-9"><input type="text" class="form-control" name="cicilan_perbulan" id="cicilan_perbulan">
                                    </div>
                                </div>

                                <div class="form-group"><label class="col-sm-3 control-label">Tenor</label>
                                    <div class="col-sm-2"><input type="text" class="form-control" name="tenor" id="tenor">
                                    </div>
                                    <div class="col-sm-2">
                                        <label class="control-label text-left">/bln</label>
                                    </div>
                                    <div class="col-sm-5">
                                        <a id="total" class="btn btn-primary"> Hitung</a>
                                    </div>
                                </div>

                                <div class="form-group"><label class="col-sm-3 control-label">Nilai Total</label>
                                    <div class="col-sm-9"><input type="text" class="form-control" name="nilai_total" id="nilai_total" readonly>
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