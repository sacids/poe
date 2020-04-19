<!-- Page content -->
<div class="page-content">

    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Content area -->
        <div class="content align-items-center justify-content-center">
            <div class="row">
                <div class="col-md-4 col-sm-3 col-xs-12 col-lg-4"></div>
                <div class="col-md-3">
                    <!-- Login form -->
                    <?= form_open('auth/login', 'class="form-horizontal"') ?>
                    <div class="card border-1 mb-0">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <i class="icon-reading icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
                                <h5 class="mb-0">Login to your account</h5>
                                <span class="d-block text-muted">Enter your credentials below</span>
                            </div>

                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <?= form_input($identity); ?>
                                <div class="form-control-feedback">
                                    <i class="icon-user text-muted"></i>
                                </div>
                                <span style="color: red !important;"><?= form_error('identity'); ?></span>
                            </div><!--./form-group -->

                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <?= form_input($password); ?>
                                <div class="form-control-feedback">
                                    <i class="icon-lock2 text-muted"></i>
                                </div>
                                <span style="color: red !important;"><?= form_error('password'); ?></span>
                            </div><!--./form-group -->

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Sign in <i
                                            class="icon-circle-right2 ml-2"></i></button>
                            </div>

                            <div class="text-center">
                                <a href="#">Forgot password?</a>
                            </div>
                        </div>
                    </div>
                    <?= form_close() ?><!-- /login form -->

                </div><!--./col-md-4 -->
            </div><!--./row -->
        </div><!-- /content area -->