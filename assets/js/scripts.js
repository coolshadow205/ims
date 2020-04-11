var generateId = 0;
/*Custom validation for customer selection on billing site*/
function removeDanger(element){
    var parentDiv = element.parentNode;
    if(parentDiv.classList.contains("has-danger")){
        parentDiv.classList.remove("has-danger");
        parentDiv.classList.add("has-success");
        if(!document.getElementById('cust_id-error').classList.contains("d-none"))
        document.getElementById('cust_id-error').classList.add("d-none");
    }
}
/*Custom validation for customer selection on billing site*/
function customValidation(selection){
    var parentDiv = selection.parentNode;
    if(parentDiv.classList.contains("has-success")){
        parentDiv.classList.remove("has-success");
    }
    if(!parentDiv.classList.contains("has-danger")){
        parentDiv.classList.add("has-danger");
    }
    var label = document.createElement("label");
    label.setAttribute("id","cust_id-error");
    label.setAttribute("class","small");
    label.appendChild(document.createTextNode('Please select the customer'));
    parentDiv.appendChild(label);
}
/**
 * [generateBill In this function we are first fetching the data(prod_id , quantity , prod_price , grant_total) from the table using the id give to each row of table that is been inserted using js.
 * After fetching first we insert into invoice table using ajax(outer ajax). 
 * In response we get the invoice_number this invoice_number is used for inserting data(linking sales item with the invoice table.) in sales table.]
 * 
 * @param  {[Object]} event [to gain the control further action.]
 * @return {[type]}       [description]
 */
