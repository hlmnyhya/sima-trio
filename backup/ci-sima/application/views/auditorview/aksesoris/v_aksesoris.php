<div class="wrapper wrapper-content m-t-xl wrapper wrapper-content animated fadeInRight">


    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <i class="fa fa-info-circle"></i> AKSESORIS
                </div>
                <div class="panel-body">

                    <div class="row">
                        <form class="form-horizontal" action="<?php echo base_url() ?>laporan_auditor/cetakexcelnotready" method="post">

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Cabang</label>
                                    <div class="col-sm-9"><select name="id_cabang" class="form-control" id="OptCabang"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-5 ">
                                <div class="form-group" id="data_5">
                                    <label class="col-sm-4 control-label">Periode Tanggal</label>
                                    <div class="col-sm-8">
                                        <div class="input-daterange input-group" id="datepicker">
                                            <input type="text" class="input-m form-control" name="tgl_awal" id="tgl_awal" value="<?php echo $tgl ?>" />
                                            <span class="input-group-addon" id="tgl_awal">s/d</span>
                                            <input type="text" class="input-m form-control" name="tgl_akhir" id="tgl_akhir" value="<?php echo $tgl ?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <input type="hidden" name="ready" value="NRFS" id="ready" />
                                <a id="preview" class="btn btn-primary">Preview</a>

                            </div>
                        </form>
                    </div>
                    <hr size="100px">


                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th width="3%">No</th>
                                    <th width="5%">Aksi</th>
                                    <th>ID Aksesoris</th>
                                    <th>Cabang</th>
                                    <th>Lokasi</th>
                                    <th>Aki</th>
                                    <th>Spion</th>
                                    <th>Helm</th>
                                    <th>Tools</th>
                                    <th>Buku Service</th>

                                </tr>
                            </thead>
                            <tbody id="aksesoris">
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th width="3%">No</th>
                                    <th width="5%">Aksi</th>
                                    <th>ID Aksesoris</th>
                                    <th>Cabang</th>
                                    <th>Lokasi</th>
                                    <th>Aki</th>
                                    <th>Spion</th>
                                    <th>Helm</th>
                                    <th>Tools</th>
                                    <th>Buku Service</th>
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