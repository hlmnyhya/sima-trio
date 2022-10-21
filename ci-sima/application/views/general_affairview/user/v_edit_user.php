<div class="wrapper wrapper-content m-t-xl wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <form method="post" id="FormUser" class="form-horizontal" action="<?php echo base_url() ?>master_data/put_user">
            <div class="col-lg-12">
                <div class="panel panel-success">
                    <div class="ibox-title">
                        <h5 class="col-md-10">Edit Data User</h5>
                        <div class="col-sm-2 text-right">
                            <a href="<?php echo base_url('master_data/user') ?>" type="submit" class="btn btn-m btn-danger">Batal</a>
                            <button type="submit" class="btn btn-primary btn-m" id="btn-simpan">Simpan</button>
                        </div>
                    </div>
                    <div class="panel-body">
                        <?php foreach ($user as $u) {
                            $lokasi = $u['id_lokasi'];

                        ?>
                            <input type="hidden" class="form-control" name="nik" id="nik" value="<?php echo $u['nik'] ?>">
                            <div class="form-group"><label class="col-sm-2 control-label">ID User</label>
                                <div class="col-sm-10"><input type="text" class="form-control" name="nik" id="nik" value="<?php echo $u['nik'] ?>" disabled></div>
                            </div>

                            <div class="form-group"><label class="col-sm-2 control-label">Username</label>
                                <div class="col-sm-10"><input type="text" class="form-control" name="username" value="<?php echo $u['username'] ?>"></div>
                            </div>


                            <div class="form-group"><label class="col-sm-2 control-label">Nama</label>
                                <div class="col-sm-10"><input type="text" class="form-control" name="nama" value="<?php echo $u['nama'] ?>"></div>
                            </div>

                            <div class="form-group"><label class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-8"><input type="password" class="form-control" name="password" id="password" oncopy="return false" onpaste="return false" disabled></div>
                                <div class="col-sm-2"><button class="btn btn-warning btn-m" id="btn-reset">Reset Password</button></div>
                            </div>


                            <div id="confirm" class="hidden"><label class="col-sm-2 control-label">Confirm Password</label>
                                <div class="col-sm-10"><input type="password" class="form-control" name="confirm_password" id="confirm_password" oncopy="return false" onpaste="return false"></div>
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
                            <div class="form-group"><label class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-3 ">
                                    <div class="i-checks"><label> <input type="radio" value="Aktif" name="status" <?php if ($u['status'] == 'Aktif') echo "checked" ?>> <i></i> Aktif </label></div>
                                </div>
                                <div class="col-sm-3 ">
                                    <div class="i-checks"><label> <input type="radio" value="Tidak Aktif" name="status" <?php if ($u['status'] == 'Tidak Aktif') echo "checked" ?>> <i></i>Tidak Aktif </label></div>
                                </div>
                            </div>
                        <?php } ?>
        </form>
    </div>
</div>

</div>
</div>
</div>