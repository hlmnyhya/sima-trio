<div class="wrapper wrapper-content m-t-xl wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url('transaksi_ga/post_inventory') ?>" id="FormInventory">
                <div class="panel panel-default">
                    <div class="panel-heading">

                        <div class="col-lg-10">
                            <h4>Mutasi Inventory</h4>
                        </div>
                        <div>
                            <a href="<?php echo base_url('transaksi/monitoring_office') ?>" type="submit" class="btn btn-m btn-danger">Batal</a>
                            <button type="submit" class="btn btn-success btn-m" id="btn-simpan">Simpan</button>
                        </div>

                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group"><label class="col-sm-3 control-label">ID Inventory</label>
                                    <div class="col-sm-9"><input type="text" class="form-control" name="id_inventory" id="id_inventory" /></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="col-sm-3">
                                    <a class="btn btn-warning" onclick="search()"><i class="fa fa-search"></i> </a><span id="load2"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row col-sm-6 ">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="col-sm-12">
                                        <div class="form-group"><label class="col-sm-3 control-label">Cabang</label>
                                            <div class="col-sm-9"><input type="text" class="form-control" name="id_cabang" id="id_cabang" disabled></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group"><label class="col-sm-3 control-label">Lokasi <span id="load"></span></label>
                                            <div class="col-sm-9"><input type="text" class="form-control" name="id_lokasi" id="id_lokasi" disabled></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group"><label class="col-sm-3 control-label">Jenis Inventory</label>
                                            <div class="col-sm-9"><input class="form-control m-b" name="idjenis_inventory" id="OptJenisInv" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group"><label class="col-sm-3 control-label">Sub Inventory <span id="load1"></span></label>
                                            <div class="col-sm-9"><input class="form-control m-b" name="idsub_inventory" id="OptSubInv" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group"><label class="col-sm-3 control-label">Merk</label>
                                            <div class="col-sm-9"><input type="text" name="merk" class="form-control" id="merk" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row col-sm-6">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="col-sm-12">
                                        <div class="form-group"><label class="col-sm-3 control-label">ID Mutasi</label>
                                            <div class="col-sm-9"><input type="text" class="form-control" name="id_mutasi" id="id_mutasi" readonly /></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group"><label class="col-sm-3 control-label">Cabang</label>
                                            <div class="col-sm-9"><select class="form-control m-b" name="id_cabang" id="OptCabang">
                                                </select></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group"><label class="col-sm-3 control-label">Lokasi <span id="load"></span></label>
                                            <div class="col-sm-9"><select class="form-control m-b" name="id_lokasi" id="OptLokasi" disabled>
                                                </select></div>
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