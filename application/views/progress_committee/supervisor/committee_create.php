<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('common/header');
$this->load->view('common/navbar');
$k=1;
?>

<div class="col-md-9 col-sm-8 col-xs-12">
    <h3>Create New Progress Committee</h3>
    <hr>
    <div class="col-md-6 absolute"> <!--Out of form-->
        <label class="control-label">All Doctored Faculty:</label>
        <div class="droptarget" ondrop="drop(event)" ondragover="allowDrop(event)">
            <?php for ($i = 0; $i < count($doctorList); ++$i) { ?>
                <p ondragstart="dragStart(event)" draggable="true" id="member<?php echo $k;?>"><?php echo $doctorList[$i]->fac_name;?>
                    <input type="hidden" name="member<?php echo $k;?>" value="<?php echo $doctorList[$i]->fac_login;?>">
                </p>
                <?php $k++;} ?>
        </div>
        <i class="glyphicon glyphicon-resize-horizontal left-absolute"></i>
    </div>
    <?php if (isset($success_msg)) { echo $success_msg; } ?>
    <form role="form" id="committee_form" action="<?=base_url();?>progress_committee/committee/save" method="post">

        <!--<div class="row">
            <div class="form-group col-md-12 required">
                <label class="control-label">Committee Name:</label>
                <input type="text" name="committee_name" maxlength="255" class="form-control" placeholder="Give committee name" required>
            </div>
        </div>
-->
        <div class="row">
            <div class="form-group col-md-6 required">
                <label class="control-label">For Student:</label>
                <?php
                $students = array('' => 'Select one student') + $students;
                echo form_dropdown('for_student', $students, '', 'class="form-control custom-text" required');
                ?>
            </div>
            <div class="form-group col-md-6 required">
                <label class="control-label">Supervisor:</label>
                <?php
                $doctors = array('' => 'Select one supervisor') + $doctors;
                echo form_dropdown('supervisor', $doctors, '', 'class="form-control custom-text" required');
                ?>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6 required">
                <label class="control-label">Co-supervisor:</label>
                <?php
                $doctors = array('' => 'Select one co-supervisor') + $doctors;
                echo form_dropdown('co_supervisor', $doctors, '', 'class="form-control custom-text" required');
                ?>
            </div>
            <div class="form-group col-md-6 required">
                <label class="control-label">Ex-officio:</label>
                <input type="text" name="ex_officio" maxlength="255" class="form-control" placeholder="" value="headcse" required readonly>
            </div>
        </div>
        <div class="row relative">
            <div class="col-md-6 pull-right">
                <label class="control-label">Members of this Committee:</label>
                <div id="members" class="droptarget" ondrop="drop(event)" ondragover="allowDrop(event)"> </div>
                <div id="msg_error"></div>
            </div>
        </div>
        <hr>
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
<script type="text/javascript">
    /* Event fired on the drag target */
    function dragStart(event) {
        event.dataTransfer.setData("Text", event.target.id);
    }
    /* Events fired on the drop target */
    function allowDrop(event) {
        event.preventDefault();
    }
    function drop(event) {
        event.preventDefault();
        var data = event.dataTransfer.getData("Text");
        event.target.appendChild(document.getElementById(data));
    }
    $('#committee_form').submit(function () {
        var v=$.trim($('#members').html()).length;
        if(v < 1)
        {
            document.getElementById('msg_error').innerHTML='<div class="alert alert-danger text-center">Please drop(select) at least one member! <strong><a class="close" title="close" aria-label="close" data-dismiss="alert" href="#">  &times;</a> </strong></div>';
            return false;
        }
        else
        {
            return true;
        }
    });
</script>
