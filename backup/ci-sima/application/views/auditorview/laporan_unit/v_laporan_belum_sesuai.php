<div class="wrapper wrapper-content m-t-xl wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3>List Data Audit Belum Sesuai</h3>
                </div>
                <div class="panel-body">
                    <form action="<?php echo base_url() ?>laporan_auditor/cetakexcel" method="post">

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
                    </form>
                    <hr size="100px">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No Mesin</th>
                                            <th>No Rangka</th>
                                            <th>Kode Item</th>
                                            <th>Type Unit</th>
                                            <th>Usia Unit</th>
                                            <th>Lokasi</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="unit">
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>No Mesin</th>
                                            <th>No Rangka</th>
                                            <th>Kode Item</th>
                                            <th>Type Unit</th>
                                            <th>Usia Unit</th>
                                            <th>Lokasi</th>
                                            <th>Status</th>
                                        </tr>
                                    </tfoot>
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