function generateBill(event){
    event.preventDefault();
    var selection = document.getElementById('cust_id');
    var cust_id = selection.value;
    if(cust_id == ""){
        customValidation(selection);
        return;
    }
    var prod_id = [];
    var quantity = [];
    var prod_price = [];
    var id = 1 , i = 0;
    // the loop has condition < because the last row is for grand_total.
    for (id = 1 , i = 0; id < generateId ; id++,i++) {
        var tr = document.getElementById('body-row-'+id);
        prod_id[i] = tr.getElementsByTagName("td")[0].innerHTML;
        quantity[i] = tr.getElementsByTagName("td")[2].innerHTML;
        prod_price[i] = tr.getElementsByTagName("td")[3].innerHTML;
    }
    var grand_total = document.getElementById('body-row-'+id).getElementsByTagName("td")[3].innerHTML;

    var myRequest = new XMLHttpRequest();

    myRequest.onload = function(){
        var invoice_number = this.responseText;
        //Loop for inserting products one by one in sales table.
        for (var i = 0; i < (generateId-1) ; i++) {
            var internalAjax = new XMLHttpRequest();
            //Inner ajax request to insert data into sales table.
            internalAjax.onload = function(){};
            // I need send the ajax request in synchronous way so i have given false in parameter. Due to which the execution will stop(the for loop wont execute untill i get response) unless and untill the response is given from the file to which the request is sent.
            internalAjax.open('POST', 'manage-ajax.php', false);
            internalAjax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            internalAjax.send("invoice_number="+invoice_number+"&prod_id="+prod_id[i]+"&quantity="+quantity[i]+"&amount="+prod_price[i]+"&manage=invoice_product");
        }
        // As we sending data synchronously we will change url to invoice.php?invoice_number=somenumber.
        window.location = "invoice.php?invoice="+invoice_number;//This line will be executed only after the loop is executed as we are working synchronously this code is perfect.
    };
    myRequest.open('POST','manage-ajax.php',true);
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send("cust_id="+cust_id+"&grand_total="+grand_total+"&manage=generate_invoice");
}
function checkingOut(event){
    event.preventDefault();
    // alert("Clicked");
    if(!document.getElementById('no-product').classList.contains("d-none")){
        //Showing notification as there are no product in the cart.
        showAlert('top','center','warning','There are no products in carts.');
        return;
    }
    //Checking if the 'd-none' class already exist or not in '#adding-cart-div' if not then add.
    if(!document.getElementById('adding-cart-div').classList.contains("d-none"))
        document.getElementById('adding-cart-div').classList.add("d-none");
    //Checking if the 'col-md-6' class already exist or not in '#cart-table' if yes then remove it and add 'col-md-12'.
    if(document.getElementById('cart-table-div').classList.contains("col-md-6")){
        document.getElementById('cart-table-div').classList.remove("col-md-6");
        document.getElementById('cart-table-div').classList.add("col-md-12");
    }
    if(document.getElementById('customer-selector').classList.contains("d-none"))
        document.getElementById('customer-selector').classList.remove("d-none");
    
    var th = document.createElement('th');
    var thText = document.createTextNode('Sub-Total');
    th.appendChild(thText);
    document.getElementById('cart-table-head').appendChild(th);
    
    var prod_id = [];
    var quantity = [];
    var prod_price = [];
    var sub_total = [];
    var grand_total = 0;
    var i;
    var td;
    for (var id = 1 , i = 0; id <=generateId ; id++,i++) {
        var tr = document.getElementById('body-row-'+id);
        prod_id[i] = tr.getElementsByTagName("td")[1].innerHTML;
        quantity[i] = tr.getElementsByTagName("td")[2].innerHTML;
        prod_price[i] = tr.getElementsByTagName("td")[3].innerHTML;
        sub_total[i] = prod_price[i] * quantity[i];
        grand_total += sub_total[i];
        td = document.createElement("td");
        td.appendChild(document.createTextNode(sub_total[i]));
        tr.appendChild(td);
    }
    var tr = document.createElement("tr");
    generateId++;
    tr.setAttribute('id','body-row-'+generateId);

    for(i=0 ; i<3 ; i++){
        //creating 3 blank td tag.
        td = document.createElement("td");
        td.appendChild(document.createTextNode(""));
        tr.appendChild(td);
    }

    td = document.createElement("td");
    td.appendChild(document.createTextNode(grand_total));
    tr.appendChild(td);

    document.getElementById("cart-table-body").appendChild(tr);

    var aTag = document.createElement("a");
    aTag.appendChild(document.createTextNode("Generate Bill"));
    
    aTag.setAttribute("class","btn btn-success pull-left");
    aTag.setAttribute("onclick","generateBill(event);");
    aTag.setAttribute("onchange","removeDanger(this);");
    document.getElementById("cart-table").appendChild(aTag);
    var div = document.createElement("div");
    div.setAttribute("class","clearfix");
    document.getElementById("cart-table").appendChild(div);
}
function addToCart(){
    var selection = document.getElementById('prod_id');
    var prod_id = selection.value;
    var prod_name = selection.options[selection.selectedIndex].innerHTML;
    var quantity = document.getElementById('quantity').value;
    var price = document.getElementById('price').value;

    var myRequest = new XMLHttpRequest();

    myRequest.onload = function(){
        // Converting given string into integer to compare prorperly Number is class that returns me the number that we have given it has string.
        if(Number(this.responseText) < Number(quantity)){
            // alert("Not working");
            showAlert('top','center','danger',"You don't have that much qunatity.");
            return;
        }
        if(this.responseText === quantity)
            showAlert('top','center','info',prod_name+" is totally sold out so please order the product.");

        generateId++;

        //hide no-product and showing the table as there is some product in the cart.
        document.getElementById('no-product').classList.add("d-none");
        document.getElementById('cart-table').classList.remove("d-none");

        var tr = document.createElement("tr");// Creating tr to store the values of the selected product in one row. 
        tr.setAttribute('id','body-row-'+generateId);//Adding id to tr for further use.

        var prodIdTd = document.createElement("td");
        var prodIdText = document.createTextNode(prod_id);
        prodIdTd.appendChild(prodIdText);
        prodIdTd.classList.add('d-none');
        
        var prodNameTd = document.createElement("td");// Creating 'td' tag to store the product name.
        var prodNameText = document.createTextNode(prod_name);// Converting the text(product name) to the node text. 
        prodNameTd.appendChild(prodNameText);// actually appending the 'prodNameText' to the 'prodNameTd' it will look like this in html <td>prodNameText</td> 
        
        var quantityTd = document.createElement("td");// Creating 'td' tag to store the qunatity of the product.
        var quantityText = document.createTextNode(quantity);// Converting the text(product quantity) to the node text.
        quantityTd.appendChild(quantityText);// actually appending the 'quantityText' to the 'quantityTd' it will look like this in html <td>quantityText</td> 
        
        var priceTd = document.createElement("td");// Creating 'td' tag to store the price of the product.
        var priceText = document.createTextNode(price);// Converting the text(product price) to the node text.
        priceTd.appendChild(priceText);// actually appending the 'priceText' to the 'priceTd' it will look like this in html <td>priceText</td> 

        // Now putting the 'td' tag into tr tag one by one
        tr.appendChild(prodIdTd);
        tr.appendChild(prodNameTd);
        tr.appendChild(quantityTd);
        tr.appendChild(priceTd);

        // Now putting 'tr' in the tbody using tbody ID.
        document.getElementById('cart-table-body').appendChild(tr);

        document.getElementById('quantity').value = "";

        //Updating scrollbar.
        $('.main-panel').perfectScrollbar('update');
    };

    myRequest.open('POST','manage-ajax.php',true);
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send("prod_id="+prod_id+"&manage=product_quantity");
}

