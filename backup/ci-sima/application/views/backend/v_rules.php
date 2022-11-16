<div class="wrapper wrapper-content m-t-xl wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row form-horizontal">
                        <div class="col-sm-10">
                            <div>
                                <div class="form-group"><label class="col-sm-2 control-label">User Group</label>
                                    <div class="col-sm-10"><select class="form-control" name="usergroup" id="Optusergroup"></select></div>
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
        <div class="col-lg-12" id="data_input">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="col-sm-10">
                        <h3><i class="fa fa-info-circle"></i> Akses Menu User</h3>
                    </div>
                    <div>
                        <input type="submit" value="Add Data" id="add" name="add" class="btn btn-success" onclick="show()">
                    </div>
                </div>
                <div class="panel-body">

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example gray-bg">
                                    <thead>
                                        <tr>
                                            <th class="text-center" width="3%">NO</th>
                                            <th class="text-center" width="5%">AKSI</th>
                                            <th class="text-center" width="15%">Menu Akses</th>

                                        </tr>
                                    </thead>
                                    <tbody id="rule">
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="text-center">NO</th>
                                            <th class="text-center">AKSI</th>
                                            <th class="text-center">Menu Akses</th>
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