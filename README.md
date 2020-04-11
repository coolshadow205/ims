# IMS
A simple Inventory Management System website implemented using object-oriented php.

# Abstract
IMS provides an efficient way to keep track of your inventory. IMS is website through which user can digital keep track of products that is added into the database. So from now on user wont have to do any paper work for the products that user has added into the database.

# Structure

### Brief Summary

#### ui-elements:
Contains all the common, re-usable ui elements. These files are later 'included/required'(imported) as and when required.

#### customer/supplier/product:
+ *add-customer/supplier/product*-> Lets the user to add new customer/supplier/product.
+ *edit-customer/supplier/product*-> It allows the user to edit the details of the existing customer/supplier/product.

#### assets:

+ js Contains core javascript for the website(in the file scripts.js)
+ dist Contains the template's css & js distributions.
+ css Contains custom css styles that override certain template's distributed CSS properties.

#### Classes:

Contains the backend 'functionality' code for the website. Classes are written for all relations in the database. Every class has utility methods for communicating with its specific(& if required any other) relations in the database. Additional classes can be added as per usecase.

#### manage-ajax.php:

The HTTP request sent from the 'assets/js/scripts.js' file shall be handled here. The request is served by methods which belong to one of the classes in the 'classes' folder. The response from the methods is returned to the 'assets/js/scripts.js' file and that response is handled there itself.
