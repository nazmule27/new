<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('common/header');
$this->load->view('common/navbar');
?>

<div class="col-md-9 col-sm-8 col-xs-12">
    <h3>Committee Details</h3>
    <hr>
    <p>
        <b>Student: </b><?php echo $committee[0]->for_student; ?>
        <a target="_blank" class="btn btn-default pull-right" href="<?=base_url();?>progress_committee/committee/committee_print/<?php echo $committee[0]->id; ?>"><i class="glyphicon glyphicon-print"></i> Print</a>
    </p>
    <p><b>Supervisor: </b><?php echo $committee[0]->supervisor; ?></p>
    <p><b>Co-supervisor: </b><?php echo $committee[0]->co_supervisor; ?></p>
    <b>Members: </b>
    <?php for ($i = 0; $i < count($committees); ++$i) { ?>
        <p class="padding-left-75"><?php echo ($i+1).'. '.$committees[$i]->member; ?></p>
    <?php } ?>
    <hr>
    <table id="meeting_list" class="display " cellspacing="0" width="100%" >
        <thead>
        <tr>
            <th>Meeting Type</th>
            <th>Date Time</th>
            <th>Upload Document</th>
            <th>Details</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($meetings); ++$i) { ?>
            <tr>
                <td><?php echo $meetings[$i]->type;?></td>
                <td><?php echo $meetings[$i]->meeting_date_time;?></td>
                <td><a class="btn btn-info" href="<?=base_url();?>progress_committee/supervisor/document_upload/<?php echo $meetings[$i]->id;?>">Document upload</a> </td>
                <td><a class="btn btn-info" href="<?=base_url();?>progress_committee/supervisor/document_detail/<?php echo $meetings[$i]->id;?>">Details</a> </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

</div>

<?php
$this->load->view('common/footer');
?>
<script type="text/javascript">
    $('#meeting_list').dataTable( {
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "pagingType": "full_numbers",
    });
</script>