function showPriceOfProduct(){
    var prod_id = document.getElementById('prod_id').value;
    
    var myRequest = new XMLHttpRequest();
    myRequest.onload = function() {
        var parts = this.responseText.split('`&`');// spliting by `&`
        var productDetails = {};// creating an associative array.

        productDetails['quantity'] = parts[0];
        productDetails['price'] = parts[1];

        //SET VALUES
        document.getElementById('price').value = productDetails['price'];
        document.getElementById('quantity').focus();
    };
    myRequest.open('POST','manage-ajax.php',true);
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send("prod_id="+prod_id+"&manage=product_price");
}
function showAndHide(event, show , hide){
    event.preventDefault();
    document.getElementById(hide).classList.add("d-none");
    document.getElementById(show).classList.remove("d-none");    
}
function editProductClicked(event , prod_id , table_id){
    event.preventDefault();

    // Hide the entire HTML Table
    document.getElementById(table_id).classList.add("d-none");

    // Now show the hidden 'edit-supplier' page
    document.getElementById("edit-product").classList.remove("d-none");

    // Setting the previous supplier_detail using ajax
    var myRequest = new XMLHttpRequest();
    myRequest.onload = function() {
        var parts = this.responseText.split('`&`');// spliting by `&`
        var productDetails = {}; // Store in the productDetails associative array

        productDetails['prod_name'] = parts[0];
        productDetails['prod_company_name'] = parts[1];
        productDetails['quantity'] = parts[2];
        productDetails['price'] = parts[3];

        //SET VALUES
        document.getElementById('prod_name').value = productDetails['prod_name'];
        document.getElementById('prod_company_name').value = productDetails['prod_company_name'];
        document.getElementById('quantity').value = productDetails['quantity'];
        document.getElementById('price').value = productDetails['price'];
        document.getElementById('prod_id').value = prod_id;
    };

    myRequest.open("POST", "manage-ajax.php" , true);
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send("prod_id="+prod_id+"&manage=edit_product_clicked");
}
function editCustomerClicked(event , cust_id , table_id , row){
     event.preventDefault(); 

    // Hide the entire HTML Table
    document.getElementById(table_id).classList.add("d-none");

    // Now show the hidden 'edit-customer' page
    document.getElementById("edit-customer").classList.remove("d-none");

    // Setting the previous customer_detail using ajax
    var myRequest = new XMLHttpRequest();
    myRequest.onload = function() {
        var parts = this.responseText.split("`&`"); // spliting by `&`
        var customerDetails = {}; // Store in the customerDetails associative array

        customerDetails['cust_fname'] = parts[0];
        customerDetails['cust_lname'] = parts[1];
        customerDetails['cust_email'] = parts[2];
        customerDetails['cust_phone'] = parts[3];
        customerDetails['cust_gender'] = parts[4];
        customerDetails['cust_alt_phone'] = parts[5];
         customerDetails['cust_state'] = parts[6];
         customerDetails['cust_city'] = parts[7];
         customerDetails['cust_code'] = parts[8];
        customerDetails['cust_address'] = parts[9];

        //SET VALUES
        document.getElementById('cust_fname').value = customerDetails['cust_fname'];
        document.getElementById('cust_lname').value = customerDetails['cust_lname'];
        document.getElementById('cust_email').value = customerDetails['cust_email'];
        document.getElementById('cust_phone').value = customerDetails['cust_phone'];
        document.getElementById('cust_gender').value = customerDetails['cust_gender'];
        document.getElementById('cust_alt_phone').value = customerDetails['cust_alt_phone'];
        document.getElementById('cust_state').value = customerDetails['cust_state'];
        document.getElementById('cust_city').value = customerDetails['cust_city'];
        document.getElementById('cust_code').value = customerDetails['cust_code'];
        document.getElementById('cust_address').value = customerDetails['cust_address'];
        document.getElementById('cust_id').value = cust_id;

    };

    myRequest.open("POST", "manage-ajax.php", true); 
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send("cust_id="+cust_id+"&manage=edit_customer_clicked");
}
function deleteCustomerClicked(event , cust_id){
    event.preventDefault();
    swal({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#2196f3',
          cancelButtonColor: '#f44336',
          confirmButtonText: 'Confirm'
        }).then((result) => {
          if (result.value) {
            var myRequest = new XMLHttpRequest();
            myRequest.open("POST", "manage-ajax.php", true);
            myRequest.onload = function() {
                alert("Response" +this.responseText);
                if(this.responseText === "true") {
                    swal({
                      title:'Deleted!',
                      text:'Customer has been deleted.',
                      type:'success',
                      showConfirmButton: false,
                      timer: 1600
                    });
                    window.location = "customer.php";
                }
            };

            myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            myRequest.send("cust_id="+cust_id+"&manage=delete_customer_clicked");
          }
        });
}
function addOrUpdateCustomer(task) {
    var cust_fname = document.getElementById('cust_fname').value;
    var cust_lname = document.getElementById('cust_lname').value;
    var cust_email = document.getElementById('cust_email').value;
    var cust_phone = document.getElementById('cust_phone').value;
    var cust_gender = document.getElementById('cust_gender').value;
    var cust_alt_phone = document.getElementById('cust_alt_phone').value;
    var cust_state = document.getElementById('cust_state').value;
    var cust_city = document.getElementById('cust_city').value;
    var cust_code = document.getElementById('cust_code').value;
    var cust_address = document.getElementById('cust_address').value;
    
    var dataIs = "cust_fname="+cust_fname+"&cust_lname="+cust_lname+"&cust_email="+cust_email+"&cust_phone="+cust_phone+"&cust_gender="+cust_gender+"&cust_state="+cust_state+"&cust_alt_phone="+cust_alt_phone+"&cust_address="+cust_address+"&cust_city="+cust_city+"&cust_code="+cust_code+"&task="+task;
    var pathOfFile = "../";
    if(task === 'edit'){
        pathOfFile = "";
        var cust_id = document.getElementById('cust_id').value;
        dataIs += "&cust_id="+cust_id;
    }
    dataIs += "&manage=customer";

    var myRequest = new XMLHttpRequest();

    myRequest.onload = function(){
        // RESPONSE
        if(this.responseText === "true") {
            window.location = pathOfFile+"customer.php";
            // document.getElementById("post-question-form").submit();
        } else if(this.responseText === "false") {
            alert("false");
            // document.getElementById("askedQuestion-error").innerHTML = "Something Wrong happened!";
        }       
    };

    myRequest.open("POST", pathOfFile+"manage-ajax.php", true); 
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send(dataIs);
}
/**
 * [deleteSupplierClicked this function internal uses sweet alert 'swal' to genrate a dialog box with different for confirming that user is sure to delete supplier.
 * and then it use ajax to delete the supplier by passing supplier_id 'supp_id' to manage-ajax file.]
 * @param   event   [It is used pervent event any submit event by using preventDefault function.]
 * @param   supp_id [We will pass supp_id to php file to get supplier that has to be edited.]
 */
