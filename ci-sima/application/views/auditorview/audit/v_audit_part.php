<div class="wrapper wrapper-content m-t-n-md wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3><i class="fa fa-info-circle"></i> Audit Part</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="row">     
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Lokasi </label>
                                            <div class="col-sm-9">
                                                <select class="form-control control-label m-b" name="id_lokasi" id="id_lokasi"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-part" id="form-part">
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Rak Bin </label>
                                                <div class="col-sm-9">
                                                    <select type="text" class="form-control" name="rakbin" id="rakbin"></select>
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Kondisi</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control m-b" name="kondisi" id="kondisi">
                                                        <option value="Bagus">Bagus</option>
                                                        <option value="Rusak">Rusak</option>
                                                    </select>
                                                </div>
                                                <!-- <label class="col-sm-3 control-label">Quantity</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" placeholder="quantity" id="qty">
                                                    <span class="help-block m-b-none text-danger" id="info"></span>
                                                </div> -->
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Part Number</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" placeholder="Cari Data Part" id="cari">
                                                    <span class="help-block m-b-none text-danger" id="info"></span>
                                                    
                                                </div>
                                            </div>
                                           
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <a id="doCariPart" class="btn btn-primary">Scan Data</a>
                                            <a onclick="window.open ('<?php echo base_url() ?>transaksi_auditor/temp_part?id=<?php echo $_GET['id'] . "&&a=" . base64_encode('idjadwal_audit')?>')"   class="btn btn-warning">Temporary Data</a>
                                            <?php $id = $_GET['id']; ?> 
                                            <a class="btn btn-danger" id="close_part">Close Part</a>
                                        </div>
                                    </div>
                                    <!-- Form Manual -->
                                    <div id="manual" class="row p-h-sm">
                                        <div class="form-group col-sm-12">
                                            <label>Rakbin</label>
                                            <input type="text" class="form-control" placeholder="Rak bin Baru" id="rakbin_baru" required>
                                        </div>
                                        <div class="form-group col-sm-12">
                                        <label>Kondisi</label>
                                            <select class="form-control m-b" name="kondisi" id="kondisi_baru">
                                                <option value="Bagus">Bagus</option>
                                                <option value="Rusak">Rusak</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-12">
                                            <label>Quantity</label>
                                            <input type="text" class="form-control" placeholder="Quantity" id="qty_manual" required>
                                        </div>
                                        <div class="form-group col-sm-12">
                                            <label>Part Number</label>
                                            <input type="text" class="form-control" placeholder="Part Number" id="part_number" required>
                                        </div>
                                        <div class="form-group col-sm-12">
                                            <a id="auditPart" class="btn btn-primary">Audit</a>
                                        </div>
                                    </div>
                                    <!-- Penutup Form manual -->
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
                                            <th class="text-center">Gudang</th>
                                            <th class="text-center">Lokasi</th>
                                            <th class="text-center">PART NUMBER</th>
                                            <th class="text-center">PART DESKRIPSI</th>
                                            <th class="text-center">QTY</th>
                                            <th class="text-center">KD RAKBIN</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Kondisi</th>
                                            <th class="text-center">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody id="audit_part">
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                        <th class="text-center" width="3%">No</th>
                                            <th class="text-center">Gudang</th>
                                            <th class="text-center">Lokasi</th>
                                            <th class="text-center">PART NUMBER</th>
                                            <th class="text-center">PART DESKRIPSI</th>
                                            <th class="text-center">QTY</th>
                                            <th class="text-center">KD RAKBIN</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Kondisi</th>
                                            <th class="text-center">Keterangan</th>
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