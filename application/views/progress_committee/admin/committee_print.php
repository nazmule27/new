
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Postgraduate Progress Committee</title>
    <link rel="icon" type="image/ico" href="<?=base_url();?>assets/img/logo.png"/>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link type="text/css" rel="stylesheet" href="<?=base_url();?>assets/css/bootstrap.min.css"/>
    <style>
        body {
            padding-top: 30px;
            padding-bottom: 20px;
        }
    </style>
    <link type="text/css" rel="stylesheet" href="<?=base_url();?>assets/css/main.css">
</head>
<body>
<div class="container">
<div class="col-md-12 col-sm-12 col-xs-12">
    <img class="width-100p" src="<?=base_url();?>assets/img/banner.jpg" alt="">
    <hr>
    <h3>
        Postgraduate Progress Committee Details
        <em class="pull-right font-size-15"> Date: <?php echo date_format( new DateTime($committee[0]->created_at), 'd-m-Y' ); ?></em>
    </h3>
    <br>
    <p>
        <b>Student: </b><?php echo $committee[0]->for_student; ?>
    </p>
    <p><b>Supervisor: </b><?php echo $committee[0]->supervisor; ?></p>
    <p><b>Co-supervisor: </b><?php echo $committee[0]->co_supervisor; ?></p>
    <b>Members: </b>
    <?php for ($i = 0; $i < count($committees); ++$i) { ?>
        <p class="padding-left-75"><?php echo ($i+1).'. '.$committees[$i]->member; ?></p>
    <?php } ?>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <p>
        ----------------------------------------------<br>
        Head<br>
        Department of Computer Science and Engineering<br>
        Bangladesh University of Engineering and Technology<br>
    </p>
</div>

</div>
<script type="text/javascript">
    window.print();
</script>
</body>
</html>
