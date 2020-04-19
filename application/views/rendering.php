<!-- Page content -->
<div class="page-content bg-white">
    <!-- Main content -->
    <div class="content-wrapper">
        <!-- Page header -->
        <div class="page-header">
            <div class="page-header-content header-elements-md-inline">
                <div class="page-title d-flex">
                    <div class="img">
                        <img src="<?= base_url('assets/img/CoatofArms_Lg.png') ?>"/>
                    </div><!--./img -->

                    <div id="content">
                        <h1>The United Republic of Tanzania</h1>
                        <h3>Ministry of Health, Community Development, Gender, Elderly and Children</h3>
                    </div><!--./content -->
                </div><!--./page-title -->

                <div class="header-elements d-none">
                    <a href="<?= site_url('auth/login') ?>" class="btn btn-labeled btn-labeled-right btn-primary">Login
                        <b><i class="icon-lock"></i></b></a>
                </div><!--./header-elements -->
            </div><!--./page-header-content -->
        </div><!-- /page header -->

        <!-- Content area -->
        <div class="content">
            <!-- Basic card -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Traveller Surveillance Form</h5>
                </div><!--./card-header -->

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php
                            if ($this->session->flashdata('message') != '') {
                                echo '<div class="success_message">' . $this->session->flashdata('message') . '</div>';
                            } ?>

                            <!-- Circles which indicates the steps of the form: -->
                            <div style="text-align:center; margin-bottom: 20px;">
                                <?php
                                if (isset($form) && $form) {
                                    for ($i = 0; $i < sizeof($form['data']); $i++) {
                                        echo '<span class="step"></span>';
                                    }
                                } ?>
                            </div><!--./steps -->

                            <?php
                            echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '" id="' . $form['meta']['form_id'] . '">';
                            $this->json_schema->iterate_form($form['data']);

                            echo '<div class="row" style="overflow:auto;">
		                            <div class="col-lg-12">
		                                <div class="form-group">
		                                    <button type="button" class="btn bg-primary-2 btn-xs" id="prevBtn" onclick="nextPrev(\'' . $form['meta']['form_id'] . '\',-1)">Previous</button>
		                                    <button type="button" class="btn bg-primary-1 btn-xs" id="nextBtn" onclick="nextPrev(\'' . $form['meta']['form_id'] . '\',1)">Next</button>
		                                </div>
		                            </div>
		                          </div>';
                            echo '</form>'; ?>
                        </div><!--./col-lg-12-->
                    </div><!--./row -->
                </div><!--./card-body -->
            </div><!-- /basic card -->
        </div><!-- /content area -->

        <script type="text/javascript">
            var currentTab = 0; // Current tab is set to be the first tab (0)
            showTab(currentTab); // Display the current tab

            function showTab(n) {
                // This function will display the specified tab of the form ...
                var x = document.getElementsByClassName("tab");
                x[n].style.display = "block";
                // ... and fix the Previous/Next buttons:
                if (n === 0) {
                    document.getElementById("prevBtn").style.display = "none";
                } else {
                    document.getElementById("prevBtn").style.display = "inline";
                }
                if (n === (x.length - 1)) {
                    document.getElementById("nextBtn").innerHTML = "Submit";
                } else {
                    document.getElementById("nextBtn").innerHTML = "Next";
                }
                // ... and run a function that displays the correct step indicator:
                fixStepIndicator(n)
            }

            function nextPrev(form_id, n) {
                // This function will figure out which tab to display
                var x = document.getElementsByClassName("tab");
                // Exit the function if any field in the current tab is invalid:
                if (n === 1 && !validateForm()) return false;
                // Hide the current tab:
                x[currentTab].style.display = "none";
                // Increase or decrease the current tab by 1:
                currentTab = currentTab + n;
                // if you have reached the end of the form... :
                if (currentTab >= x.length) {
                    //...the form gets submitted:
                    document.getElementById(form_id).submit();
                    return false;
                }
                // Otherwise, display the correct tab:
                showTab(currentTab);
            }

            function validateForm() {
                // This function deals with validation of the form fields
                var x, y, i, valid = true;
                x = document.getElementsByClassName("tab");
                y = x[currentTab].getElementsByTagName("input");
                // A loop that checks every input field in the current tab:
                for (i = 0; i < y.length; i++) {
                    // If a field is empty...
                    if (y[i].value === "") {
                        // add an "invalid" class to the field:
                        y[i].className += " invalid";
                        // and set the current valid status to false:
                        valid = false;
                    }
                }
                // If the valid status is true, mark the step as finished and valid:
                if (valid) {
                    document.getElementsByClassName("step")[currentTab].className += " finish";
                }
                return valid; // return the valid status
            }

            function fixStepIndicator(n) {
                // This function removes the "active" class of all steps...
                var i, x = document.getElementsByClassName("step");
                for (i = 0; i < x.length; i++) {
                    x[i].className = x[i].className.replace(" active", "");
                }
                //... and adds the "active" class to the current step:
                x[n].className += " active";
            }

            function showPosition(id) {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function (position) {
                        var positionInfo = "Your current position is (" + "Latitude: " + position.coords.latitude + ", " + "Longitude: " + position.coords.longitude + ")";
                        document.getElementById(id).innerHTML = positionInfo;
                        document.getElementById("hidden_" + id).value = position.coords.latitude + ", " + position.coords.longitude + ", " + position.coords.accuracy;
                    });
                } else {
                    alert("Sorry, your browser does not support HTML5 geolocation.");
                }
            }
        </script>