function deleteSupplierClicked(event , supp_id){
    event.preventDefault();
    swal({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#2196f3',
          cancelButtonColor: '#f44336',
          confirmButtonText: 'Confirm'
        }).then((result) => {
          if (result.value) {
            var myRequest = new XMLHttpRequest();
            myRequest.open("POST", "manage-ajax.php", true);
            myRequest.onload = function() {
                if (this.responseText === "true") {
                    swal({
                      title:'Deleted!',
                      text:'Supplier has been deleted.',
                      type:'success',
                      showConfirmButton: false,
                      timer: 1600
                    });
                    window.location = "supplier.php";
                }
            };

            myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            myRequest.send("supp_id="+supp_id+"&manage=delete_supplier_clicked");
          }
        });
}
/**
 * [editSupplierClicked this function is used to hide the table(using table_id) and show the edit page to user.
 * the supplier data is retrieved using supplier_id all the data retrieval part is done by php.
 * php then sends this data to js and then my js splits data using this symbol(`&`).
 * Then just put that splited array in associative array and send the data to the html using id of the tag. ]
 * @param  event    [It is used pervent event any submit event by using preventDefault function.]
 * @param  supp_id  [We will pass supp_id to php file to get supplier that has to be edited .]
 * @param  table_id [To hide the given table_id]
 * @return {[type]}          [description]
 */
