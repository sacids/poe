<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Ministry of Health - Point of Entries</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?= base_url('favicon.png') ?>"/>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
          type="text/css">
    <link href="<?= base_url('') ?>global_assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url('') ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url('') ?>assets/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url('') ?>assets/css/layout.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url('') ?>assets/css/components.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url('') ?>assets/css/colors.min.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Custom styles for this template -->
    <link href="<?= base_url('assets/css/custom.css') ?>" rel="stylesheet">


    <!-- Core JS files -->
    <script src="<?= base_url('') ?>global_assets/js/main/jquery.min.js"></script>
    <script src="<?= base_url('') ?>global_assets/js/main/bootstrap.bundle.min.js"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="<?= base_url('') ?>global_assets/js/plugins/tables/datatables/datatables.min.js"></script>
    <script src="<?= base_url('') ?>global_assets/js/plugins/forms/selects/select2.min.js"></script>

    <script src="<?= base_url('') ?>assets/js/app.js"></script>
    <script src="<?= base_url('') ?>global_assets/js/demo_pages/datatables_basic.js"></script>
    <!-- /theme JS files -->


</head>

<body>

<!-- Main navbar -->
<div class="navbar navbar-expand-md" style="background-color: #088c4a;">
    <div class="navbar-brand">
        <a href="<?= site_url('dashboard') ?>" class="d-inline-block">
            <img src="<?= base_url('global_assets/images/logo_light.png') ?>" alt="">
        </a>
    </div>

    <div class="d-md-none">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
            <i class="icon-tree5"></i>
        </button>
    </div>

    <div class="collapse navbar-collapse" id="navbar-mobile">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="<?= site_url('entries/lists') ?>" class="navbar-nav-link text-white">
                    PoE Registration
                </a>
            </li>

            <li class="nav-item">
                <a href="<?= site_url('quarantines/lists')?>" class="navbar-nav-link text-white">
                    Quarantine Management
                </a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown dropdown-user">
                <a href="#" class="navbar-nav-link dropdown-toggle text-white" data-toggle="dropdown">
                    <span><?php echo get_current_user_name() ?></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <a href="#" class="dropdown-item"><i class="icon-user-plus"></i> My profile</a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item"><i class="icon-cog5"></i> Account settings</a>
                    <a href="<?= site_url('auth/logout') ?>" class="dropdown-item"><i class="icon-switch2"></i>
                        Logout</a>
                </div>
            </li>
        </ul>
    </div>
</div>
<!-- /main navbar -->