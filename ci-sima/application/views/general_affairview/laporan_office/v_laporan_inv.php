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
                                        </div>
                                    </div>        
                                </div>        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    -->

    <div class="row">
        <div class="col-lg-112">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3><i class="fa fa-info-circle"></i> Data Inventory</h3>
                    <span id="info_message"></span>
                </div>
                <div class="panel-body">
<<<<<<< HEAD
=======
                    <form id="FormLap" action="<?php echo base_url() ?>laporan_ga/cetaklaporan" method="post">
>>>>>>> 26b4e7dcdb4f4be1f62f381801c56b5ec18f2600
                        <div class="row">
                                <div class="col-sm-2"><label>Cari Inventory Office</label></div>
                                 <div class="col-sm-8"><input type="text" class="form-control" id="inv"></div>
                                 <div class="col-sm-2 text-center"><button class="btn btn-w-m btn-success" id="caribtn">Cari Data</button>
                                    <div class="form-group">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2 form-group">
                                    <div class="form-group">
                                        <div class="col-sm-9">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                    </form>
                    <hr size="100px">
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="table-responsive">
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