<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('common/header');
$this->load->view('common/navbar');
?>

<div class="col-md-9 col-sm-8 col-xs-12">
    <h3>Add Meeting Tag</h3>
    <hr>
    <form method="post" role="form" action="<?=base_url();?>general_meeting/General_meeting_home/save_tag">
        <div class="row">
            <div class="form-group col-md-8 required">
                <label class="control-label">Meeting Tag (Only alphanumeric and _ (underscore) allowed):</label>
                <input type="text" name="tag" maxlength="50" class="form-control" pattern="^[a-zA-Z_0-9]+" required>
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