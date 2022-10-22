<div class="wrapper wrapper-content m-t-xl wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3><i class="fa fa-info-circle"></i> Data Part</h3>
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
                                            <label>Periode Tanggal</label>
                                            <div class="form-group" id="data_5">
                                                <div class="input-daterange input-group" id="datepicker">
                                                    <input type="text" class="input-m form-control" name="tgl_awal" id="tgl_awal" value="<?php echo $tgl ?>" />
                                                    <span class="input-group-addon" id="tgl_awal">to</span>
                                                    <input type="text" class="input-m form-control" name="tgl_akhir" id="tgl_akhir" value="<?php echo $tgl ?>" />
                                                </div>
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
                                            <th width="3%">No</th>
                                            <th width="5%">Cetak </th>
                                            <th>Lokasi</th>
                                            <th>Part Number</th>
                                            <th>KD Bin Box</th>
                                            <th>Deskripsi</th>
                                            <th>Qty</th>
                                            <th>Tanggal Audit</th>


                                        </tr>
                                    </thead>
                                    <tbody id="part">
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th width="3%">No</th>
                                            <th width="5%">Cetak </th>
                                            <th>Lokasi</th>
                                            <th>Part Number</th>
                                            <th>KD Bin Box</th>
                                            <th>Deskripsi</th>
                                            <th>Qty</th>
                                            <th>Tanggal Audit</th>
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