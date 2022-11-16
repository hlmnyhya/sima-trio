<div class="wrapper wrapper-content m-t-xl wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3><i class="fa fa-info-circle"></i> Data Audit Unit</h3>
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
                                            <label>Status Unit</label>
                                            <div class="form-group">
                                                <select name="status_unit" class="form-control" id="status">
                                                    <option value="">--- ALL ---</option>
                                                    <option value="Sesuai" id="sesuai">Sesuai</option>
                                                    <option value="Belum Sesuai" id="belum_sesuai">Belum Sesuai</option>
                                                    <option value="Belum ditemukan" id="belum_ditemukan">Belum Ditemukan</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-1">
                                            <div class="form-group m-t-md">
                                                <a id="preview" class="btn btn-success">Preview</a>
                                            </div>
                                        </div>
                                    </form>

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
                                            <th class="text-center">Cabang</th>
                                            <th class="text-center">Lokasi</th>
                                            <th class="text-center">Umur Unit</th>
                                            <th class="text-center">Status Unit</th>
                                            <!--th class="text-center">Aki</th>
                                            <th class="text-center">Spion</th>
                                            <th class="text-center">Helm</th>
                                            <th class="text-center">Tools</th>
                                            <th class="text-center">Buku Servis</th-->
                                            <th class="text-center">Tahun</th>
                                            <th class="text-center">Type</th>
                                            <th class="text-center">Kode Item</th>
                                            <!--th class="text-center">Foto</th-->
                                            <th class="text-center">Keterangan</th>
                                            <th class="text-center">Is Ready</th>
                                            <th class="text-center">Tanggal Audit</th>
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
                                            <th class="text-center">Cabang</th>
                                            <th class="text-center">Lokasi</th>
                                            <th class="text-center">Umur Unit</th>
                                            <th class="text-center">Status Unit</th>
                                            <!--th class="text-center">Aki</th>
                                            <th class="text-center">Spion</th>
                                            <th class="text-center">Helm</th>
                                            <th class="text-center">Tools</th>
                                            <th class="text-center">Buku Servis</th-->
                                            <th class="text-center">Tahun</th>
                                            <th class="text-center">Type</th>
                                            <th class="text-center">Kode Item</th>
                                            <!--th class="text-center">Foto</th-->
                                            <th class="text-center">Keterangan</th>
                                            <th class="text-center">Is Ready</th>
                                            <th class="text-center">Tanggal Audit</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="text-right"><span id="pagination"></span></div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
</div>