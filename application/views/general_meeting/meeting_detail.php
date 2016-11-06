<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('common/header');
$this->load->view('common/navbar');
?>

<div class="col-md-9 col-sm-8 col-xs-12">
    <h3>
        Meeting Detail
    </h3>
    <hr>
    <p><b>Meeting Title:</b> <?php echo $meeting[0]->title_type;?></p>
    <p><b>Meeting Date:</b> <?php echo date("Y-m-d", strtotime($meeting[0]->date));?></p>
    <p><b>Resolution no:</b> <?php echo $meeting[0]->resolution_no;?></p>
    <p><b>Tags:</b> <?php echo $meeting[0]->tag_title;?></p>
    <p><b>Submitted by:</b> <?php echo $meeting[0]->submitted_by;?></p>
    <p><b>Resolution:</b> <?php echo $meeting[0]->resolution;?></p>

</div>
<?php
$this->load->view('common/footer');
?><b>