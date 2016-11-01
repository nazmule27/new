<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('common/header');
$this->load->view('common/navbar');
?>

<div class="col-md-9 col-sm-8 col-xs-12">
    <h3>All External List</h3>
    <hr>
    <table id="external_list" class="display " cellspacing="0" width="100%" >
        <thead>
        <tr>
            <th>Name</th>
            <th>Designation</th>
            <th>Email</th>
            <th>Region Type</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($all_external); ++$i) { ?>
        <tr>
            <td><?php echo $all_external[$i]->full_name;?></td>
            <td><?php echo $all_external[$i]->designation;?></td>
            <td><?php echo $all_external[$i]->email;?></td>
            <td><?php echo $all_external[$i]->type;?></td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<?php
$this->load->view('common/footer');
?>
<script type="text/javascript">
    $('#external_list').dataTable( {
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "pagingType": "full_numbers",
    });
</script>