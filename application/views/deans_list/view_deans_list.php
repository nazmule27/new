<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('common/header');
$this->load->view('common/navbar');
?>

<div class="col-md-9 col-sm-8 col-xs-12">
    <h3>
        Deans List
        <a class="btn btn-primary pull-right" href="<?=base_url();?>deans_list/Deans_list_home/deans_list_pdf"><i class="glyphicon glyphicon-download"></i> PDF </a>
    </h3>
    <hr>
    <table id="deans_list" class="display " cellspacing="0" width="100%" >
        <thead>
        <tr>
            <th>Student ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Session</th>
            <th>Level</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($deans_list); ++$i) { ?>
        <tr>
            <td><?php echo $deans_list[$i]->student_id;?></td>
            <td><?php echo $deans_list[$i]->first_name;?></td>
            <td><?php echo $deans_list[$i]->last_name;?></td>
            <td><?php echo $deans_list[$i]->session;?></td>
            <td><?php echo $deans_list[$i]->level;?></td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<?php
$this->load->view('common/footer');
?>
<script type="text/javascript">
    $('#deans_list').dataTable( {
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "pagingType": "full_numbers",
        "order": [[ 0, "asc" ]],
    });
</script>