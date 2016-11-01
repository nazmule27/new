<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('common/header');
$this->load->view('common/navbar');
?>

<div class="col-md-9 col-sm-8 col-xs-12">
    <h3>Document Upload / Comment</h3>
    <hr>
    <form method="post" id="document-form" role="form" action="<?=base_url();?>progress_committee/supervisor/document_upload_save?cid=<?php echo $committee[0]->id;?>&mid=<?php echo $meeting[0]->id;?>" enctype="multipart/form-data">
        <div class="row">
            <div class="form-group col-md-6 required">
                <label class="control-label">For Student:</label>
                <input type="text" name="for_student" class="form-control custom-text" value="<?php echo $committee[0]->for_student; ?>" required readonly>
            </div>
            <div class="form-group col-md-6 required">
                <label class="control-label">Supervisor:</label>
                <input type="text" name="supervisor" class="form-control custom-text" value="<?php echo $committee[0]->supervisor;?>" required readonly>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6 required">
                <label class="control-label">Meeting Date Time:</label>
                <input type="text" name="meeting_date" class="form-control custom-text" value="<?php echo $meeting[0]->meeting_date_time; ?>" required readonly>
            </div>
            <div class="form-group col-md-6 required">
                <label class="control-label">Meeting Type:</label>
                <input type="text" name="meeting_type" class="form-control custom-text" value="<?php echo $meeting[0]->type; ?>" required readonly>
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
                <label class="control-label">Document Type:</label>
                <select name="document_type" class="form-control custom-text">
                    <option value="pre_meeting_document">Pre meeting document</option>
                    <option value="post_meeting_document">Post meeting document</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label class="control-label">Meeting Documents(doc, docx, ppt, pptx, pdf, jpg):</label>
                <input type="file" name="meeting_doc" id="meeting_doc">
                <span class="text-danger"><?php if (isset($error)) { echo $error; } ?></span>
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

    document.getElementById('document-form').onsubmit=function() {
        var comment = $("#comment").val();
        var meeting_doc = $("#meeting_doc").val();
        if(comment==''&&meeting_doc==''){
            $("#check").html("Please comment or browse/upload a document or both.");
            return false;
        }
        else{
            $("#check").html("");
            return true
        }
    }
</script>