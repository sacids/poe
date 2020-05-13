<?php $this->load->view('add_more_country') ?>
<!-- Page content -->
<div class="page-content bg-white">
    <!-- Main content -->
    <div class="content-wrapper">
        <!-- Page header -->
        <div class="page-header">
            <div class="container-fluid">
                <div class="page-header-content">
                    <div class="page-title d-flex">
                        <div class="img">
                            <img src="<?= base_url('assets/img/CoatofArms_Lg.png') ?>"/>
                        </div><!--./img -->

                        <div id="content">
                            <h1><?= $this->lang->line('united_republic') ?></h1>
                            <h3 class="d-none d-md-block"><?= $this->lang->line('ministry_of_health') ?></h3>
                            <h4 class="d-block d-sm-none">MoHCDGEC</h4>
                        </div><!--./content -->
                    </div><!--./page-title -->
                </div><!--./page-header-content -->
            </div><!--./container-fluid -->
        </div><!-- /page header -->

        <!-- Content area -->
        <div class="content">
            <!-- Basic card -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title text-uppercase text-center"><?= $this->lang->line('traveller_surveillance_form') ?></h5>
                </div><!--./card-header -->

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="alert alert-success">
                                        Information registered successfully.
                                    </div>

                                    <p class="text-center">Do you want to fill another form</p>

                                    <div class="mt-2"></div>
                                    <?php if ($form_type === 'intl') { ?>
                                        <a href="<?= site_url('entries/international') ?>"
                                           class="btn btn-success btn-block">Yes</a>
                                    <?php } else { ?>
                                        <a href="<?= site_url('entries/local') ?>"
                                           class="btn btn-success btn-block">Yes</a>
                                    <?php } ?>
                                    <div class="mt-3"></div>
                                    <a href="<?= site_url('') ?>"
                                       class="btn btn-danger btn-block">No</a>

                                </div>
                            </div><!--./card -->
                        </div><!--./col-lg-12-->
                    </div><!--./row -->
                </div><!--./card-body -->
            </div><!-- /basic card -->
        </div><!-- /content area -->
