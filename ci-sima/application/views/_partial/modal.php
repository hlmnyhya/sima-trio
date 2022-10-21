<div class="modal inmodal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Profile Detail</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url() ?>dashboard/change" id="changepass">
                    <div id="profil">
                        <div class="row form-group">
                            <div class="col-md-3 col-sm-3 col-lg-3 col-xl-3 col-xs-3">
                                <label>Current Password</label>
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url() ?>assets/js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/jquery.validate.js"></script>
    <script>
        $("#changepass").validate({
            rules: {
                currpass: {
                    required: true,
                    minlength: 8
                },
                newpass: {
                    required: true,
                    minlength: 8
                },
                confipass: {
                    equalTo: "#newpass"
                }

            }
        });
    </script>