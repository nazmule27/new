<?php
$CI = &get_instance();
$role = $CI->session->userdata('role');
$username = $CI->session->userdata('username');
?>
<div class="col-md-3 col-sm-4 col-xs-12">
    <div class="nav-block">
        <div id="nav-container">
            <nav>
                <ul>
                    <?php if(($role == 'Admin')){?>
                        <li>
                            <a href="<?=base_url();?>"><i class="glyphicon glyphicon-home"></i>Home</a>
                        </li>
                        <li>
                            <a href="<?=base_url();?>progress_committee/committee"><i class="glyphicon glyphicon-pencil"></i> Create Committee</a>
                        </li>
                        <li>
                            <a href="<?=base_url();?>progress_committee/committee/committee_list"><i class="glyphicon glyphicon-list"></i> Committee List</a>
                        </li>
                        <li>
                            <a href="<?=base_url();?>progress_committee/committee/external_list"><i class="glyphicon glyphicon-list"></i> External List</a>
                            <ul>
                                <li><a href="<?=base_url();?>progress_committee/committee/add"> Add External</a></li>
                            </ul>
                        </li>
                        <p>--------------------------------------------------</p>
                        <li>
                            <a href="<?=base_url();?>file_keeper/File_keeper_home"> <i class="glyphicon glyphicon-folder-open"> </i>&nbsp; File Keeper Home</a>
                        </li>
                        <p>--------------------------------------------------</p>
                        <li>
                            <a href="<?=base_url();?>general_meeting/General_meeting_home"> <i class="glyphicon glyphicon-folder-open"> </i>&nbsp; Meeting</a>
                        </li>
                    <?php } ?>
                    <?php if(($role == 'BPGSSec')||($role == 'BUGSSec')||($role == 'BRTCSec')||($role == 'DeptSec')){?>
                        <li>
                            <a href="<?=base_url();?>general_meeting/General_meeting_home"> <i class="glyphicon glyphicon-folder-open"> </i>&nbsp; Meeting</a>
                        </li>
                    <?php } ?>
                    <?php if(($role == 'Supervisor')){?>
                    <li>
                        <a href="<?=base_url();?>"><i class="glyphicon glyphicon-home"></i> Home</a>
                    </li>
                    <li>
                        <a href="<?=base_url();?>progress_committee/supervisor/home"><i class="glyphicon glyphicon-pencil"> </i> Dashboard</a>
                    </li>
                    <li>
                        <a href="<?=base_url();?>progress_committee/supervisor"><i class="glyphicon glyphicon-education"> </i> Upcoming Meeting</a>
                    </li>
                        <p>--------------------------------------------------</p>
                    <li>
                        <a href="<?=base_url();?>general_meeting/General_meeting_list"> <i class="glyphicon glyphicon-folder-open"> </i>&nbsp; Meeting</a>
                    </li>
                    <p>--------------------------------------------------</p>
                    <li>
                        <a href="<?=base_url();?>file_keeper/File_keeper_home"> <i class="glyphicon glyphicon-folder-open"> </i>&nbsp; File Keeper Home</a>
                    </li>
                    <?php } ?>
                    <?php if(($role == 'Student')){?>
                    <li>
                        <a href="<?=base_url();?>"><i class="glyphicon glyphicon-home"></i> Home</a>
                    </li>
                    <li>
                        <a href="<?=base_url();?>progress_committee/student"><i class="glyphicon glyphicon-search"></i> Dashboard</a>
                    </li>
                    <?php } ?>

                    <?php if(($role == 'Officer')){?>
                        <li>
                            <a href="<?=base_url();?>file_keeper/File_keeper_home"> <i class="glyphicon glyphicon-folder-open"> </i>&nbsp; File Keeper Home</a>
                        </li>
                    <?php } ?>
                </ul>
            </nav>
        </div>
        <!--nav end-->
    </div>
</div>
