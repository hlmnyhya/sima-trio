    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header text-white text-center">
                    <h3>SIMA</h3>
                </li>
                <li class="<?php if ($this->uri->segment(1) == 'dashboard') echo 'active'; ?>">
                    <a href="<?php echo base_url() ?>dashboard"><i class="fa fa-home fa-lg"></i> <span class="nav-label">
                            <?php
                            if ($this->session->userdata('usergroup') != 'UG005') {
                                echo "Beranda";
                            } else {
                                echo "Dashboard";
                            }
                            ?>
                        </span></a>
                </li>

                <!--Area Menu Dinamis -->
                <?php
                $userg = $this->session->userdata('usergroup');
                $menu = $this->mmenu->getMenu($userg);

                foreach ($menu as $menus) {

                    $a = $menus['id_menu'];
                    $submenu = $this->mmenu->SubMenu($a);
                    echo "<li class='";
                    if ($judul1 == $menus['menu']) {
                        echo "active";
                    }
                    echo "'><a href='#'><i class='" . $menus['icon'] . " fa-fw'></i>" . $menus['menu'] . " <span class='fa arrow'></span></a>";

                    echo "<ul class='nav nav-second-level collapse'>";
                    foreach ($submenu as $submenus) {
                        echo "<li class='";
                        if ($judul == $submenus['sub_menu']) {
                            echo "active";
                        }
                        echo "'><a href='" . base_url($submenus['url'])  . "'>";
                        echo "<i class='" . $submenus['icon'] . " fa-fw'></i>" . $submenus['sub_menu'] . "</a></li>";
                    }
                    echo "</ul></li>";
                }

                ?>
                <li>
                    <a href="index.html"><i class="fa fa-question-circle fa-lg"></i> <span class="nav-label">Help</span> </a>
                </li>


                <!--Penutup Area Menu Dinamis-->

            </ul>

        </div>
    </nav>

    <!-- <div id="page-wrapper" class="red-bg"> -->
    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-fixed-top  " role="navigation" style="margin-bottom: 0">
                <div class="navbar-header pull-left">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-default" href="#"><i class="fa fa-bars"></i> </a>

                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <span class="m-r-sm text-muted welcome-message">Sistem Informasi Manajemen Audit</span>
                    </li>
                    <li class="">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="text-white text-xs block"><i class="fa fa-user-circle-o"></i> <?php echo $this->session->userdata('nama');
                                                                                                        ?> <b class="caret"></b></span></a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a data-toggle="modal" data-target="#myModal">Profile</a></li>
                            <li><a href="<?php echo base_url() ?>dashboard/change">Change Password</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo base_url() ?>login/logout"> <i class="fa fa-sign-out"></i> <strong>Logout</strong> </a></li>
                        </ul>
                    </li>

                </ul>
            </nav>
            <div class="modal inmodal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title">Profile Detail</h4>
                        </div>
                        <div class="modal-body">
                            <div id="profil">
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-lg-3 col-xl-3 col-xs-3">
                                        <label>NIK</label>
                                    </div>
                                    <div class="col-md-1 col-sm-1 col-lg-1 col-xl-1 col-xs-1">
                                        <label>:</label>
                                    </div>
                                    <div class="col-md-8 col-sm-8 col-lg-8 col-lg-8 col-xs-8">
                                        <?php echo
                                            $this->session->userdata('nik');
                                        ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-lg-3 col-xl-3 col-xs-3">
                                        <label>Username</label>
                                    </div>
                                    <div class="col-md-1 col-sm-1 col-lg-1 col-xl-1 col-xs-1">
                                        <label>:</label>
                                    </div>
                                    <div class="col-md-8 col-sm-8 col-lg-8 col-lg-8 col-xs-8">
                                        <?php echo
                                            $this->session->userdata('username');
                                        ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-lg-3 col-xl-3 col-xs-3">
                                        <label>Perusahaan</label>
                                    </div>
                                    <div class="col-md-1 col-sm-1 col-lg-1 col-xl-1 col-xs-1">
                                        <label>:</label>
                                    </div>
                                    <div class="col-md-8 col-sm-8 col-lg-8 col-lg-8 col-xs-8">
                                        <?php echo
                                            $this->session->userdata('perusahaan');
                                        ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-lg-3 col-xl-3 col-xs-3">
                                        <label>Cabang</label>
                                    </div>
                                    <div class="col-md-1 col-sm-1 col-lg-1 col-xl-1 col-xs-1">
                                        <label>:</label>
                                    </div>
                                    <div class="col-md-8 col-sm-8 col-lg-8 col-lg-8 col-xs-8">
                                        <?php echo
                                            $this->session->userdata('cabang');
                                        ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-lg-3 col-xl-3 col-xs-3">
                                        <label>Status</label>
                                    </div>
                                    <div class="col-md-1 col-sm-1 col-lg-1 col-xl-1 col-xs-1">
                                        <label>:</label>
                                    </div>
                                    <div class="col-md-8 col-sm-8 col-lg-8 col-lg-8 col-xs-8">
                                        <?php echo
                                            $this->session->userdata('status');
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-sm-6">
                <h2><?php echo strtoupper($judul) ?></h2>
                <ol class="breadcrumb">
                    <?php foreach ($this->uri->segments as $segment) : ?>
                        <?php
                        $url = substr($this->uri->uri_string, 0, strpos($this->uri->uri_string, $segment)) . $segment;
                        $is_active =  $url == $this->uri->uri_string;
                        ?>
                        <li class="<?php echo $is_active ? 'active' : '' ?>">
                            <?php if ($is_active) : ?>
                                <?php echo str_replace("_", " ", ucwords($segment)) ?>
                            <?php else : ?>
                                <a href=""><?php echo str_replace("_", " ", ucfirst($segment)) ?></a>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ol>
            </div>

        </div>