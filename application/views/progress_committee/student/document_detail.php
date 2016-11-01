<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('common/header');
$this->load->view('common/navbar');
?>

<div class="col-md-9 col-sm-8 col-xs-12">
    <h3>Document Details</h3>
    <hr>
    <p>
        <b>Student: </b><?php echo $committee[0]->for_student; ?>
    </p>
    <p><b>Supervisor: </b><?php echo $committee[0]->supervisor; ?></p>
    <p><b>Co-supervisor: </b><?php echo $committee[0]->co_supervisor; ?></p>
    <p><b>Meeting Type: </b><?php echo $committee[0]->type; ?></p>
    <hr>
    <h4>Activities of this meeting</h4>
    <hr>
    <table id="document_list" class="display " cellspacing="0" width="100%" >
        <thead>
        <tr>
            <th>Document Type</th>
            <th>Comment</th>
            <th>Uploaded By</th>
            <th>Uploaded Date Time</th>
            <th>Download</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($document); ++$i) { ?>
            <tr>
                <td><?php echo $document[$i]->document_type;?></td>
                <td><?php echo $document[$i]->comment;?></td>
                <td><?php echo $document[$i]->uploaded_by;?></td>
                <td><?php echo $document[$i]->created_at;?></td>
                <td><a class="btn btn-info btn-sm <?php if(!isset($document[$i]->file_name)) echo 'dis-none';?>" href="<?=base_url();?>assets/docs/progress_committee/<?php echo $document[$i]->file_name;?>"><i class="glyphicon glyphicon-download"></i> Download</a> </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<?php
$this->load->view('common/footer');
?>
<script type="text/javascript">
    $('#document_list').dataTable( {
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "pagingType": "full_numbers",
    });
</script>
