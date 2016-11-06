<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('common/header');
$this->load->view('common/navbar');
?>

<div class="col-md-9 col-sm-8 col-xs-12">
    <h3>Meeting Resolution Save</h3>
    <hr>
    <form method="post" role="form" action="<?=base_url();?>general_meeting/General_meeting_home/save_meeting" enctype="multipart/form-data">

        <div class="row">
            <div class="form-group col-md-6 required">
                <label class="control-label">Meeting No:</label>
                <input type="text" name="meeting_no" class="form-control" placeholder="Give meeting no" required>
            </div>
            <div class="form-group col-md-6 required">
                <label class="control-label">Meeting Title:</label>
                <a target="_blank" class="pull-right" href="<?=base_url();?>general_meeting/General_meeting_home/add_meeting_type">Add Meeting Type</a>
                <?php
                $meeting_type = array('' => 'Select Meeting') + $meeting_type;
                echo form_dropdown('title', $meeting_type, '', 'class="form-control custom-text" required');
                ?>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <div class="row">
                    <div class="form-group col-md-12 required">
                        <label class="control-label">Meeting Date:</label>
                        <input type="text" id="datePicker" name="date" class="form-control" placeholder="Give meeting date" required>
                    </div>
                    <div class="form-group col-md-12 required">
                        <label class="control-label">Meeting Resolution No:</label>
                        <input type="text" name="resolution_no" class="form-control" placeholder="Give meeting resolution no" required>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-6 required">
                <label class="control-label">Meeting Tag:</label>
                <a target="_blank" class="pull-right" href="<?=base_url();?>general_meeting/General_meeting_home/add_tag">Add Tag</a>
                <?php
                /*$tag = array('' => 'Select tag') + $tag;
                echo form_dropdown('tag', $tag, '', 'class="form-control custom-text" id="tag" required');*/
                echo form_multiselect('tag[]', $tag, '', 'class="form-control custom-text" required');
                ?>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12 required">
                <label class="control-label">Meeting Resolution:</label>
                <textarea name="resolution" class="form-control" placeholder="Give meeting resolution" required></textarea>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
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
