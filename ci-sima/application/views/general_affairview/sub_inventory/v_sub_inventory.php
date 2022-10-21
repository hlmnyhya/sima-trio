<div class="wrapper wrapper-content m-t-xl wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="form-group">
                        <div class="col-sm-2"><label>Cari Sub Inventory</label></div>
                        <div class="col-sm-8"><input type="text" class="form-control" nama="cari" id="cari"></div>
                        <div class="col-sm-2 text-center"><button class="btn btn-w-m btn-success" id="caribtn">Cari Data</button>
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
                        <h3><i class="fa fa-home"></i> List Data Sub Inventory</h3>
                    </div>
                    <div>
                        <input type="submit" value="Add Data" id="add" name="add" class="btn btn-success" onclick="show()">
                    </div>

                </div>
                <div class="panel-body">


                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th width="3%">No</th>
                                    <th width="5%">Aksi</th>
                                    <th>ID Sub Inventory</th>
                                    <th>Sub Inventory</th>
                                    <th>Jenis Inventory</th>
                                </tr>
                            </thead>
                            <tbody id="sub_inv">
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Aksi</th>
                                    <th>ID Sub Inventory</th>
                                    <th>Sub Inventory</th>
                                    <th>Jenis Inventory</th>

                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div id="pagination"></div>
                </div>
            </div>
        </div>
    </div>



</div>