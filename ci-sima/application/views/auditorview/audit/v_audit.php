<div class="wrapper wrapper-content m-t-n-md wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3><i class="fa fa-info-circle"></i> Audit</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Lokasi</label>
                                            <div class="col-sm-9"><select class="form-control control-label m-b" name="id_lokasi" id="id_lokasi">
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Data Unit</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" placeholder="Cari Data Unit" id="cari">
                                                <span class="help-block m-b-none text-danger" id="info"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="from-group">
                                            <div class="col-sm-12">
                                                <a id="doCari" class=" btn btn-primary">Scan Data</a>
                                                <a onclick="window.open ('<?php echo base_url() ?>transaksi_auditor/temp_unit?id=<?php echo $_GET['id'] . "&&a=" . base64_encode('idjadwal_audit')?>')"   class="btn btn-warning">Temporary Data</a>
                                                <a id="close" class="btn btn-danger">Close Audit</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="manual" class="row">
                                        <div class="form-group col-sm-12">
                                            <label>No. Mesin</label>
                                            <input type="text" class="form-control" placeholder="No Mesin" id="no_mesin" required>
                                        </div>
                                        <div class="form-group col-sm-12">
                                            <label>No. Rangka</label>
                                            <input type="text" class="form-control" placeholder="No Rangka" id="no_rangka" required>
                                        </div>
                                        <div class="form-group col-sm-12">
                                            <a id="audit" class="btn btn-primary">Audit</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example gray-bg">
                                    <thead>
                                        <tr>
                                            <th class="text-center" width="3%">No</th>
                                            <th class="text-center" width="3%">Aksi</th>
                                            <th class="text-center">No Mesin</th>
                                            <th class="text-center">No Rangka</th>
                                            <th class="text-center">Dealer</th>
                                            <th class="text-center">Lokasi</th>
                                            <th class="text-center">Status Unit</th>
                                            <th class="text-center">Tahun</th>
                                            <th class="text-center">Type</th>
                                            <th class="text-center">Kode Item</th>
                                            <th class="text-center">Keterangan</th>
                                            <th class="text-center">Is Ready</th>
                                        </tr>
                                    </thead>
                                    <tbody id="audit_unit">
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="text-center" width="3%">No</th>
                                            <th class="text-center" width="3%">Aksi</th>
                                            <th class="text-center">No Mesin</th>
                                            <th class="text-center">No Rangka</th>
                                            <th class="text-center">Dealer</th>
                                            <th class="text-center">Lokasi</th>
                                            <th class="text-center">Status Unit</th>
                                            <th class="text-center">Tahun</th>
                                            <th class="text-center">Type</th>
                                            <th class="text-center">Kode Item</th>
                                            <th class="text-center">Keterangan</th>
                                            <th class="text-center">Is Ready</th>
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