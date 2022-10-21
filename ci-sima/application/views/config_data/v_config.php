<div class="wrapper wrapper-content m-t-xl wrapper wrapper-content animated fadeInRight">


    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <i class="fa fa-info-circle"></i> Setup Database
                </div>
                <div class="panel-body">

                    <div class="row">
                        <form method="post" lcass="form-horizontal" action="<?php echo base_url() ?>config/put_config">
                            <?php
                            foreach ($tampil as $e) :
                                $ip = $e['ip'];
                                $ip2 = 'IPADDRESS';
                                $iv_key = 'honda12345';
                                $encrypt_method = "AES-256-CBC";
                                $key = hash('sha256', $ip2);
                                $iv = substr(hash('sha256', $iv_key), 0, 16);
                                $ip = base64_decode($ip);
                                $ip = openssl_decrypt($ip, $encrypt_method, $key, 0, $iv);

                                $username = $e['username'];
                                $username2 = 'USERNAME';
                                $iv_key = 'honda12345';
                                $encrypt_method = "AES-256-CBC";
                                $key = hash('sha256', $username2);
                                $iv = substr(hash('sha256', $iv_key), 0, 16);
                                $username = base64_decode($username);
                                $username = openssl_decrypt($username, $encrypt_method, $key, 0, $iv);

                                $password = $e['password'];
                                $password2 = 'PASSWORD';
                                $iv_key = 'honda12345';
                                $encrypt_method = "AES-256-CBC";
                                $key = hash('sha256', $password2);
                                $iv = substr(hash('sha256', $iv_key), 0, 16);
                                $password = base64_decode($password);
                                $password = openssl_decrypt($password, $encrypt_method, $key, 0, $iv);

                                $database = $e['db'];
                                $database2 = 'DATABASE';
                                $iv_key = 'honda12345';
                                $encrypt_method = "AES-256-CBC";
                                $key = hash('sha256', $database2);
                                $iv = substr(hash('sha256', $iv_key), 0, 16);
                                $database = base64_decode($database);
                                $database = openssl_decrypt($database, $encrypt_method, $key, 0, $iv);
                            ?>



                                <div class="form-group col-sm-12">
                                    <label>Hostname</label>
                                    <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $e['id'] ?>" readonly>
                                    <input type="text" class="form-control" id="ip" name="ip" value="<?php echo $ip ?>" readonly>
                                </div>
                                <div class="form-group col-sm-12">
                                    <label>Username</label>
                                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $username ?>" readonly>
                                </div>

                                <div class="form-group col-sm-12">
                                    <label>Password</label>
                                    <input type="password" class="form-control" id="password" name="password" value="<?php echo $password ?>" readonly>
                                </div>

                                <div class="form-group col-sm-12">
                                    <label>Database</label>
                                    <input type="text" class="form-control" id="db" name="db" value="<?php echo $database ?>" readonly>
                                </div>
                            <?php endforeach; ?>
                            <div class="form-group col-sm-6">
                                <button type="submit" class="btn btn-success btn-block center m-t-n-xs">Set</button><br>
                            </div>
                            <div class=" form-group col-sm-6">
                                <a onclick="show()" class="btn btn-danger btn-block center m-t-n-xs" id="up">Update</a>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>