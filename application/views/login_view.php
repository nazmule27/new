<?php
$this->load->view('common/header');

?>
<div class="container paddingT75">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h2 class="text-center login-title">Sign in</h2>
            <br>
            <div class="account-wall">
                <div class="col-md-12 login_error"><?php echo $this->session->flashdata('login_fail'); ?></div>
                <form method="post" action="<?=base_url();?>login">
                    <div class="form-group col-md-12">
                        <input type="text" name="username" id="username" class="form-control custom-text" placeholder="Your username*" required>
                    </div>
                    <div class="form-group col-md-12">
                        <input type="password" name="password" id="password" class="form-control custom-text" placeholder="Your password *" required>
                    </div>
                    <div class="form-group col-md-12">
                        <input type="submit" class="btn btn-default col-md-12 custom-text" value="Login">
                    </div>

                </form>
            </div>
            <div class="sign-bottom"></div>
        </div>
    </div>
</div>
<!-- /sign_in -->

<?php
$this->load->view('common/footer');
?>
