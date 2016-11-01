<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('common/header');
$this->load->view('common/navbar');
?>

<div class="col-md-9 col-sm-8 col-xs-12">
    <h3>All Committee List</h3>
    <hr>
    <table id="committee_list" class="display " cellspacing="0" width="100%" >
        <thead>
        <tr>
            <th>Student</th>
            <th>Supervisor</th>
            <th>Co-supervisor</th>
            <!--<th>Members</th>-->
            <th width="50">Details</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($all_committee); ++$i) { ?>
        <tr>
            <td><?php echo $all_committee[$i]->for_student;?></td>
            <td><?php echo $all_committee[$i]->supervisor;?></td>
            <td><?php echo $all_committee[$i]->co_supervisor;?></td>
            <!--<td><?php /*echo $all_committee[$i]->members;*/?></td>-->
            <td><a href="<?=base_url();?>progress_committee/committee/committee_detail/<?php echo $all_committee[$i]->id;?>">Details</a> </td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<?php
$this->load->view('common/footer');
?>
<script type="text/javascript">
    $('#committee_list').dataTable( {
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "pagingType": "full_numbers",
    });
</script>