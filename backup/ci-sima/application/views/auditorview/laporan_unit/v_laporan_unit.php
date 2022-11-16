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
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3><i class="fa fa-info-circle"></i> Data Audit Unit</h3>
                    <span id="info_message"></span>
                </div>
                <div class="panel-body">

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Cabang</label>
                            <div class="col-sm-9"><select name="id_cabang" class="form-control" id="OptCabang"></select>
                            </div>
                        </div>
                    </div>



                    <div class="col-sm-6">
                        <div class="form-group" id="data_5">
                            <label class="col-sm-3 control-label">Periode Tanggal</label>
                            <div class="col-sm-9">
                                <div class="input-daterange input-group" id="datepicker">
                                    <input type="text" class="input-m form-control" name="tgl_awal" value="05/14/2019" />
                                    <span class="input-group-addon" id="tgl_awal">to</span>
                                    <input type="text" class="input-m form-control" name="tgl_akhir" value="05/22/2019" />
                                </div>
                            </div>
                        </div>
                    </div>



                    <hr size="100px">
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example gray-bg">
                                    <thead>
                                        <tr>
                                            <th class="text-center" width="3%">No</th>
                                            <th class="text-center" width="5%">Aksi</th>
                                            <th class="text-center">ID Unit</th>
                                            <th class="text-center">No Mesin</th>
                                            <th class="text-center">No Rangka</th>
                                            <th class="text-center">Cabang</th>
                                            <th class="text-center">Lokasi</th>
                                            <th class="text-center">Umur Unit</th>
                                            <th class="text-center">Status Unit</th>
                                            <th class="text-center">Aki</th>
                                            <th class="text-center">Spion</th>
                                            <th class="text-center">Helm</th>
                                            <th class="text-center">Tools</th>
                                            <th class="text-center">Buku Servis</th>
                                            <th class="text-center">Keterangan</th>
                                            <th class="text-center">Tanggal Audit</th>
                                        </tr>
                                    </thead>
                                    <tbody id="audit_unit">
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="text-center" width="3%">No</th>
                                            <th class="text-center" width="5%">Aksi</th>
                                            <th class="text-center">ID Unit</th>
                                            <th class="text-center">No Mesin</th>
                                            <th class="text-center">No Rangka</th>
                                            <th class="text-center">Cabang</th>
                                            <th class="text-center">Lokasi</th>
                                            <th class="text-center">Umur Unit</th>
                                            <th class="text-center">Status Unit</th>
                                            <th class="text-center">Aki</th>
                                            <th class="text-center">Spion</th>
                                            <th class="text-center">Helm</th>
                                            <th class="text-center">Tools</th>
                                            <th class="text-center">Buku Servis</th>
                                            <th class="text-center">Keterangan</th>
                                            <th class="text-center">Tanggal Audit</th>
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