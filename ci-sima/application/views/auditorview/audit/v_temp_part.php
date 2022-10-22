<div class="wrapper wrapper-content m-t-n-md wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3><i class="fa fa-info-circle"></i> Data Temporary Part </h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <a href="<?php echo base_url() ?>transaksi_auditor/auditpart?id=<?php echo $_GET['id'] ?>" class="btn btn-danger">Back</a>
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
                                            <th class="text-center">Lokasi</th>
                                            <th class="text-center">PART NUMBER</th>
                                            <th class="text-center">PART DESKRIPSI</th>
                                            <th class="text-center">RAK BIN</th>
                                            <th class="text-center">QTY</th>
                                        </tr>
                                    </thead>
                                    <tbody id="audit_part">
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="text-center" width="3%">No</th>
                                            <th class="text-center" width="3%">Aksi</th>
                                            <th class="text-center">Lokasi</th>
                                            <th class="text-center">PART NUMBER</th>
                                            <th class="text-center">PART DESKRIPSI</th>
                                            <th class="text-center">RAK BIN</th>
                                            <th class="text-center">QTY</th>
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