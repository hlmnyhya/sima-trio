<div class="wrapper wrapper-content m-t-xl wrapper wrapper-content animated fadeInRight">
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-success">
                    <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-10">
                            <div>
                                <div class="form-group"><label class="col-sm-4 control-label">Pencarian Berdasarkan Nama Divisi</label>
                                <div class="col-sm-8"><input type="text" class="form-control" id="Indivisi"></div></div>        
                            </div>        
                        </div>

                        <div class="col-sm-2 text-center">
                            <button class="btn btn-w-m btn-info" id="caribtn">Cari Data</button>
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
                    <div class="ibox-title float-e-margins">
                        <div class="form-group">
                            <label class="col-sm-3"> <h5>List Data Divisi</h5></label>
                            <div class="col-sm-9 text-right">
                            <input type="submit" value="Add Data" id="add" name="add" class="btn btn-success" onclick="show()">
                            </div>
                        </div>

                      <span id="info_message"></span>
                    </div>
                    <div class="panel-body">
                    <?php if($this->session->flashdata('info')){
                            ?>
                            <div class="alert alert-success alert-dismissable col-6">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                    Data Divisi <?php echo $this->session->flashdata('info');
                                    
                                    ?>
                                </div>
                            <?php
                            } ?>
                        <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th width="3%">No</th>
                        <th width="5%">Aksi</th>
                        <th>ID Divisi</th>
                        <th>Nama Divisi</th>
                    </tr>
                    </thead>
                    <tbody id="divisi">
                    </tbody >
                    <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Aksi</th>
                        <th>ID Divisi</th>
                        <th>Nama Divisi</th>
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

