<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('common/header');
$this->load->view('common/navbar');
?>

<div class="col-md-9 col-sm-8 col-xs-12">
    <h3>Call Meeting</h3>
    <hr>
    <form method="post" role="form" action="<?=base_url();?>progress_committee/supervisor/meeting_call_save?cid=<?php echo $committee[0]->id;?>" enctype="multipart/form-data">
        <div class="row">
            <div class="form-group col-md-6 required">
                <label class="control-label">For Student:</label>
                <input type="text" name="for_student" class="form-control custom-text" value="<?php echo $committee[0]->for_student; ?>" required readonly>
            </div>
            <div class="form-group col-md-6 required">
                <label class="control-label">Meeting Type:</label>
                <?php
                $meeting_type = array('' => 'Select one') + $meeting_type;
                echo form_dropdown('meeting_type', $meeting_type, '', 'class="form-control custom-text" id="meeting_type" required');
                ?>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12 required">
                <label class="control-label">Meeting Title:</label>
                <input type="text" name="title" class="form-control custom-text" required>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-9">
                <label class="control-label">Comments:</label>
                <textarea class="form-control custom-text" name="comment" id="comment"></textarea>
                <div id="check"></div>
            </div>
            <div class="form-group col-md-3">
                <p>&nbsp;</p>
                <input type="checkbox" id="student_can_see" name="student_can_see" value="1">
                <label class="control-label">Student can see?</label>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6 required">
                <label class="control-label">Meeting Date:</label>
                <input id="meeting_date_time" name="meeting_date_time" type="text" class="form-control custom-text" required>
            </div>
            <div class="form-group col-md-6">
                <label class="control-label">Meeting Documents(doc, docx, ppt, pptx, pdf, jpg):</label>
                <input type="file" name="meeting_doc" id="meeting_doc">
                <span class="text-danger"><?php if (isset($error)) { echo $error; } ?></span>
            </div>
        </div>
        <div class="row" id="external" style="display: none">
            <div class="form-group col-md-6 required">
                <label class="control-label">External:</label>
                <?php
                $external = array('' => 'Select one') + $external;
                echo form_dropdown('external', $external, '', 'class="form-control custom-text" id="external_drop"');
                ?>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <button type="submit" class="btn btn-primary custom-text">Submit</button>
            </div>
        </div>
    </form>
    <?php if (isset($success_msg)) { echo $success_msg; } ?>
</div>
<?php
$this->load->view('common/footer');
?>
<script type="text/javascript">
    $('#meeting_date_time').datetimepicker({
        format:'Y-m-d H:i:s',
        timepicker:true,
        datepicker:true,
        dayOfWeekStart : 6,
        lang:'en',
        minDate: new Date(),
        step:15,
        closeOnTimeSelect:true,
        value:new Date().toJSON().slice(0, 10)+' 14:30:00',
    });
    $('select[name=meeting_type]').change(function () {
        if ($(this).val() == 'defense') {
            $('#external').show();
            $('#external_drop').attr("required","''");
        } else {
            $('#external').hide();
            $('#external_drop').removeAttr("required");
        }
    });
</script>
