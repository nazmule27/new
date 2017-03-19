<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('common/header');
$this->load->view('common/navbar');
?>

<div class="col-md-9 col-sm-8 col-xs-12">
    <h3>File Upload</h3>
    <hr>
    <a class="pull-right" href="<?=base_url();?>assets/docs/phd_applicant/SoPFormat.docx">Format of statement of purpose (SOP)</a><br><br>
    <p>Please upload your curriculum vitae, recommendation letter, and statement of purpose (SOP) in support of application for admission in Ph.D. program in the Department of CSE, BUET. Please note that these documents will be considered while making the list of provisionally selected Ph.D. applicants</p>
    <hr>
    <form method="post" id="document-form" role="form" action="<?=base_url();?>phd_applicant/Phd_applicant_home/save_file" enctype="multipart/form-data">
        <div class="row">
            <div class="form-group col-md-6 required">
                <label class="control-label">File Type:</label>
                <?php
                $file_type = array('' => 'Select File Type') + $file_type;
                echo form_dropdown('file_type', $file_type, '', 'class="form-control custom-text" id="file_type" onchange="makeSerial()" required');
                ?>
            </div>
            <div class="form-group col-md-6 required">
                <label class="control-label">Browse file (pdf, doc, docx):</label>
                <input type="file" name="scan_doc" id="scan_doc" required>
                <span class="text-danger"><?php if (isset($error)) { echo $error; } ?></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <br>
                <button type="submit" class="btn btn-primary custom-text">Submit</button>
            </div>
        </div>
    </form>
    <?php if (isset($success_msg)) { echo $success_msg; } ?>
</div>
<?php
$this->load->view('common/footer');
?>
