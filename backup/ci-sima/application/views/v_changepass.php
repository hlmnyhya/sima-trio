<div class="wrapper wrapper-content m-t-xl wrapper wrapper-content animated fadeInRight">
    <div class="panel col-sm-6">
        <div class="panel-body">

            <form method="post" action="<?php echo base_url() ?>dashboard/post_change" id="changepass">
                <div class="row form-group">
                    <div class="col-md-3 col-sm-3 col-lg-3 col-xl-3 col-xs-3">
                        <label class="control-label">Current Password</label>
                    </div>
                    <div class="col-md-1 col-sm-1 col-lg-1 col-xl-1 col-xs-1">
                        <label>:</label>
                    </div>
                    <div class="col-md-8 col-sm-8 col-lg-8 col-lg-8 col-xs-8">
                        <input type="password" name="currpass" id="currpass" class="form-control">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3 col-sm-3 col-lg-3 col-xl-3 col-xs-3">
                        <label>New Password</label>
                    </div>
                    <div class="col-md-1 col-sm-1 col-lg-1 col-xl-1 col-xs-1">
                        <label>:</label>
                    </div>
                    <div class="col-md-8 col-sm-8 col-lg-8 col-lg-8 col-xs-8">
                        <input type="password" name="newpass" id="newpass" class="form-control">

                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3 col-sm-3 col-lg-3 col-xl-3 col-xs-3">
                        <label>Confirm Password</label>
                    </div>
                    <div class="col-md-1 col-sm-1 col-lg-1 col-xl-1 col-xs-1">
                        <label>:</label>
                    </div>
                    <div class="col-md-8 col-sm-8 col-lg-8 col-lg-8 col-xs-8">
                        <input type="password" name="confpass" id="confpass" class="form-control">

                    </div>
                </div>
                <div class="pull-right">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>