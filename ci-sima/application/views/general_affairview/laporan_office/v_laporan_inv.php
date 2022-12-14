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
                    <form id="FormLap" action="<?php echo base_url(); ?>laporan_ga/cetakInv" method="post">
                        <!-- <div class="row">
                                <! <div class="col-sm-2"><label>Cari Inventory Office</label></div>
                                    <div class="col-sm-7"><input type="text" class="form-control" id="inv"></div>
                                        <div class="row">
                                            <div class="col-1 text-center">
                                            <button class="btn btn-w-m btn-success" id="caribtn">Cari Data</button>
                                            <button class="btn btn-w-m btn-danger" id="caribtn"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF</button>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            <div class="col-sm-2"><label>Cari Inventory Office</label></div>
                                <div class="col-sm-7"><input type="text" class="form-control" id="inv"></div>
                                    <div class="col-sm-3">
                                        <input type="hidden" name="status" id="status" value="Belum Sesuai" />
                                            <a id="caribtn" class="btn btn-success">Cari Data</a>
                                            <button type="submit" class="btn btn-primary" id="type" name="type" value="excel"><i class="fa fa-fw fa-print"></i>Excel</button>
                                            <button type="submit" class="btn btn-danger" id="type" name="type" value="pdf"><i class="fa fa-fw fa-file-pdf-o"></i>Pdf</button>
                                    </div>
                                    <div class="form-group">
                                </div>
                                
                            </div>
                        
                    </form>

                     <!-- <form action="<?php echo base_url(); ?>laporan_ga/cetaklaporan" method="post">

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Cabang</label>
                                <div class="col-sm-9"><select name="id_cabang" class="form-control" id="OptCabang"></select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-5 form-group">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">List Audit</label>
                                <div class="col-sm-9">
                                    <select name="idjadwal_audit" class="form-control" id="OptJadwalAudit" required></select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <input type="hidden" name="status" id="status" value="Belum Sesuai" />
                            <a id="preview" class="btn btn-primary">Preview</a>
                            <button type="submit" class="btn btn-primary" id="type" name="type" value="excel"><i class="fa fa-fw fa-print"></i>Excel</button>
                            <button type="submit" class="btn btn-danger" id="type" name="type" value="pdf"><i class="fa fa-fw fa-file-pdf-o"></i>Pdf</button>
                        </div>
                    </form> -->
                    <hr size="100px">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive col-sm-12">
                               <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th class="text-center" width="3%">NO</th>
                                    <!-- <th class="text-center" width="8%">AKSI</th> -->
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
                                    <!-- <th class="text-center">AKSI</th> -->
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