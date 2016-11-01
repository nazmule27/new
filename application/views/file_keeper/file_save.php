<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('common/header');
$this->load->view('common/navbar');
?>

<div class="col-md-9 col-sm-8 col-xs-12">
    <h3>File Save</h3>
    <hr>
    <form method="post" id="document-form" role="form" action="<?=base_url();?>file_keeper/File_keeper_home/save_file" enctype="multipart/form-data">
        <div class="row">
            <div class="form-group col-md-6 required">
                <label class="control-label">File Type:</label>
                <a target="_blank" class="pull-right" href="<?=base_url();?>file_keeper/File_keeper_home/add_type">Add Type</a>
                <?php
                $file_type = array('' => 'Select one File Type') + $file_type;
                echo form_dropdown('file_type', $file_type, '', 'class="form-control custom-text" id="file_type" onchange="makeSerial()" required');
                ?>
            </div>
            <div class="form-group col-md-6 required">
                <label class="control-label">File Destination:</label>
                <a target="_blank" class="pull-right" href="<?=base_url();?>file_keeper/File_keeper_home/add_destination">Add Destination</a>
                <?php
                $destination = array('' => 'Select one File Destination') + $destination;
                echo form_dropdown('file_destination', $destination, '', 'class="form-control custom-text" id="file_destination" onchange="makeSerial()" required');
                ?>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6 required">
                <label class="control-label">File Serial:</label>
                <input type="text" id="file_serial" name="file_serial" class="form-control" readonly>
            </div>
            <div class="form-group col-md-6">
                <label class="control-label">Reference No:</label>
                <input type="text" name="reference_no" maxlength="100" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-10">
                <label class="control-label">Browse file (pdf, doc, docx, jpg):</label>
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
    function makeSerial() {
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: '<?=base_url()?>'+"file_keeper/File_keeper_home/get_serial",
            data: {type: $("#file_type").val()},
            success:
                function(data){
                    var e_file_type = document.getElementById("file_type");
                    var file_type = e_file_type.options[e_file_type.selectedIndex].value;
                    var e_file_destination = document.getElementById("file_destination");
                    var file_destination = e_file_destination.options[e_file_destination.selectedIndex].value;
                    var this_year= new Date().getFullYear();
                    var file_base=file_type+'/'+file_destination+'/'+this_year+'/';
                    if ($.trim(data)){
                        $("#file_serial").val('');
                        $("#file_serial").val(file_base+(data[0].next_number));
                    }
                    else {
                        $("#file_serial").val('');
                        $("#file_serial").val(file_base+1);
                    }
                }
        });
    }
</script>
