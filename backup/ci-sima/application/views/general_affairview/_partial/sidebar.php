<body class="md-skin fixed-nav fixed-nav-basic fixed-sidebar">
    
    <div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header text-white text-center">
                    <h3>SIMA</h3>
                </li>
                <li class="<?php if($this->uri->segment(1) == 'dashboard') echo 'active'; ?>">
                    <a href="<?php base_url() ?>dashboard"><i class="fa fa-home fa-lg"></i> <span class="nav-label">Dashboard</span></a>
                </li>

                <!--Area Menu Dinamis -->
                <?php
                    $userg = 'UG003';
                    $menu =$this->mmenu->getMenu($userg);
                    
                    foreach ($menu as $menus) 
                    {
                        
                        $a = $menus['id_menu'];
                        $submenu=$this->mmenu->SubMenu($a);
                        echo "<li class='";
                        if($judul1==$menus['menu']) {echo "active";}
                        echo "'><a href='#'><i class='".$menus['icon']." fa-fw'></i>".$menus['menu']." <span class='fa arrow'></span></a>";

                        echo "<ul class='nav nav-second-level collapse'>";
                            foreach ($submenu as $submenus) 
                            {
                                echo "<li class='";
                                if($judul==$submenus['sub_menu']) {echo "active";}
                                echo "'><a href='". base_url($submenus['url'])  ."'>"; 
                                echo "<i class='".$submenus['icon']." fa-fw'></i>". $submenus['sub_menu']."</a></li>";
                            }
                            echo"</ul></li>";
                   }

                ?>
                <li>
                    <a href="index.html"><i class="fa fa-question-circle fa-lg"></i> <span class="nav-label">Help</span> </a>
                </li>
                
                
                <!--Penutup Area Menu Dinamis-->
                
            </ul>

        </div>
    </nav>

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
                <span class="text-white text-xs block"><i class="fa fa-user-circle-o"></i> Username <b class="caret"></b></span></a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="profile.html">Profile</a></li>
                            <li><a href="contacts.html">Change Password</a></li>
                            <li class="divider"></li>
                            <li><a href="login.html"> <i class="fa fa-sign-out"></i> <strong>Logout</strong> </a></li>
                        </ul>
            </li>    

            </ul>

        </nav>
        </div>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-6">
                    <h2><?php echo strtoupper($judul) ?></h2>
                    <ol class="breadcrumb">
                    <?php foreach ($this->uri->segments as $segment): ?>
                        <?php 
                            $url = substr($this->uri->uri_string, 0, strpos($this->uri->uri_string, $segment)) . $segment;
                            $is_active =  $url == $this->uri->uri_string;
                        ?>
                        <li class="<?php echo $is_active ? 'active': '' ?>">
                            <?php if($is_active): ?>
                                <?php echo str_replace("_"," ",ucwords($segment)) ?>
                            <?php else: ?>
                                <a href=""><?php echo str_replace("_"," ",ucfirst($segment)) ?></a>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                    </ol>
                </div>

            </div>