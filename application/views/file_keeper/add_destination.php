<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('common/header');
$this->load->view('common/navbar');
?>

<div class="col-md-9 col-sm-8 col-xs-12">
    <h3>Add File Destination</h3>
    <hr>
    <form method="post" id="document-form" role="form" action="<?=base_url();?>file_keeper/File_keeper_home/save_destination">
        <div class="row">
            <div class="form-group col-md-8 required">
                <label class="control-label">File Destination (Only alphanumeric and _ (underscore) allowed):</label>
                <input type="text" name="destination_name" maxlength="50" class="form-control" pattern="^[a-zA-Z_0-9]+" required>
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