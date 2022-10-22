<div class="wrapper wrapper-content m-t-xl wrapper wrapper-content animated fadeInRight">
    <div class="panel">
        <div class="panel-body text-center">

            <div class="row">
                <?php if ($this->session->userdata('usergroup') == 'UG005') {
                ?>
                    <div class="col-lg-2">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title red-bg text-white">
                                <h5>
                                    <i class="fa fa-users fa-fw"></i> User
                                </h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?php echo $user; ?></h1>
                                <!-- <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div> -->
                                <small class=" text-success">Total user <i class="fa fa-level-up"></i></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title red-bg text-white">
                                <h5>
                                    <i class="fa fa-user fa-fw"></i> User Group
                                </h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?php echo $usergroup; ?></h1>
                                <!-- <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div> -->
                                <small class=" text-success">Total User Group <i class="fa fa-level-up"></i></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title red-bg text-white">
                                <h5>
                                    <i class="fa fa-gears fa-fw"></i> Cabang
                                </h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?php echo $cabang; ?></h1>
                                <!-- <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div> -->
                                <small class=" text-success">Total cabang <i class="fa fa-level-up"></i></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title red-bg text-white">
                                <h5>
                                    <i class="fa fa-info-circle fa-fw"></i> Audit Unit
                                </h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?php echo $auditunit; ?></h1>
                                <!-- <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div> -->
                                <small class=" text-success">Total Audit Unit <i class="fa fa-level-up"></i></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title red-bg text-white">
                                <h5>
                                    <i class="fa fa-info-circle fa-fw"></i> Audit Part
                                </h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?php echo $auditpart; ?></h1>
                                <!-- <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div> -->
                                <small class=" text-success">Total Audit Part <i class="fa fa-level-up"></i></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title red-bg text-white">
                                <h5>
                                    <i class="fa fa-clipboard fa-fw"></i> Inventory
                                </h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?php echo $inventory; ?></h1>
                                <!-- <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div> -->
                                <small class=" text-success">Total Inventory<i class="fa fa-level-up"></i></small>
                            </div>
                        </div>
                    </div>

                <?php } ?>
            </div>
            <div class="row">
                <h1 class="text-dark text-center"> WELCOME
                    <?php echo strtoupper($this->session->userdata('username')) ?>
                </h1>
                <?php
                if ($this->session->userdata('usergroup') == 'UG001') {
                ?>
                    <h1 class="text-dark text-center">WELCOME TO SISTEM MANAGEMENT AUDIT</h1>
                    <h2 class="text-dark text-center">General Affair</h2>
                <?php
                } elseif ($this->session->userdata('usergroup') == 'UG002') {
                ?>
                    <h1 class="text-dark text-center">WELCOME TO SISTEM MANAGEMENT AUDIT</h1>
                    <h2 class="text-dark text-center">Auditor</h2>
                <?php
                } elseif ($this->session->userdata('usergroup') == 'UG003') {
                ?>
                    <h1 class="text-dark text-center">WELCOME TO SISTEM MANAGEMENT AUDIT</h1>
                    <h2 class="text-dark text-center">Manager Auditor</h2>
                <?php
                } elseif ($this->session->userdata('usergroup') == 'UG004') {
                ?>
                    <h1 class="text-dark text-center">WELCOME TO SISTEM MANAGEMENT AUDIT</h1>
                    <h2 class="text-dark text-center">Admin cabang</h2>
                <?php
                } elseif ($this->session->userdata('usergroup') == 'UG005') {
                ?>
                    <h1 class="text-dark text-center">WELCOME TO SISTEM MANAGEMENT AUDIT</h1>
                    <h2 class="text-dark text-center">Super Admin</h2>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>