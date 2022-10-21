<div class="wrapper wrapper-content m-t-xl wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12" id="data_input">
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="form-group">
                        <label class="col-sm-3">
                            <h5>List Data Audit Unit Perlokasi</h5>
                        </label>
                        <div class="col-sm-9 text-right">
                        </div>
                    </div>

                    <span id="info_message"></span>
                </div>
                <div class="panel-body">
                    <form id="FormLap" action="<?php echo base_url() ?>laporan_auditor/cetakperlokasi" method="post">
                        <div class="row">
                            <div class="col-sm-9">
                                <div class="col-sm-5 form-group">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Cabang</label>
                                        <div class="col-sm-9"><select name="id_cabang" class="form-control" id="OptCabang" required></select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">List Audit</label>
                                        <div class="col-sm-9">
                                            <select name="idjadwal_audit" class="form-control" id="OptJadwalAudit" required></select>
                                        </div>
                                    </div>
                                </div>
                                <span id="change" class="hidden">
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Auditor</label>
                                            <div class="col-sm-9"><input type="text" id="auditor" class="form-control" name="auditor" required></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Tempat</label>
                                            <div class="col-sm-9"><input type="text" id="tempat" class="form-control" name="tempat" required></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-danger btn-block" id="type" name="type" value="pdf">OK</button>
                                        </div>
                                    </div>
                                    <div class="col-sm-5 ">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Counter</label>
                                            <div class="col-sm-9"><input type="text" id="counter" class="form-control" name="counter" required></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Kepala Cabang</label>
                                            <div class="col-sm-9"><input type="text" id="kacab" class="form-control" name="kacab" required></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <a class="btn btn-warning btn-block" id="cancel">Cancel</a>
                                        </div>
                                    </div>
                                </span>
                            </div>
                            <div class="col-sm-3">
                                <a id="dataPreview" class="btn btn-primary">Preview</a>
                                <a id="open" class="btn btn-danger xshow"><i class="fa fa-fw fa-file-pdf-o"></i> Download Pdf</a>

                            </div>
                        </div>
                    </form>
                    <hr size="100px">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example">
                                    <thead>
                                        <tr>

                                        <tr>
                                            <th rowspan="2" class="text-center">No</th>
                                            <th rowspan="2" class="text-center">Lokasi</th>
                                            <th rowspan="2" class="text-center">Jumlah Unit</th>
                                            <th colspan="5" class="text-center">Jumlah Aksesoris</th>
                                            <th colspan="5" class="text-center">Selisih</th>
                                        </tr>

                                        <tr>
                                            <th>Aki</th>
                                            <th>Spion</th>
                                            <th>Helm</th>
                                            <th>Tools</th>
                                            <th>Buku Service</th>
                                            <th>Aki</th>
                                            <th>Spion</th>
                                            <th>Helm</th>
                                            <th>Tools</th>
                                            <th>Buku Service</th>
                                        </tr>
                                        </tr>
                                    </thead>
                                    <tbody id="aksesoris">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>