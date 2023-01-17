<div class="wrapper wrapper-content m-t-xl wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3><i class="fa fa-info-circle"></i> AUDIT PART<h3>
                </div>
                                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                <form id="FormLap" action="<?php echo base_url() ?>laporan_auditor/cetakpart" method="post">
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
                                    
                                <div class="col-sm-4 m-t-md">
                                    <a id="previewpart" class="btn btn-success">Preview</a>
                                    <!-- <a id="open" class="btn btn-danger xshow"><i class="fa fa-fw fa-file-pdf-o"></i>Download Pdf</a> -->
                                    <button type="submit" class="btn btn-danger xshow" id="type" name="type" value="pdf" <i class="fa fa-fw fa-file-pdf-o"></i>Download PDF</button>
                                </div>
                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>
                <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                <th width="3%">No</th>
                                    <th width="5%">Aksi</th>
                                    <th>Cabang</th>
                                    <th>Lokasi</th>
                                    <th>Part Number</th>
                                    <th>KD Bin Box</th>
                                    <th>Status</th>                                    
                                    <th>Deskripsi</th>
                                    <th>Qty SIMANDE</th>
                                    <th>Qty</th>
                                    <th>Kondisi</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody id="audit_part">
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th width="3%">No</th>
                                    <th width="5%">Aksi</th>
                                    <th>Cabang</th>
                                    <th>Lokasi</th>
                                    <th>Part Number</th>
                                    <th>KD Bin Box</th>
                                    <th>Status</th>                                    
                                    <th>Deskripsi</th>
                                    <th>Qty SIMANDE</th>
                                    <th>Qty</th>
                                    <th>Kondisi</th>
                                    <th>Keterangan</th>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="text-right"> <span id="pagination"></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>