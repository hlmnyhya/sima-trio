<div class="wrapper wrapper-content m-t-xl wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row form-horizontal">
                        <div class="col-sm-10">
                            <div>
                                <div class="form-group"><label class="col-sm-2 control-label">Cari inventory Office</label>
                                    <div class="col-sm-10"><input type="text" class="form-control" id="inv"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-2 text-center">
                            <button class="btn btn-w-m btn-success" id="caribtn">Cari Data</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3><i class="fa fa-info-circle"></i> Data Inventory Office</h3>
                </div>
                <div class="panel-body">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example gray-bg">
                                    <thead>
                                        <tr>
                                            <th class="text-center" width="3%">NO</th>
                                            <th class="text-center" width="5%">AKSI</th>
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
                            <div class="text-right"> <span id="pagination"></span></div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
</div>