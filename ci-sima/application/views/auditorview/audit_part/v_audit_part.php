<div class="wrapper wrapper-content m-t-xl wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <i class="fa fa-info-circle"></i> AUDIT PART
                </div>
                                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <form action="" method="post">
                                        <div class="col-sm-4">
                                            <label>Cabang</label>
                                            <div class="form-group">
                                                <select name="id_cabang" class="form-control" id="OptCabang"></select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <label>List Audit</label>
                                            <div class="form-group" id="data_5">
                                                <select name="idjadwal_audit" class="form-control" id="OptJadwalAudit"></select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <label>Status Part</label>
                                            <div class="form-group">
                                                <select name="status" class="form-control" id="status">
                                                    <option value="">--- ALL ---</option>
                                                    <option value="Sesuai" id="sesuai">Sesuai</option>
                                                    <option value="Belum Sesuai" id="belum_sesuai">Belum Sesuai</option>
                                                    <option value="Belum ditemukan" id="belum_ditemukan">Belum Ditemukan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <div class="form-group m-t-md">
                                                <a id="previewpart" class="btn btn-success">Preview</a>
                                            </div>
                                        </div>
                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>
                <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                <th width="3%">No</th>
                                    <th width="5%">Aksi</th>
                                    <th>Cabang</th>
                                    <th>Lokasi</th>
                                    <th>Part Number</th>
                                    <th>KD Bin Box</th>
                                    <th>Kondisi</th>
                                    <th>Deskripsi</th>
                                    <th>Qty</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="audit_part">
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th width="3%">No</th>
                                    <th width="5%">Aksi</th>
                                    <th>Cabang</th>
                                    <th>Lokasi</th>
                                    <th>Part Number</th>
                                    <th>KD Bin Box</th>
                                    <th>Kondisi</th>
                                    <th>Deskripsi</th>
                                    <th>Qty</th>
                                    <th>Status</th>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="text-right"> <span id="pagination"></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>