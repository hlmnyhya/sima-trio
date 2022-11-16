<div class="wrapper wrapper-content m-t-xl wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-2">Cari Gudang</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="Inlokasi" />
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-w-m btn-success" id="caribtn">Cari Data</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12" id="data_input">
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="col-lg-11">
                        <h4><i class="fa fa-info-circle"></i> List Data Gudang</h4>
                    </div>
                    <div>
                        <input type="submit" value="Tambah" id="add" name="add" class="btn btn-success" onclick="show()">
                    </div>
                </div>

                <div class="panel-body">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <div class="tbl-header">
                                <thead>
                                    <tr class="red-bg">
                                        <th width="3%" class="text-center">No</th>
                                        <th width="5%" class="text-center">Aksi</th>
                                        <th class="text-center">Kode</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Jenis</th>
                                        <th class="text-center">Alamat</th>
                                    </tr>
                                </thead>
                            </div>
                            <tbody id="lokasi">
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Aksi</th>
                                    <th class="text-center">Kode</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Jenis</th>
                                    <th class="text-center">Alamat</th>
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