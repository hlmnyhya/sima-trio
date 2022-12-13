<div class="wrapper wrapper-content m-t-xl animated fadeIn">
    <!-- <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    <h4><i class="fa fa-info-circle"></i> Pencarian Data Berdasarkan Lokasi Cabang</h4>
                    </div>
                    <div class="panel-body">
                        <div class="row form-horizontal">
                            <div class="col-sm-7">
                                <div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Cabang</label>
                                        <div class="col-sm-9"><select name="id_cabang" class="form-control" id="OptCabang"></select>
</LJLK>
                                    </div>        
                                </div>        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3><i class="fa fa-info-circle"></i> Data Inventory</h3>
                    <span id="info_message"></span>
                </div>
                <div class="panel-body">
                    <form id="FormLap" method="post">
                        <div class="row">
                                <div class="col-sm-2"><label>Cari Inventory Office</label></div>
                                 <div class="col-sm-7"><input type="text" class="form-control" id="inv"></div>
                                    <div class="row">
                                        <div class="col-1 text-center">
                                         <button class="btn btn-w-m btn-success" id="caribtn">Cari Data</button>
                                         <button class="btn btn-w-m btn-danger" id="caribtn"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF</button>
                                        </div>
                                    </div>
                        </div>
                                 <!-- <div class="col-sm-1 text-center"><button class="btn btn-w-m btn-warning" id="caribtn">Cari Data</button> -->
                                    <div class="form-group">
                                </div>
                                
                            </div>
                        
                    </form>
                    <hr size="100px">
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="table-responsive col-sm-12">
                                <table class="table table-striped table-bordered table-hover dataTables-example gray-bg">
                                    <thead>
                                        <tr>
                                            <th class="text-center" width="3%">No</th>
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
                                        <th class="text-center" width="3%">No</th>
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
                            </div>
                        </div>

                    </div>
                    <div class="text-right" id="pagination"></div>
                </div>
            </div>
        </div>
    </div>

</div>