<div class="wrapper wrapper-content m-t-xl wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row form-horizontal">
                        <div class="col-sm-10">
                            <div>
                                <div class="form-group"><label class="col-sm-2 control-label">Cari Jadwal Audit</label>
                                    <div class="col-sm-10"><input type="text" class="form-control" id="jdwal"></div>
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
                    <h4><i class="fa fa-info-circle"></i> List Jadwal Audit</h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th width="3%" class="text-center">No</th>
                                    <th width="5%" class="text-center">Aksi</th>
                                    <th class="text-center">ID Waktu Audit</th>
                                    <th class="text-center">Auditor</th>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">Waktu</th>
                                    <th class="text-center">Cabang</th>
                                    <th class="text-center">Jenis Audit</th>
                                    <th class="text-center">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody id="list_jadwal_audit"></tbody>
                            <tfoot>
                                <tr>
                                    <th width="3%" class="text-center">No</th>
                                    <th class="text-center">Aksi</th>
                                    <th class="text-center">ID Waktu Audit</th>
                                    <th class="text-center">Auditor</th>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">Waktu</th>
                                    <th class="text-center">Cabang</th>
                                    <th class="text-center">Jenis Audit</th>
                                    <th class="text-center">Keterangan</th>
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
</div>
</div>