function editSupplierClicked(event , supp_id , table_id ){
     event.preventDefault(); 

    // Hide the entire HTML Table
    document.getElementById(table_id).classList.add("d-none");

    // Now show the hidden 'edit-supplier' page
    document.getElementById("edit-supplier").classList.remove("d-none");

    // Setting the previous supplier_detail using ajax
    var myRequest = new XMLHttpRequest();
    myRequest.onload = function() {
        var parts = this.responseText.split("`&`"); // spliting by `&`
        var supplierDetails = {}; // Store in the supplierDetails associative array

        supplierDetails['supp_fname'] = parts[0];
        supplierDetails['supp_lname'] = parts[1];
        supplierDetails['supp_email'] = parts[2];
        supplierDetails['supp_phone'] = parts[3];
        supplierDetails['bus_name'] = parts[4];
        supplierDetails['bus_email'] = parts[5];
        supplierDetails['bus_phone'] = parts[6];
        supplierDetails['bus_address'] = parts[7];

        //SET VALUES
        document.getElementById('supp_fname').value = supplierDetails['supp_fname'];
        document.getElementById('supp_lname').value = supplierDetails['supp_lname'];
        document.getElementById('supp_email').value = supplierDetails['supp_email'];
        document.getElementById('supp_phone').value = supplierDetails['supp_phone'];
        document.getElementById('bus_name').value = supplierDetails['bus_name'];
        document.getElementById('bus_email').value = supplierDetails['bus_email'];
        document.getElementById('bus_phone').value = supplierDetails['bus_phone'];
        document.getElementById('bus_address').value = supplierDetails['bus_address'];
        document.getElementById('supp_id').value = supp_id;

    };

    myRequest.open("POST", "manage-ajax.php", true); 
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send("supp_id="+supp_id+"&manage=edit_supplier_clicked");
}
function addOrUpdateProduct(task){
    var prod_name = document.getElementById('prod_name').value;
    var prod_company_name = document.getElementById('prod_company_name').value;
    var quantity = document.getElementById('quantity').value;
    var price = document.getElementById('price').value;

    var dataIs = "prod_name="+prod_name+"&prod_company_name="+prod_company_name+"&quantity="+quantity+"&price="+price+"&task="+task;
    var pathOfFile = "../";
    if(task === 'edit'){
        pathOfFile = "";
        var prod_id = document.getElementById('prod_id').value;
        dataIs += "&prod_id="+prod_id;
    }
    else if(task === "add"){
        var supp_id = document.getElementById('supp_id').value;
        dataIs+="&supp_id="+supp_id;
    }
    dataIs += "&manage=product";
    var myRequest = new XMLHttpRequest();

    myRequest.onload = function(){
        // RESPONSE
        if(this.responseText === "true") {
            window.location = pathOfFile+"product.php";
            // document.getElementById("post-question-form").submit();
        } else if(this.responseText === "false") {
            alert("false");
            // document.getElementById("askedQuestion-error").innerHTML = "Something Wrong happened!";
        }       
    };
    myRequest.open("POST", pathOfFile+"manage-ajax.php", true); 
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send(dataIs);

}
/**
 * [addOrUpdateSupplier this function is used to add/update data of the supplier as all the fields in add-supplier and edit-supplier are same i have only used one function to do both the task.
 * to identify which operation is to perform i used the param 'task' it is set to 'add' if i want to add supplier else it is set to 'edit'.
 * if the task is 'edit' then we get the supplier_id from the p tag that is hidden in the form. 
 * Then we send the ajax request to manaage-ajax.php where in php i just check task that i have sent from js as i don't want to write two different code for different task.
 * If task is 'add' in js then we just get all the data from the form and send that data to the manaage-ajax.php by setting manage value to 'supplier' where again in php it will check for the task.
 * And if the response is true i just change the loaction to 'supplier.php']
 * @param {[type]} task [It used to specify the php and js file that which task('add/edit') is to be done.]
 */
