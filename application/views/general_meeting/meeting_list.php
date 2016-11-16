<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('common/header');
$this->load->view('common/navbar');
?>

<div class="col-md-9 col-sm-8 col-xs-12">
    <h3>
        All Meeting Resolution List
        <a class="btn btn-primary pull-right" href="<?=base_url();?>general_meeting/General_meeting_home/add_meeting_resolution"><i class="glyphicon glyphicon-plus-sign"></i> Add Meeting Resolution</a>
    </h3>
    <hr>
    <table id="meeting_list" class="display " cellspacing="0" width="100%" >
        <thead>
        <tr>
            <th>Meeting No</th>
            <th>Resolution no</th>
            <th>Meeting Title</th>
            <th>Meeting Date</th>
            <th width="400">Resolution</th>
            <th width="200">Tag Title</th>
            <th>Submitted by</th>
            <th>Action</th>
            <th>Details</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>Meeting No</th>
            <th>Resolution no</th>
            <th>Meeting Title</th>
            <th>Meeting Date</th>
            <th width="400">Resolution</th>
            <th width="200">Tag Title</th>
            <th>Submitted by</th>
            <th>Action</th>
            <th>Details</th>
        </tr>
        </tfoot>
        <tbody>
        <?php
        for ($i = 0; $i < count($meetings); ++$i) { ?>
        <tr>
            <td><?php echo $meetings[$i]->meeting_no;?></td>
            <td><?php echo $meetings[$i]->resolution_no;?></td>
            <td><?php echo $meetings[$i]->title_type;?></td>
            <td><?php echo date("Y-m-d", strtotime($meetings[$i]->date)); ?></td>
            <td><?php
                if(strlen($meetings[$i]->resolution)>55){
                    echo substr(($meetings[$i]->resolution),0, 55).' ...';
                }
                else {
                    echo substr(($meetings[$i]->resolution),0, 55);
                }

                ?>
            </td>
            <td><?php echo $meetings[$i]->tag_title;?></td>
            <td><?php echo $meetings[$i]->submitted_by;?></td>
            <td>
                <a class="btn btn-danger btn-sm" href="<?=base_url();?>general_meeting/General_meeting_home/meeting_delete/<?php echo $meetings[$i]->id;?>" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
            </td>
            <td>
                <a class="btn btn-info btn-sm" href="<?=base_url();?>general_meeting/General_meeting_home/meeting_detail/<?php echo $meetings[$i]->id;?>">Details</a>
            </td>
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
        "order": [[ 3, "desc" ]],
        initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );

                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );

                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    });
</script>