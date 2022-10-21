<div class="wrapper wrapper-content m-t-n-md wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3><i class="fa fa-info-circle"></i> Data Temporary Unit </h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <a href="<?php echo base_url() ?>transaksi_auditor/audit?id=<?php echo $_GET['id'] ?>" class="btn btn-danger">Back</a>
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
                                            <th class="text-center">No Mesin</th>
                                            <th class="text-center">No Rangka</th>
                                            <th class="text-center">Lokasi</th>
                                            <th class="text-center">Umur Unit</th>
                                            <th class="text-center">Tahun</th>
                                            <th class="text-center">Type</th>
                                            <th class="text-center">Kode Item</th>
                                        </tr>
                                    </thead>
                                    <tbody id="audit_unit">
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="text-center" width="3%">No</th>
                                            <th class="text-center">No Mesin</th>
                                            <th class="text-center">No Rangka</th>
                                            <th class="text-center">Lokasi</th>
                                            <th class="text-center">Umur Unit</th>
                                            <th class="text-center">Tahun</th>
                                            <th class="text-center">Type</th>
                                            <th class="text-center">Kode Item</th>
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