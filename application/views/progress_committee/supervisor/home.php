<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('common/header');
$this->load->view('common/navbar');
?>

<div class="col-md-9 col-sm-8 col-xs-12">
    <h4>Upcoming Meetings (as a supervisor)</h4>
    <hr>
    <table class="table table-hover" cellspacing="0" width="100%" >
        <thead>
        <tr>
            <th>Student</th>
            <th>Supervisor</th>
            <th>Co-supervisor</th>
            <th>Meeting Date</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($all_committee); ++$i) { ?>
        <tr>
            <td><?php echo $all_committee[$i]->for_student;?></td>
            <td><?php echo $all_committee[$i]->supervisor;?></td>
            <td><?php echo $all_committee[$i]->co_supervisor;?></td>
            <td><?php echo $all_committee[$i]->meeting_date_time;?></td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
    <hr>
    <br>
    <h4>Upcoming Meetings (as a co-supervisor)</h4>
    <hr>
    <table class="table table-hover" cellspacing="0" width="100%" >
        <thead>
        <tr>
            <th>Student</th>
            <th>Supervisor</th>
            <th>Co-supervisor</th>
            <th>Meeting Date</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($co_supervisor_committee); ++$i) { ?>
            <tr>
                <td><?php echo $co_supervisor_committee[$i]->for_student;?></td>
                <td><?php echo $co_supervisor_committee[$i]->supervisor;?></td>
                <td><?php echo $co_supervisor_committee[$i]->co_supervisor;?></td>
                <td><?php echo $co_supervisor_committee[$i]->meeting_date_time;?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <br>
    <h4>Upcoming Meetings (as a member)</h4>
    <hr>
    <table class="table table-hover" cellspacing="0" width="100%" >
        <thead>
        <tr>
            <th>Student</th>
            <th>Supervisor</th>
            <th>Co-supervisor</th>
            <th>Meeting Date</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($member_committee); ++$i) { ?>
            <tr>
                <td><?php echo $member_committee[$i]->for_student;?></td>
                <td><?php echo $member_committee[$i]->supervisor;?></td>
                <td><?php echo $member_committee[$i]->co_supervisor;?></td>
                <td><?php echo $member_committee[$i]->meeting_date_time;?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<?php
$this->load->view('common/footer');
?>