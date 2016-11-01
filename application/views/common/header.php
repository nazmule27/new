<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Department of CSE, BUET</title>
    <link rel="icon" type="image/ico" href="<?=base_url();?>assets/img/logo.png"/>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link type="text/css" rel="stylesheet" href="<?=base_url();?>assets/css/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="<?=base_url();?>assets/css/bootstrap-theme.min.css"/>
    <link type="text/css" rel="stylesheet" href="<?=base_url();?>assets/js/nav/_css/nav.css"/>
    <link type="text/css" rel="stylesheet" href="<?=base_url();?>assets/js/data_table/jquery.dataTables.css"/>
    <link type="text/css" rel="stylesheet" href="<?=base_url();?>assets/js/datetimepicker/jquery.datetimepicker.css"/>
    <link type="text/css" rel="stylesheet" href="<?=base_url();?>assets/js/treemenu/acmebase.css"/>
    <style>
        body {
            padding-top: 80px;
            padding-bottom: 20px;
        }
    </style>
    <link type="text/css" rel="stylesheet" href="<?=base_url();?>assets/css/main.css">
    <script src="<?=base_url();?>assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <!--<img class="logo" src="<?/*=base_url();*/?>assets/img/logo.png" alt="">-->
                <a class="navbar-brand" href="<?=base_url();?>">Department of CSE, BUET</a>
                <div class="banner">
                    <?php
                    $CI = &get_instance();
                    $role = $CI->session->userdata('role');
                    $full_name = $CI->session->userdata('full_name');
                    ?>
                    <?php
                    $login='<a class="pull-right" href="'.base_url("login").'">login</a>';
                    $logout='<a class="pull-right" href="'.base_url("login/logout").'">logout</a>';
                    $user='<p class="pull-right">Welcome <b>'.$full_name.'</b><br>'.$logout.'</p>';
                    if(isset($role)){
                        echo $user;
                    }
                    else
                    {
                        echo $login;
                    }
                    ?>
                </div>
            </div>
        </nav>
        <div class="container">
