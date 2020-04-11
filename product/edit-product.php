<div class="col-md-12">
    <div class="card">
        <div class="card-header card-header-warning">
            <h4 class="card-title">Update Product</h4>
            <p class="card-category">Update Details Of Product</p>
        </div>
        <div class="card-body">
            <form role="form" id="product-edit" method="POST">
                <div class="row">
                    <p class="d-none" id="prod_id"></p>
                    <div class="col-md-6">
                        <div class="form-group has-warning">
                            <label class="bmd-label-floating">Product Name</label>
                            <input type="text" class="form-control" id="prod_name" name="prod_name" autofocus>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group has-warning">
                            <label class="bmd-label-floating">Product Compamy Name</label>
                            <input type="text" class="form-control" id="prod_company_name" name="prod_company_name">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group has-warning">
                            <label class="bmd-label-floating">Quantity</label>
                            <input type="text" class="form-control" id="quantity" name="quantity">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group has-warning">
                            <label class="bmd-label-floating">Price</label>
                            <input type="text" class="form-control" id="price" name="price">
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary pull-left" onclick="showAndHide(event,'view-product','edit-product');">Back</button>
                <button class="btn btn-warning pull-right" >Update Product</button>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
</div>