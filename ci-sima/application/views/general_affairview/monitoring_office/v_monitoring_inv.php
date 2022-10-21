<div class="wrapper wrapper-content m-t-xl wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="form-group">
                        <div class="col-sm-2"><label>Cari Inventory Office</label></div>
                        <div class="col-sm-8"><input type="text" class="form-control" id="inv"></div>
                        <div class="col-sm-2 text-center"><button class="btn btn-w-m btn-success" id="caribtn">Cari Data</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12" id="data_input">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">

                    <div class="col-lg-11">
                        <h3><i class="fa fa-info-circle"></i> List Data Office</h3>
                    </div>
                    <div>
                        <a href="<?php echo base_url() ?>transaksi/management_office" value="Add Data" id="add" name="add" class="btn btn-success"> Add Data </a>
                    </div>


                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th class="text-center" width="3%">NO</th>
                                    <th class="text-center" width="8%">AKSI</th>
                                    <th class="text-center">ID INVENTORY OFFICE</th>
                                    <th class="text-center">JENIS INVENTORY</th>
                                    <th class="text-center">SUB INVENTORY</th>
                                    <th class="text-center">NILAI AWAL</th>
                                    <th class="text-center">TANGGAL BARANG DITERIMA</th>
                                    <th class="text-center">VENDOR</th>
                                    <th class="text-center">PEMBAYARAN</th>
                                    <th class="text-center">LOKASI</th>
                                    <th class="text-center">PENGGUNA</th>
                                    <th class="text-center">KETERANGAN</th>

                                </tr>
                            </thead>
                            <tbody id="inv_office">
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-center">NO</th>
                                    <th class="text-center">AKSI</th>
                                    <th class="text-center">ID INVENTORY OFFICE</th>
                                    <th class="text-center">JENIS INVENTORY</th>
                                    <th class="text-center">SUB INVENTORY</th>
                                    <th class="text-center">NILAI AWAL</th>
                                    <th class="text-center">TANGGAL BARANG DITERIMA</th>
                                    <th class="text-center">VENDOR</th>
                                    <th class="text-center">PEMBAYARAN</th>
                                    <th class="text-center">LOKASI</th>
                                    <th class="text-center">PENGGUNA</th>
                                    <th class="text-center">KETERANGAN</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div id="pagination" class="text-right"></div>
                </div>
            </div>
        </div>
    </div>

</div>