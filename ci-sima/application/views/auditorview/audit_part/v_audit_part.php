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
                                <form id="FormLap" action="<?php echo base_url() ?>laporan_auditor/cetakparttemp" method="post">
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
                                <tr class="text-center">
                                    <th class="text-center" rowspan="2" width="3%">No</th>
                                    <th class="text-center" rowspan="2" width="5%">Aksi</th>
                                    <th rowspan="2" class="text-center">Cabang</th>
                                    <th rowspan="2" class="text-center">Lokasi</th>
                                    <th rowspan="2" class="text-center">PART NUMBER</th>
                                    <th rowspan="2" class="text-center">DESKRIPSI</th>
                                    <th colspan="3" class="text-center">QTY</th>
                                    <th rowspan="2" class="text-center">HET</th>
                                    <th rowspan="2" class="text-center">AMOUNT</th>
                                    <th rowspan="2" class="text-center">KD RAKBIN</th>
                                    <th rowspan="2" class="text-center">Status</th>
                                    <th rowspan="2" class="text-center">Kondisi</th>
                                    <th rowspan="2" class="text-center">Keterangan</th>
                                </tr>
                                <tr>
                                    <th class="text-center">QTY</th>
                                    <th class="text-center">QTY FISIK</th>
                                    <th class="text-center">SELISIH</th>
                                </tr>
                            </thead>
                            <tbody id="audit_part">
                            </tbody>
                            <tfoot>
                                <tr class="text-center">
                                    <th class="text-center" width="3%">No</th>
                                    <th class="text-center" width="5%">Aksi</th>
                                    <th class="text-center">Cabang</th>
                                    <th class="text-center">Lokasi</th>
                                    <th class="text-center">Part Number</th>
                                    <th class="text-center">Deskripsi</th>                                   
                                    <th class="text-center">Qty</th>
                                    <th class="text-center">Qty FISIK</th>
                                    <th class="text-center">SELISIH</th>
                                    <th class="text-center">HET</th>
                                    <th class="text-center">AMOUNT</th>
                                    <th class="text-center">KD RAKBIN</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Kondisi</th>
                                    <th class="text-center">Keterangan</th>
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