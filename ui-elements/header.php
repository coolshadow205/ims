<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    
    <title>
      <?php echo $title; ?>
    </title>
    
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    
    <!-- Google Icons CSS -->
    <link rel="stylesheet" type="text/css" href="http://localhost/ims/assets/vendors/material-font-icons/material-font-icons.css">
    
    <!-- Font-Awesome CSS -->
    <link rel="stylesheet" href="http://localhost/ims/assets/vendors/font-awesome/css/font-awesome.min.css">

    <!-- Sweer Alert 2 CSS -->
    <link rel="stylesheet" type="text/css" href="http://localhost/ims/assets/vendors/sweet-alert/css/sweetalert2.min.css">
    <!-- CSS Files -->
    <link href="http://localhost/ims/assets/css/material-dashboard.css" rel="stylesheet" />

    <?php if($title === "Invoice") { ?>
        <link rel="stylesheet" type="text/css" href="assets/css/invoice.css">
    <?php }//end of if ?>
</head>