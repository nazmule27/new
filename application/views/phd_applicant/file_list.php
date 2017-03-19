<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('common/header');
$this->load->view('common/navbar');
?>

<div class="col-md-9 col-sm-8 col-xs-12">
    <h3>
        Your Files List
        <a class="btn btn-primary pull-right" href="<?=base_url();?>phd_applicant/Phd_applicant_home/upload_file"><i class="glyphicon glyphicon-plus-sign"></i> Add New File</a>
    </h3>
    <hr>
    <table id="file_list" class="display " cellspacing="0" width="100%" >
        <thead>
        <tr>
            <th>SL no</th>
            <th>File Type</th>
            <th>Applicant</th>
            <th>Created at</th>
            <th>Download</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($files); ++$i) { ?>
        <tr>
            <td><?php echo $i+1;?></td>
            <td><?php echo $files[$i]->file_type;?></td>
            <td><?php echo $files[$i]->created_by;?></td>
            <td><?php echo $files[$i]->created_at;?></td>
            <td><a class="btn btn-info btn-sm <?php if(!isset($files[$i]->file_name)) echo 'dis-none';?>" href="<?=base_url();?>assets/docs/phd_applicant/<?php echo $files[$i]->file_name;?>"><i class="glyphicon glyphicon-download"></i> Download</a> </td>
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
        //"order": [[ 2, "asc" ]],
    });
</script>