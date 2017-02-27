<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('common/header');
$CI = &get_instance();
$role = $CI->session->userdata('role');
$username = $CI->session->userdata('username');
?>

<div class="col-md-12 col-sm-12 col-xs-12">
    <h3>Thesis Upload</h3>
    <hr>
    <form method="post" id="document-form" role="form" action="<?=base_url();?>student/Add_thesis/save_thesis" enctype="multipart/form-data">
        <div class="row">
            <div class="form-group col-md-6 required">
                <label class="control-label">Thesis Title:</label>
                <input type="text" name="thesis_title" class="form-control" placeholder="Give thesis title">
            </div>
            <div class="form-group col-md-3 required">
                <label class="control-label">Supervisor:</label>
                <?php
                $faculty = array('' => 'Select your advisor') + $faculty;
                echo form_dropdown('thesis_advisor', $faculty, '', 'class="form-control custom-text" required');
                ?>
            </div>
            <div class="form-group col-md-3 required">
                <label class="control-label">Thesis Date:</label>
                <input type="text" id="thesis_date" name="thesis_date" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12 required">
                <label class="control-label">Thesis Abstract:</label>
                <textarea name="abstract" class="form-control" required></textarea>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4 required">
                <label class="control-label">Thesis Abstract:</label>
                <input type="text" id="submitted_by" name="submitted_by" class="form-control" value="<?php echo $username;?>" readonly>
            </div>
            <div class="form-group col-md-4">
                <label class="control-label">Thesis Partner1:</label>
                <input type="text" name="partner1" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <label class="control-label">Thesis Partner2:</label>
                <input type="text" name="partner2" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-10 required">
                <label class="control-label">Browse thesis file (pdf, doc, docx):</label>
                <input type="file" name="scan_doc" id="scan_doc">
                <span class="text-danger"><?php if (isset($error)) { echo $error; } ?></span>
            </div>
            <div class="form-group col-md-2">
                <br>
                <button type="submit" class="btn btn-primary pull-right custom-text">Submit</button>
            </div>
        </div>
    </form>
    <?php if (isset($success_msg)) { echo $success_msg; } ?>
</div>
<?php
$this->load->view('common/footer');
?>
<script type="text/javascript">
    $('#thesis_date').datetimepicker({
        format:'Y-m-d',
        timepicker:false,
        dayOfWeekStart : 6,
        lang:'en',
        maxDate: new Date(),
        step:10,
        closeOnDateSelect:true,
        value:new Date().toJSON().slice(0, 10), //+' '+new Date().toJSON().slice(11, 19),
    });
</script>