function addOrUpdateSupplier(task) {
    var supp_fname = document.getElementById('supp_fname').value;
    var supp_lname = document.getElementById('supp_lname').value;
    var supp_email = document.getElementById('supp_email').value;
    var supp_phone = document.getElementById('supp_phone').value;
    var bus_name = document.getElementById('bus_name').value;
    var bus_email = document.getElementById('bus_email').value;
    var bus_phone = document.getElementById('bus_phone').value;
    var bus_address = document.getElementById('bus_address').value;
    
    var dataIs = "supp_fname="+supp_fname+"&supp_lname="+supp_lname+"&supp_email="+supp_email+"&supp_phone="+supp_phone+"&bus_name="+bus_name+"&bus_email="+bus_email+"&bus_phone="+bus_phone+"&bus_address="+bus_address+"&task="+task;
    var pathOfFile = "../";
    if(task === 'edit'){
        pathOfFile = "";
        var supp_id = document.getElementById('supp_id').value;
        dataIs += "&supp_id="+supp_id;
    }
    dataIs += "&manage=supplier";

    var myRequest = new XMLHttpRequest();

    myRequest.onload = function(){
        // RESPONSE
        if(this.responseText === "true") {
            window.location = pathOfFile+"supplier.php";
            // document.getElementById("post-question-form").submit();
        } else if(this.responseText === "false") {
            alert("false");
            // document.getElementById("askedQuestion-error").innerHTML = "Something Wrong happened!";
        }       
    };

    myRequest.open("POST", pathOfFile+"manage-ajax.php" , true); 
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send(dataIs);
}
/************************************************************************************************/
/************************************ USING JQUERY FROM HERE ************************************/
/************************************************************************************************/

