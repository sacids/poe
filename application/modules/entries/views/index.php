<script src="<?= base_url('assets/js/add-more-countries.js') ?>"></script>
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
                        <div class="col-lg-12 text-center">
                            <div class="mt-4"></div>
                            <div class="dropdown">
                                <button style="width: 200px;" class="btn btn-outline-primary dropdown-toggle"
                                        type="button"
                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                    <?= $this->lang->line("lbl_language") ?>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item"
                                       href="<?= site_url('languageChanger/switchLang/english') ?>"><img width="32"
                                                src="<?= base_url('assets/img/usa_flag.png') ?>"/> <?= $this->lang->line("lbl_english") ?>
                                    </a>
                                    <a class="dropdown-item"
                                       href="<?= site_url('languageChanger/switchLang/swahili') ?>"><img width="32"
                                                src="<?= base_url('assets/img/tz_flag.png') ?>"/> <?= $this->lang->line("lbl_swahili") ?>
                                    </a>
                                </div>
                            </div><!--./dropdown -->
                            <div class="mt-4"></div>

                            <a style="width: 200px;" href="<?= site_url('entries/international') ?>"
                               class="btn btn-primary btn-sm"><?= $this->lang->line("lbl_international") ?></a>
                            <div class="mt-4"></div>
                            <a style="width: 200px;" href="<?= site_url('entries/local') ?>"
                               class="btn btn-secondary btn-sm"><?= $this->lang->line("lbl_local") ?></a>

                        </div><!--./col-lg-12-->
                    </div><!--./row -->
                </div><!--./card-body -->
            </div><!-- /basic card -->
        </div><!-- /content area -->