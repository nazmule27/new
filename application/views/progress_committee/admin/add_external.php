<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('common/header');
$this->load->view('common/navbar');
?>

<div class="col-md-9 col-sm-8 col-xs-12">
    <h3>Add New External</h3>
    <hr>
    <?php if (isset($success_msg)) { echo $success_msg; } ?>
    <form role="form" id="committee_form" action="<?=base_url();?>progress_committee/committee/add_external" method="post">
        <div class="row">
            <div class="form-group col-md-6 required">
                <label class="control-label">Desired User Name:</label>
                <input type="text" name="username" maxlength="255" class="form-control" placeholder="" required>
            </div>
            <div class="form-group col-md-6 required">
                <label class="control-label">External Full Name:</label>
                <input type="text" name="full_name" maxlength="255" class="form-control" placeholder="" required>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6 required">
                <label class="control-label">Designation:</label>
                <select name="designation" class="form-control" required>
                    <option value="">Select One</option>
                    <option value="Professor">Professor</option>
                    <option value="Professor">Associate Professor</option>
                    <option value="Professor">Assistant Professor</option>
                </select>
            </div>
            <div class="form-group col-md-6 required">
                <label class="control-label">External Email:</label>
                <input type="email" name="email" maxlength="255" class="form-control" placeholder="" required>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label class="control-label">Phone No:</label>
                <input type="text" name="phone" maxlength="15" class="form-control" placeholder="">
            </div>
            <div class="form-group col-md-6 required">
                <label class="control-label">Origin Type:</label>
                <select name="type" class="form-control" required>
                    <option value="">Select One</option>
                    <option value="Local">Local</option>
                    <option value="Foreign">Foreign</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </div>
    </form>
</div>

<?php
$this->load->view('common/footer');
?>
