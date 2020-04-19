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
                            <h1>The United Republic of Tanzania</h1>
                            <h3 class="d-none d-md-block">Ministry of Health, Community Development, Gender, Elderly and
                                Children</h3>
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
                    <h5 class="card-title text-uppercase">Traveller Surveillance Form</h5>
                </div><!--./card-header -->

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php
                            if ($this->session->flashdata('message') != '') {
                                echo '<div class="success_message">' . $this->session->flashdata('message') . '</div>';
                            } ?>

                            <!-- Circles which indicates the steps of the form: -->
                            <div style="text-align:center; margin-bottom: 10px;">
                                <span class="step"></span>
                                <span class="step"></span>
                                <span class="step"></span>
                                <span class="step"></span>
                                <span class="step"></span>
                                <span class="step"></span>
                                <span class="step"></span>
                            </div>

                            <!-- form -->
                            <form id="regForm" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                                <div class="tab" id="tab1">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                            <h6 class="title font-weight-bold">Traveller Information</h6>
                                        </div><!--./col-lg-6 -->
                                    </div><!--./row -->

                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                                            <div class="form-group">
                                                <label>Name <span style="color: red;">*</span></label>
                                                <?= form_input($name) ?>
                                                <span id="errorName" style="color: red;"></span>
                                            </div><!--./form-group -->
                                        </div><!--./col-lg-6 -->

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                                            <div class="form-group">
                                                <label>Age <span style="color: red;">*</span></label>
                                                <?php echo form_input($age); ?>
                                                <span id="errorAge" style="color: red;"></span>
                                            </div><!--./form-group -->
                                        </div><!--./col-lg-6 -->

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                                            <div class="form-group">
                                                <label>Sex <span style="color: red;">*</span></label><br/>
                                                <?php
                                                $sex_options = ['' => 'Select Sex', 'Male' => 'Male', 'Female' => 'Female'];
                                                echo form_dropdown('sex', $sex_options, set_value('sex'), 'class="form-control" id="sex"'); ?>
                                                <span id="errorSex" style="color: red;"></span>
                                            </div><!--./form-group -->
                                        </div><!--./col-lg-6 -->
                                    </div><!--./row -->

                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                                            <div class="form-group">
                                                <label>Nationality <span style="color: red;">*</span></label>
                                                <?php echo form_input($nationality); ?>
                                                <span id="errorNationality" style="color: red;"></span>
                                            </div><!--./form-group -->
                                        </div><!--./col-lg-6 -->

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                                            <div class="form-group">
                                                <label>Passport No. <span style="color: red;">*</span></label>
                                                <?php echo form_input($passport_number); ?>
                                                <span id="errorPassportNo" style="color: red;"></span>
                                            </div><!--./form-group -->
                                        </div><!--./col-lg-6 -->

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                                            <div class="form-group">
                                                <label>Vessel/Flight/Vehicle Name/No <span style="color: red;">*</span></label>
                                                <?php echo form_input($flight); ?>
                                                <span id="errorFlight" style="color: red;"></span>
                                            </div><!--./form-group -->
                                        </div><!--./col-lg-6 -->
                                    </div><!--./row -->

                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                                            <div class="form-group">
                                                <label>Arrival Date <span style="color: red;">*</span></label>
                                                <?php echo form_input($arrival_date); ?>
                                                <span id="errorArrivalDate" style="color: red;"></span>
                                            </div><!--./form-group -->
                                        </div><!--./col-lg-6 -->

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                                            <div class="form-group">
                                                <label>Point of Entry <span style="color: red;">*</span></label>
                                                <?php
                                                $_options = [];
                                                if (isset($entries) && $entries) {
                                                    foreach ($entries as $entry) {
                                                        $_options[$entry->id] = $entry->name;
                                                    }
                                                }
                                                $_options = ['' => 'Select Point of Entry'] + $_options;
                                                echo form_dropdown('point_of_entry', $_options, set_value('point_of_entry'), 'class="form-control" id="point_of_entry"'); ?>
                                                <span id="errorPointOfEntry" style="color: red;"></span>
                                            </div><!--./form-group -->
                                        </div><!--./col-lg-6 -->

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                                            <div class="form-group">
                                                <label>Seat No.</label>
                                                <?php echo form_input($seat_no); ?>
                                                <span id="errorSeatNo" style="color: red;"></span>
                                            </div><!--./form-group -->
                                        </div><!--./col-lg-6 -->
                                    </div><!--./row -->
                                </div><!--./tab -->

                                <div class="tab" id="tab2">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>Purpose of Visit in Tanzania</label>
                                                <?php
                                                $_options = [
                                                    '' => 'Select Purpose',
                                                    'Resident' => 'Resident',
                                                    'Tourist' => 'Tourist',
                                                    'Transit' => 'Transit',
                                                    'Business' => 'Business'
                                                ];
                                                echo form_dropdown('visiting_purpose', $_options, set_value('visiting_purpose'), 'class="form-control"'); ?>
                                                <span style="color: red;"><?= form_error('visiting_purpose'); ?></span>
                                            </div><!--./form-group -->
                                        </div><!--./col-lg-6 -->
                                    </div><!--./row -->

                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>Others Purpose of Visit in Tanzania(Specify)</label>
                                                <?php echo form_input($other_visiting_purpose); ?>
                                                <span style="color: red;"><?= form_error('other_visiting_purpose'); ?></span>
                                            </div><!--./form-group -->
                                        </div><!--./col-lg-6 -->
                                    </div><!--./row -->

                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label>Duration of stay in Tanzania (days) <span
                                                            style="color: red;">*</span></label>
                                                <?php echo form_input($duration_stay); ?>
                                                <span id="errorStayDuration" style="color: red;"></span>
                                            </div><!--./form-group -->
                                        </div><!--./col-lg-6 -->

                                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label>Employment/Work <span style="color: red;">*</span></label>
                                                <?php
                                                $_options = [
                                                    '' => 'Select Employment/Work',
                                                    'Government' => 'Government',
                                                    'Non-Government' => 'Non-Government',
                                                    'Non-Profit' => 'Non-Profit',
                                                    'Academician' => 'Academician',
                                                    'Studies' => 'Studies',
                                                    'Business' => 'Business',
                                                    'Religious' => 'Religious',
                                                ];
                                                echo form_dropdown('employment', $_options, set_value('employment'), 'class="form-control" id="employment"'); ?>
                                                <span id="errorEmployment" style="color: red;"></span>
                                            </div><!--./form-group -->
                                        </div><!--./col-lg-6 -->
                                    </div><!--./row -->
                                </div><!--./tab -->

                                <div class="tab" id="tab3">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                            <h6 class="title">Contact while in Tanzania;</h6>
                                        </div><!--./col-lg-6 -->
                                    </div><!--./row -->

                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                                            <div class="form-group">
                                                <label>Physical/Home address </label>
                                                <?php echo form_input($address); ?>
                                            </div><!--./form-group -->
                                        </div><!--./col-lg-6 -->

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                                            <div class="form-group">
                                                <label>Hotel Name </label>
                                                <?php echo form_input($hotel); ?>
                                            </div><!--./form-group -->
                                        </div><!--./col-lg-6 -->

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                                            <div class="form-group">
                                                <label>Street/Ward/District </label>
                                                <?php echo form_input($street); ?>
                                            </div><!--./form-group -->
                                        </div><!--./col-lg-6 -->
                                    </div><!--./row -->

                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                                            <div class="form-group">
                                                <label>Mobile Number</label>
                                                <?php echo form_input($mobile); ?>
                                                <span id="errorMobile" style="color: red;"></span>
                                            </div><!--./form-group -->
                                        </div><!--./col-lg-6 -->

                                        <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <?php echo form_input($email); ?>
                                                <span id="errorEmail" style="color: red;"></span>
                                            </div><!--./form-group -->
                                        </div><!--./col-lg-6 -->
                                    </div><!--./row -->
                                </div><!--./tab -->

                                <div class="tab" id="tab4">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>Country where the journey started: </label>
                                                <?php echo form_input($country_origin); ?>
                                                <span id="errorCountryOrigin" style="color: red;"></span>
                                            </div><!--./form-group -->
                                        </div><!--./col-lg-6 -->
                                    </div><!--./row -->
                                </div><!--./tab -->

                                <div class="tab">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                            <h6 class="title">For the past 21 days (3 weeks) which countries have you
                                                visited?</h6>
                                        </div><!--./col-lg-6 -->
                                    </div><!--./row -->

                                    <div class="row field_wrapper">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-12">
                                            <div class="form-group">
                                                <label>Country</label>
                                                <?php echo form_input(['id' => 'country', 'name' => 'country[]', 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Write country...']); ?>
                                                <span style="color: red;"><?= form_error('country[]'); ?></span>
                                            </div><!--./form-group -->
                                        </div><!--./col-lg-2 -->

                                        <div class="col-lg-3 col-md-3 col-sm-3 col-12">
                                            <div class="form-group">
                                                <label>Location visited/Province</label>
                                                <?php echo form_input(['id' => 'location[]', 'name' => 'location', 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Write location...']); ?>
                                                <span style="color: red;"><?= form_error('location'); ?></span>
                                            </div><!--./form-group -->
                                        </div><!--./col-lg-2 -->

                                        <div class="col-lg-3 col-md-3 col-sm-3 col-12">
                                            <div class="form-group">
                                                <label>Date</label>
                                                <?php echo form_input(['id' => 'date', 'name' => 'date[]', 'class' => 'form-control', 'type' => 'date']); ?>
                                                <span style="color: red;"><?= form_error('date[]'); ?></span>
                                            </div><!--./form-group -->
                                        </div><!--./col-lg-2 -->

                                        <div class="col-lg-3 col-md-3 col-sm-3 col-12">
                                            <div class="form-group">
                                                <label>No. of days</label>
                                                <?php echo form_input(['id' => 'days', 'name' => 'days[]', 'class' => 'form-control', 'type' => 'number', 'placeholder' => 'Write no of days...']); ?>
                                                <span style="color: red;"><?= form_error('days[]'); ?></span>
                                            </div><!--./form-group -->
                                        </div><!--./col-lg-2 -->
                                    </div><!--./row -->

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="pull-right">
                                                <a href="javascript:void(0);" class="add_button btn btn-info btn-sm"
                                                   title="Add field">
                                                    Add Another
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div><!--./tab -->

                                <div class="tab" id="tab5">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                            <h6 class="title">In the last 21 days (3 weeks) have you</h6>
                                        </div><!--./col-lg-6 -->
                                    </div><!--./row -->

                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>Visited/Resided in an area with cases/deaths due to
                                                    Ebola / Corona Virus?</label><br/>
                                                <?php
                                                echo form_radio('visited_area', 'Yes', NULL, 'id="visited_area" ' . set_radio('visited_area', 'Yes'));
                                                echo '<label>Yes</label> &nbsp;&nbsp;&nbsp;';

                                                echo form_radio('visited_area', 'No', NULL, 'id="visited_area" ' . set_radio('visited_area', 'No'));
                                                echo '<label>No</label>';
                                                ?>
                                                <span style="color: red;"><?= form_error('visited_area'); ?></span>
                                            </div><!--./form-group -->
                                        </div><!--./col-lg-12 -->
                                    </div><!--./row -->

                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>Participated in taken care of the sick person?</label><br/>
                                                <?php
                                                echo form_radio('taken_care_sick_person', 'Yes', NULL, 'id="taken_care_sick_person" ' . set_radio('taken_care_sick_person', 'Yes'));
                                                echo '<label>Yes</label> &nbsp;&nbsp;&nbsp;';

                                                echo form_radio('taken_care_sick_person', 'No', NULL, 'id="taken_care_sick_person" ' . set_radio('taken_care_sick_person', 'No'));
                                                echo '<label>No</label> &nbsp;&nbsp;&nbsp;'; ?>
                                                <span style="color: red;"><?= form_error('taken_care_sick_person'); ?></span>
                                            </div><!--./form-group -->
                                        </div><!--./col-lg-12 -->
                                    </div><!--./row -->

                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>Participated in the burial of dead person?</label><br/>
                                                <?php
                                                echo form_radio('participated_in_burial', 'Yes', NULL, 'id="participated_in_burial" ' . set_radio('participated_in_burial', 'Yes'));
                                                echo '<label>Yes</label> &nbsp;&nbsp;&nbsp;';

                                                echo form_radio('participated_in_burial', 'No', NULL, 'id="participated_in_burial" ' . set_radio('participated_in_burial', 'No'));
                                                echo '<label>No</label> &nbsp;&nbsp;&nbsp;'; ?>
                                                <span style="color: red;"><?= form_error('participated_in_burial'); ?></span>
                                            </div><!--./form-group -->
                                        </div><!--./col-lg-12 -->
                                    </div><!--./row -->
                                </div><!--./tab -->

                                <div class="tab" id="tab6">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                            <h6 class="title">Have you experienced the following conditions during the
                                                last 21 days (3 week)?</h6>
                                        </div><!--./col-lg-6 -->
                                    </div><!--./row -->

                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <?php
                                                $serial = 0;
                                                if (isset($symptoms) && $symptoms) {
                                                    foreach ($symptoms as $symptom) { ?>
                                                        <input type="checkbox" name="symptoms[]"
                                                               id="<?= $symptom->id; ?>"
                                                               value="<?= $symptom->id; ?>" <?= set_checkbox('symptoms[]', $symptom->id); ?>>&nbsp;
                                                        <label for="<?= $symptom->id; ?>"><?= $symptom->name; ?></label>
                                                        <br/>
                                                        <?php
                                                        $serial++;
                                                    }
                                                } ?>
                                                <span style="color: red;"><?= form_error('symptoms[]'); ?></span>
                                            </div><!--./form-group -->
                                        </div><!--./col-lg-12 -->
                                    </div><!--./row -->

                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label>Others (specify)</label>
                                                <?php echo form_input(['id' => 'other_symptoms', 'name' => 'other_symptoms', 'class' => 'form-control', 'type' => 'text']); ?>
                                                <span style="color: red;"><?= form_error('other_symptoms'); ?></span>
                                            </div><!--./form-group -->
                                        </div><!--./col-lg-2 -->
                                    </div><!--./row -->
                                </div><!--./tab -->

                                <div class="row" style="overflow:auto;">
                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-primary btn-xs" id="prevBtn"
                                                    onclick="nextPrev(-1)">Previous
                                            </button>
                                            <button type="button" class="btn btn-secondary btn-xs" id="nextBtn"
                                                    onclick="nextPrev(1)">Next
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form><!--./form -->
                        </div><!--./col-lg-12-->
                    </div><!--./row -->
                </div><!--./card-body -->
            </div><!-- /basic card -->
        </div><!-- /content area -->

        <script src="<?= base_url('assets/js/tabs.js') ?>"></script>