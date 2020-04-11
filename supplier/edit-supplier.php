<div class="col-md-12">
    <div class="card">
        <div class="card-header card-header-warning">
            <h4 class="card-title">Update Supplier</h4>
            <p class="card-category">Update The Details Of Supplier</p>
        </div>
        <div class="card-body">
            <form role="form" id="supplier" method="POST">
                <div class="row">
                    <p class="d-none" id="supp_id"></p>
                    <div class="col-md-6">
                        <div class="form-group has-warning">
                            <label class="bmd-label-floating">Fist Name</label>
                            <input type="text" class="form-control" id="supp_fname" name="supp_fname" autofocus>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group has-warning">
                            <label class="bmd-label-floating">Last Name</label>
                            <input type="text" class="form-control" id="supp_lname" name="supp_lname">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group has-warning">
                            <label class="bmd-label-floating">Email address</label>
                            <input type="email" class="form-control" id="supp_email" name="supp_email">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group has-warning">
                            <label class="bmd-label-floating">Phone Number</label>
                            <input type="number" class="form-control" id="supp_phone" name="supp_phone">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group has-warning">
                            <label class="bmd-label-floating">Business Name</label>
                            <input type="text" class="form-control" id="bus_name" name="bus_name">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group has-warning">
                            <label class="bmd-label-floating">Business Email Address</label>
                            <input type="email" class="form-control" id="bus_email" name="bus_email">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group has-warning">
                            <label class="bmd-label-floating">Business Phone Number</label>
                            <input type="number" class="form-control" id="bus_phone" name="bus_phone">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group has-warning">
                            <label class="bmd-label-floating">Business Address</label>
                            <input type="text" class="form-control" id="bus_address" name="bus_address">
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary pull-left" onclick="showAndHide(event,'view-supplier','edit-supplier');">Back</button>
                <button class="btn btn-warning pull-right" >Update Supplier</button>
                <div class="clearfix"></div>
                
            </form>
        </div>
    </div>
</div>