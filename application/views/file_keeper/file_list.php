<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('common/header');
$this->load->view('common/navbar');
?>

<div class="col-md-9 col-sm-8 col-xs-12">
    <h3>
        All File List
        <a class="btn btn-primary pull-right" href="<?=base_url();?>file_keeper/File_keeper_home/add_file"><i class="glyphicon glyphicon-plus-sign"></i> Add New File</a>
    </h3>
    <hr>
    <table id="file_list" class="display " cellspacing="0" width="100%" >
        <thead>
        <tr>
            <th>Track no</th>
            <th>Reference no</th>
            <th>Destination</th>
            <th>Created at</th>
            <th>Download</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($files); ++$i) { ?>
        <tr>
            <td><?php echo $files[$i]->track_no;?></td>
            <td><?php echo $files[$i]->reference_no;?></td>
            <td><?php echo $files[$i]->destination;?></td>
            <td><?php echo $files[$i]->created_at;?></td>
            <td><a class="btn btn-info btn-sm <?php if(!isset($files[$i]->file_name)) echo 'dis-none';?>" href="<?=base_url();?>assets/docs/file_keeper/<?php echo $files[$i]->file_name;?>"><i class="glyphicon glyphicon-download"></i> Download</a> </td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<?php
$this->load->view('common/footer');
?>
<script type="text/javascript">
    $('#file_list').dataTable( {
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "pagingType": "full_numbers",
        "order": [[ 3, "desc" ]],
    });
</script>