$(document).ready(function() {
    /*-------------------------------------------------------------------------------------------------*/
    /*------------------------------- FORM VALIDATIONS USING jQuery.validate.js -----------------------*/
    /*-------------------------------------------------------------------------------------------------*/
    $.validator.setDefaults({
    	errorClass: "small",
    	highlight: function(element) { // if some input is invalid(for any element), please highlight the display message using this function
    		$(element).closest(".form-group").addClass("has-danger"); // 'has-error' - a bootstrap class indicating invalid input by making the border of the input red.
    	},
    	unhighlight: function(element) {
    		$(element).closest(".form-group").removeClass("has-danger");
    	},
    });


    $.validator.addMethod("containsLetterWhitespace", function(value, element) {
        return this.optional(element) || /^[a-zA-Z\s]+$/i.test(value);
    }, "The field has number please enter the correct value.");


    $("#supplier").validate({
    	rules: {
    		supp_fname: {
    			required: true,
    			nowhitespace: true,
    			lettersonly: true
    		},
    		supp_lname: {
    			required: true,
    			nowhitespace: true,
    			lettersonly: true
    		},
    		supp_email: {
    			required: true,
    			email: true
    		},
            supp_phone: {
                required: true,
                minlength:10,
                maxlength:10
            },
            bus_name: {
                required: true
            },
            bus_email: {
                required: true,
                email: true
            },
            bus_phone: {
                required: true,
                minlength:10,
                maxlength:10
            },
            bus_address: {
                required:true
            }
    	},
    	messages: {
    		supp_fname: {
    			required: "Please enter suppliers first name.",
    			nowhitespace: "Please do not enter whitespaces between letters.",
    			lettersonly: "Please enter letters only."
    		},
    		supp_lname: {
    			required: "Please enter suppliers last name.",
    			nowhitespace: "Please do not enter whitespaces between letters.",
    			lettersonly: "Please enter letters only."
    		},
    		supp_email: {
    			required: "Please enter an email address.",
    			email: "Please enter a <em>valid</em> email address."
    		},
            supp_phone: {
                required: "Please enter an phone number.",
                minlength: "Please enter a <em>valid</em> mobile number.",
                maxlength: "Please enter a <em>valid</em> mobile number."
            },
            bus_name: {
                required: "Please enter business name."
            },
            bus_email: {
                required: "Please enter an business email address.",
                email: "Please enter a <em>valid</em> email address."
            },
            bus_phone: {
                required: "Please enter an business phone address.",
                minlength: "Please enter a <em>valid</em> mobile number.",
                maxlength: "Please enter a <em>valid</em> mobile number."
            },
            bus_address: {
                required: "Please enter business address."
            }
    	},
        submitHandler: function(){ 
            if(window.location['pathname'] === '/ims/supplier/add-supplier.php'){
                addOrUpdateSupplier("add");
            }
            else{
                addOrUpdateSupplier("edit"); 
            }
        }
    });
    $("#customer").validate({
        rules: {
            cust_fname: {
                required: true,
                nowhitespace: true,
                lettersonly: true
            },
            cust_lname: {
                required: true,
                nowhitespace: true,
                lettersonly: true
            },
            cust_email: {
                required: true,
                email: true
            },
            cust_phone: {
                required: true,
                minlength:10,
                maxlength:10
            },
            cust_gender: {
                required: true,
            },
            cust_alt_phone: {
                minlength:10,
                maxlength:10
            },
            cust_state: {
                required: true,
                containsLetterWhitespace: true
            },
            cust_city: {
                required: true,
                containsLetterWhitespace: true
            },
            cust_code: {
                required: true,
                minlength:6,
                maxlength:6
            },
            cust_address: {
                required:true
            }
        },
        messages: {
            cust_fname: {
                required: "Please enter customers first name.",
                nowhitespace: "Please do not enter whitespaces between letters.",
                lettersonly: "Please enter letters only."
            },
            cust_lname: {
                required: "Please enter customers last name.",
                nowhitespace: "Please do not enter whitespaces between letters.",
                lettersonly: "Please enter letters only."
            },
            cust_email: {
                required: "Please enter an email address.",
                email: "Please enter a <em>valid</em> email address."
            },
            cust_phone: {
                minlength: "Please enter a <em>valid</em> mobile number.",
                maxlength: "Please enter a <em>valid</em> mobile number."
            },
            cust_gender: {
                required: "Please select atleast one field."
            },
            cust_state: {
                required: "Please enter state."
            },
            cust_city: {
                required: "Please enter an customer city name."
            },
            cust_code: {
                required: "Please enter area code.",
                minlength: "Please enter a <em>valid</em> area code.",
                maxlength: "Please enter a <em>valid</em> area code."
            },
            cust_alt_phone: {
                required: "Please enter alternate mobile number.",
                minlength: "Please enter a <em>valid</em> mobile number.",
                maxlength: "Please enter a <em>valid</em> mobile number."
            },
            cust_address: {
                required: "Please enter customers address."
            }
        },
        submitHandler: function(){ 
            if(window.location['pathname'] === '/ims/customer/add-customer.php'){
                addOrUpdateCustomer("add");
            }
            else{
                addOrUpdateCustomer("edit"); 
            }
        }
    });
    $("#product").validate({
        rules: {
            prod_name: {
                required: true
            },
            prod_company_name: {
                required: true
            },
            quantity: {
                required: true,
                digits: true,
                min:1
            },
            price: {
                required: true,
                number: true,
                min:1
            },
            supp_id: {
                required:true
            }
        },
        messages: {
            prod_name: {
                required: "Please enter product name."
            },
            prod_company_name: {
                required: "Please enter product company name."
            },
            quantity: {
                required: "Please enter an quantity of product.",
                digits: "Please enter digits only",
                min: "Qunatity must be great than one."
            },
            price: {
                required: "Please enter business name.",
                number: "Please enter number only",
                min: "Qunatity must be great than one."
            },
            supp_id: {
                required: "Please select the supplier name."
            }
        },
        submitHandler: function(){ addOrUpdateProduct("add"); }
    });
    $("#product-edit").validate({
        rules: {
            prod_name: {
                required: true
            },
            prod_company_name: {
                required: true
            },
            quantity: {
                required: true,
                digits: true,
                min:1
            },
            price: {
                required: true,
                number: true,
                min:1
            }
        },
        messages: {
            prod_name: {
                required: "Please enter product name."
            },
            prod_company_name: {
                required: "Please enter product company name."
            },
            quantity: {
                required: "Please enter an quantity of product.",
                digits: "Please enter digits only",
                min: "Qunatity must be great than one."
            },
            price: {
                required: "Please enter business name.",
                number: "Please enter number only",
                min: "Qunatity must be great than one."
            }
        },
        submitHandler: function(){ addOrUpdateProduct("edit"); }
    });
    $("#adding-cart-form").validate({
        rules: {
            prod_id: {
                required: true
            },
            quantity: {
                required: true,
                digits: true,
                min:1
            }
        },
        messages: {
            prod_id: {
                required: "Please select product name."
            },
            quantity: {
                required: "Please enter an quantity of product.",
                digits: "Please enter digits only",
                min: "Qunatity must be great than one."
            }
        },
        submitHandler: function(){ addToCart(); }
    });
});

/*Creating Notification through bootstrap notify plugin.*/
function showAlert(from, align , color , msg) {
    $.notify({
      icon: "add_alert",
      message: msg

    }, {
      type: color,
      timer: 3000,
      placement: {
        from: from,
        align: align
      }
    });
}