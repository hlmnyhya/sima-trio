<div class="wrapper wrapper-content m-t-xl wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <form class="form-horizontal" method="post" action="<?php echo base_url('master_data/post_user') ?>" id="FormUser">
                <div class="panel panel-primary">
                    <div class="panel-heading">

                        <div class="col-lg-10">
                            <h3><i class="fa fa-info-circle"></i> Input Data User</h3>
                        </div>
                        <div>
                            <a href="<?php echo base_url('master_data/user') ?>" type="submit" class="btn btn-ws-m btn-danger">Cancel</a>
                            <button type="submit" class="btn btn-primary btn-ws-m" id="btn-simpan">Submit</button>
                        </div>



                    </div>
                    <div class="panel-body">
                        <?php if ($this->session->flashdata('info')) {

                        ?>
                            <div class="alert alert-success alert-dismissable col-6">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                Data user <?php echo $this->session->flashdata('info');

                                            ?>
                            </div>
                        <?php
                        } ?>
                        <div class="form-group"><label class="col-sm-2 control-label">ID User</label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="nik" id="nik"></div>
                        </div>

                        <div class="form-group"><label class="col-sm-2 control-label">Username</label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="username"></div>
                        </div>


                        <div class="form-group"><label class="col-sm-2 control-label">Nama</label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="nama"></div>
                        </div>

                        <div class="form-group"><label class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10"><input type="password" class="form-control" name="password" id="password" oncopy="return false" onpaste="return false"></div>
                        </div>


                        <div class="form-group"><label class="col-sm-2 control-label">Confirm Password</label>
                            <div class="col-sm-10"><input type="password" class="form-control" name="confirm_password" oncopy="return false" onpaste="return false"></div>
                        </div>

                        <div class="form-group"><label class="col-sm-2 control-label">Perusahaan</label>
                            <div class="col-sm-5"><select class="form-control m-b" name="id_perusahaan" id="Optperusahaan">
                                </select>
                            </div>
                        </div>

                        <div class="form-group"><label class="col-sm-2 control-label">Cabang</label>
                            <div class="col-sm-5"><select class="form-control m-b" name="id_cabang" id="Optcabang">
                                </select>
                            </div>
                        </div>

                        <div class="form-group"><label class="col-sm-2 control-label">Lokasi</label>
                            <div class="col-sm-5"><select class="form-control m-b" name="id_lokasi" id="Optlokasi" disabled="">
                                </select>
                            </div>
                        </div>

                        <div class="form-group"><label class="col-sm-2 control-label">User Group</label>
                            <div class="col-sm-5"><select class="form-control m-b" name="id_usergroup" id="Optusergroup">
                                </select>
                            </div>
                        </div>

                        <input type="hidden" name="data_insert" id="data_insert" value="Insert" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>