<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Ministry of Health - Point of Entries</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?= base_url('favicon.png') ?>"/>

    <!--font awesome -->
    <link href="<?= base_url('assets/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css">

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,100,500,700,900" rel="stylesheet"
          type="text/css">

    <link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
    <!-- /global stylesheets -->

    <!-- Bootstrap date picker CSS -->
    <link href="<?= base_url('assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') ?>" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/css/styles.css') ?>" rel="stylesheet">

    <!-- Core JS files -->
    <script src="https://code.jquery.com/jquery-3.5.0.min.js"
            integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
    <!-- <script src="<?= base_url('assets/js/jquery-3.3.1.slim.min.js') ?>"></script> -->
    <script src="<?= base_url('assets/js/popper.min.js') ?>"></script>

    <script src="<?= base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/custom.js') ?>"></script>
    <!-- /core JS files -->

    <!-- Bootstrap date picker JS -->
    <script src="<?= base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js') ?>"></script>
</head>

<body>
<!-- Fixed navbar -->
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= site_url('') ?>"><?= $this->lang->line("traveller_surveillance") ?></a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto d-none d-md-block">
                <li class="nav-item">
                    <a class="btn btn-secondary text-uppercase" href="<?= site_url('auth/login') ?>">Login</a>
                </li>
            </ul>
        </div><!--collapse -->
    </div><!--./container-fluid -->
</nav>
<!-- /fixed navbar -->