    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="simba_login_panel">
                    
                    <div class="loginInfoMessage">
                        <?= $message; ?>
                    </div>
                    
                    <?= form_open("auth/login"); ?>

                    <div class="form-group simba_login_group">
                        <?= form_input($identity); ?>
                        <i class="fa fa-user"></i>
                    </div>

                    <div class="form-group simba_login_group">
                        <?= form_input($password); ?>
                        <i class="fa fa-lock"></i>
                    </div>

                    <!--<div class="checkbox simba_login_group">
                        <label>
                            <?= form_checkbox('remember', '1', FALSE, 'id="remember"'); ?>Remember Me
                        </label>
                    </div>-->

                    <div class="form-group simba_login_group">
                        <?= form_submit('submit', lang('login_submit_btn'), "class='btn btn-lg login_btn btn-block'"); ?>
                    </div>

                    <?= form_close(); ?>
                    <div class="pull-right simba_forgot_password">
                        <a href="forgot_password">
                            <?= lang('login_forgot_password'); ?>
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>