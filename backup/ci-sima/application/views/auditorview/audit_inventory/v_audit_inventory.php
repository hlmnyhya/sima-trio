<div class="wrapper wrapper-content m-t-xl wrapper wrapper-content animated fadeInRight">


            <div class="row">
                <div class="col-lg-12">
                <div class="panel panel-primary">
                <div class="panel-heading">
                    <i class="fa fa-info-circle"></i> AUDIT INVENTORY
                </div>
                    <div class="panel-body">

                    <div class="form-group"><label class="col-sm-2 control-label">Data Inventory</label>
                            <div class="col-sm-7"><input type="text" class="form-control" placeholder="Cari Data Inventory" id="cari"></div>
                            <div>
                            <button class="btn btn-success btn-m">Scan Data</button>
                            </div>
                            </div>
                    <form method="post" class="form-horizontal" id="Formcabang" action="<?php echo base_url() ?>transaksi_auditor/post_manual">
                           
                        <div class="form-group"><label class="col-sm-2 control-label">ID Inventory</label>
                            <div class="col-sm-4"><input type="text" class="form-control" name="id_inventory" id="id_inventory"></div>
                        </div>

                        <div class="form-group"><label class="col-sm-2 control-label">Nama Barang</label>
                            <div class="col-sm-4"><input type="text" class="form-control" name="merk" id="merk"></div>
                        </div>

                        <div class="form-group"><label class="col-sm-2 control-label">Tahun Pembuatan</label>
                            <div class="col-sm-4"><input type="text" class="form-control" name="tahun_pembuatan" id="tahun_pembuatan"></div>
                        </div>
                    </form> 
                    
                        <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th width="3%">No</th>
                        <th width="5%">Aksi</th>
                        <th>ID Inventory</th>
                        <th>Status Inventory</th>
                        <th>Jenis Inventory</th>
                        <th>Sub Inventory</th>
                        <th>Nilai Awal</th>
                        <th>DDP</th>
                        <th>Nilai Asset</th>
                        <th>Nilai Total Keseluruhan</th>
                        <th>Tahun Pembuatan</th>
                        <th>Pengguna</th>
                        <th>Vendor</th>
                        <th>Tanggal Barang Diterima</th>
                        <th>Jenis Pembayaran</th>
                        <th>Keterangan</th>
                        <th>Stok</th>
                        <th>Foto</th>
                        <th>PPN</th>
                        <th>Merk</th>
                        <th>Aksesoris Tambahan</th>

                    </tr>
                    </thead>
                    <tbody id="audit_inventory">
                    </tbody >
                    <tfoot>
                    <tr>
                        <th width="3%">No</th>
                        <th width="5%">Aksi</th>
                        <th>ID Inventory</th>
                        <th>Status Inventory</th>
                        <th>Jenis Inventory</th>
                        <th>Sub Inventory</th>
                        <th>Nilai Awal</th>
                        <th>DDP</th>
                        <th>Nilai Asset</th>
                        <th>Nilai Total Keseluruhan</th>
                        <th>Tahun Pembuatan</th>
                        <th>Pengguna</th>
                        <th>Vendor</th>
                        <th>Tanggal Barang Diterima</th>
                        <th>Jenis Pembayaran</th>
                        <th>Keterangan</th>
                        <th>Stok</th>
                        <th>Foto</th>
                        <th>PPN</th>
                        <th>Merk</th>
                        <th>Aksesoris Tambahan</th>
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

