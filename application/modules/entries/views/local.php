<?php $this->load->view('add_more_region') ?>
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
                            <span class="step"></span>
                        </div>

                        <!-- form -->
                        <form id="regForm" action="<?= site_url('entries/local') ?>" method="post">
                            <input type="hidden" id="base_url" name="base_url" value="<?= base_url() ?>"/>
                            <?php echo form_hidden('form_type', 'DOMESTIC'); ?>
                            <div class="tab" id="tab0">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                        <h6 class="title font-weight-bold"><?= $this->lang->line('traveller_information') ?></h6>
                                    </div><!--./col-lg-6 -->
                                </div><!--./row -->

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label><?= $this->lang->line('lbl_full_name') ?> <span
                                                        style="color: red;">*</span></label>
                                            <?= form_input(['id' => 'name', 'name' => 'name', 'type' => 'text', 'class' => 'form-control', 'placeholder' => $this->lang->line('lbl_write_full_name')]) ?>
                                            <span id="errorName" style="color: red;"></span>
                                        </div><!--./form-group -->
                                    </div><!--./col-lg-6 -->

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label><?= $this->lang->line('lbl_age') ?> <span
                                                        style="color: red;">*</span></label>
                                            <?= form_input(['id' => 'age', 'name' => 'age', 'type' => 'number', 'min' => 0, 'max' => 100, 'class' => 'form-control']) ?>
                                            <span id="errorAge" style="color: red;"></span>
                                        </div><!--./form-group -->
                                    </div><!--./col-lg-6 -->

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label><?= $this->lang->line('lbl_sex') ?> <span
                                                        style="color: red;">*</span></label><br/>
                                            <?php
                                            $sex_options = [
                                                '' => $this->lang->line('lbl_select_sex'),
                                                'Male' => $this->lang->line('lbl_male'),
                                                'Female' => $this->lang->line('lbl_female')
                                            ];
                                            echo form_dropdown('sex', $sex_options, set_value('sex'), 'class="form-control" id="sex"'); ?>
                                            <span id="errorSex" style="color: red;"></span>
                                        </div><!--./form-group -->
                                    </div><!--./col-lg-6 -->


                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label><?= $this->lang->line('lbl_nationality') ?> <span
                                                        style="color: red;">*</span></label>
                                            <?php
                                            $_options = [];
                                            if (isset($countries) && $countries) {
                                                foreach ($countries as $country) {
                                                    $_options[$country->code] = $country->name;
                                                }
                                            }
                                            $_options = ['' => $this->lang->line('lbl_select_nationality')] + $_options;
                                            echo form_dropdown('nationality', $_options, set_value('nationality'), 'class="form-control" id="nationality"'); ?>
                                            <span id="errorNationality" style="color: red;"></span>
                                        </div><!--./form-group -->
                                    </div><!--./col-lg-6 -->

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label><?= $this->lang->line('lbl_id_type') ?> <span
                                                        style="color: red;">*</span></label>
                                            <?php
                                            $_options = [
                                                '' => $this->lang->line('lbl_select'),
                                                'Passport No' => $this->lang->line('lbl_passport'),
                                                'National ID' => $this->lang->line('lbl_national'),
                                                'Voters ID' => $this->lang->line('lbl_voter'),
                                            ];
                                            echo form_dropdown('id_type', $_options, set_value('id_type'), 'class="form-control" id="id_type"'); ?>
                                            <span id="errorIdType" style="color: red;"></span>
                                        </div><!--./form-group -->
                                    </div><!--./col-lg-6 -->

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label><?= $this->lang->line('lbl_identification_no') ?> <span
                                                        style="color: red;">*</span></label>
                                            <?php echo form_input(['id' => 'identification_number', 'name' => 'identification_number', 'type' => 'text', 'class' => 'form-control', 'placeholder' => $this->lang->line('lbl_write_id_no')]); ?>
                                            <span id="errorIdNo" style="color: red;"></span>
                                        </div><!--./form-group -->
                                    </div><!--./col-lg-6 -->

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label><?= $this->lang->line('lbl_transport_means') ?> <span
                                                        style="color: red;">*</span></label>
                                            <?php
                                            $_options = [
                                                '' => $this->lang->line('lbl_select_transport_means'),
                                                'Flight' => $this->lang->line('lbl_transport_means_flight'),
                                                'Vehicle' => $this->lang->line('lbl_transport_means_vehicle'),
                                                'Vessel' => $this->lang->line('lbl_transport_means_vessel')
                                            ];
                                            echo form_dropdown('transport_means', $_options, set_value('transport_means'), 'class="form-control" id="transport_means"'); ?>
                                            <span id="errorTransportMeans" style="color: red;"></span>
                                        </div><!--./form-group -->
                                    </div><!--./col-lg-6 -->

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label><?= $this->lang->line('lbl_transport_means_name') ?> <span
                                                        style="color: red;">*</span></label>
                                            <?php echo form_input(['id' => 'transport_name', 'name' => 'transport_name', 'class' => 'form-control', 'placeholder' => $this->lang->line('lbl_write_transport_means_name')]); ?>
                                            <span id="errorTransportName" style="color: red;"></span>
                                        </div><!--./form-group -->
                                    </div><!--./col-lg-6 -->

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label><?= $this->lang->line('lbl_arrival_date') ?> <span
                                                        style="color: red;">*</span></label>
                                            <?php echo form_input(['id' => 'arrival_date', 'name' => 'arrival_date', 'type' => 'date', 'class' => 'form-control']); ?>
                                            <span id="errorArrivalDate" style="color: red;"></span>
                                        </div><!--./form-group -->
                                    </div><!--./col-lg-6 -->

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label><?= $this->lang->line('lbl_point_of_entry') ?> <span
                                                        style="color: red;">*</span></label>
                                            <?php
                                            $_options = [];
                                            if (isset($entries) && $entries) {
                                                foreach ($entries as $entry) {
                                                    $_options[$entry->id] = $entry->name;
                                                }
                                            }
                                            $_options = ['' => $this->lang->line('lbl_select_point_of_entry')] + $_options;
                                            echo form_dropdown('point_of_entry', $_options, set_value('point_of_entry'), 'class="form-control" id="point_of_entry"'); ?>
                                            <span id="errorPointOfEntry" style="color: red;"></span>
                                        </div><!--./form-group -->
                                    </div><!--./col-lg-6 -->

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label><?= $this->lang->line('lbl_seat_no') ?></label>
                                            <?php echo form_input(['id' => 'seat_no', 'name' => 'seat_no', 'class' => 'form-control', 'placeholder' => $this->lang->line('lbl_write_seat_no')]); ?>
                                            <span id="errorSeatNo" style="color: red;"></span>
                                        </div><!--./form-group -->
                                    </div><!--./col-lg-6 -->
                                </div><!--./row -->
                            </div><!--./tab -->

                            <div class="tab" id="tab1">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label><?= $this->lang->line('lbl_purpose_of_visit') ?></label>
                                            <?php
                                            $_options = [
                                                '' => $this->lang->line('lbl_select_purpose_of_visit'),
                                                'Resident' => $this->lang->line('lbl_purpose_of_visit_resident'),
                                                'Tourist' => $this->lang->line('lbl_purpose_of_visit_tourist'),
                                                'Transit' => $this->lang->line('lbl_purpose_of_visit_transit'),
                                                'Business' => $this->lang->line('lbl_purpose_of_visit_business')
                                            ];
                                            echo form_dropdown('visiting_purpose', $_options, set_value('visiting_purpose'), 'class="form-control"'); ?>
                                        </div><!--./form-group -->
                                    </div><!--./col-lg-6 -->
                                </div><!--./row -->

                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label><?= $this->lang->line('lbl_other_purpose_of_visit') ?></label>
                                            <?php echo form_textarea(['id' => 'other_visiting_purpose', 'name' => 'other_visiting_purpose', 'class' => 'form-control', 'rows' => 3]); ?>
                                        </div><!--./form-group -->
                                    </div><!--./col-lg-6 -->
                                </div><!--./row -->

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label><?= $this->lang->line('lbl_duration_of_stay') ?></label>
                                            <?php echo form_input(['id' => 'duration_stay', 'name' => 'duration_stay', 'type' => 'number', 'min' => 1, 'class' => 'form-control']); ?>
                                            <span id="errorStayDuration" style="color: red;"></span>
                                        </div><!--./form-group -->
                                    </div><!--./col-lg-6 -->

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label><?= $this->lang->line('lbl_employment') ?> <span
                                                        style="color: red;">*</span></label>
                                            <?php
                                            $_options = [
                                                '' => $this->lang->line('lbl_select_employment'),
                                                'Government' => $this->lang->line('lbl_employment_government'),
                                                'Non-Government' => $this->lang->line('lbl_employment_non_government'),
                                                'Non-Profit' => $this->lang->line('lbl_employment_non_profit'),
                                                'Studies' => $this->lang->line('lbl_employment_studies'),
                                                'Business' => $this->lang->line('lbl_employment_business'),
                                                'Religious' => $this->lang->line('lbl_employment_religious'),
                                            ];
                                            echo form_dropdown('employment', $_options, set_value('employment'), 'class="form-control" id="employment"'); ?>
                                            <span id="errorEmployment" style="color: red;"></span>
                                        </div><!--./form-group -->
                                    </div><!--./col-lg-6 -->
                                </div><!--./row -->
                            </div><!--./tab -->

                            <div class="tab" id="tab2">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                        <h6 class="title"><?= $this->lang->line('lbl_contacts') ?></h6>
                                    </div><!--./col-lg-6 -->
                                </div><!--./row -->

                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label><?= $this->lang->line('lbl_address') ?> </label>
                                            <?php echo form_textarea(['id' => 'address', 'name' => 'address', 'rows' => 3, 'class' => 'form-control']); ?>
                                        </div><!--./form-group -->
                                    </div><!--./col-lg-6 -->

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label><?= $this->lang->line('lbl_hotel_name') ?> </label>
                                            <?php echo form_input(['id' => 'hotel', 'name' => 'hotel', 'class' => 'form-control', 'placeholder' => $this->lang->line('lbl_write_hotel_name')]); ?>
                                        </div><!--./form-group -->
                                    </div><!--./col-lg-6 -->

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label><?= $this->lang->line('lbl_region') ?> <span
                                                        style="color: red;">*</span></label>
                                            <?php
                                            $region_option = [];
                                            if (isset($regions) && $regions) {
                                                foreach ($regions as $cp) {
                                                    $region_option[$cp->id] = $cp->name;
                                                }
                                            }
                                            $region_option = ['' => $this->lang->line('lbl_select')] + $region_option;
                                            echo form_dropdown('region_id', $region_option, set_value('region_id'), 'class="form-control" id="region_id" onChange="suggest_districts()"'); ?>
                                            <span id="errorRegion" style="color: red;"></span>
                                        </div><!--./form-group -->
                                    </div><!--./col-lg-6 -->

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label><?= $this->lang->line('lbl_district') ?> </label>
                                            <?php
                                            $district_option = [];
                                            if (isset($districts) && $districts) {
                                                foreach ($districts as $cp) {
                                                    $district_option[$cp->id] = $cp->name;
                                                }
                                            }
                                            $district_option = ['' => $this->lang->line('lbl_select')] + $district_option;
                                            echo form_dropdown('district_id', $district_option, set_value('district_id'), 'class="form-control" id="district_id"'); ?>
                                        </div><!--./form-group -->
                                    </div><!--./col-lg-6 -->

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label><?= $this->lang->line('lbl_street') ?> </label>
                                            <?php echo form_input(['id' => 'street', 'name' => 'street', 'class' => 'form-control', 'placeholder' => $this->lang->line('lbl_write_street')]); ?>
                                        </div><!--./form-group -->
                                    </div><!--./col-lg-6 -->

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label><?= $this->lang->line('lbl_mobile') ?> <span
                                                        style="color: red;">*</span></label>
                                            <?php echo form_input(['id' => 'mobile', 'name' => 'mobile', 'class' => 'form-control', 'placeholder' => $this->lang->line('lbl_write_mobile')]); ?>
                                            <span id="errorMobile" style="color: red;"></span>
                                        </div><!--./form-group -->
                                    </div><!--./col-lg-6 -->

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label><?= $this->lang->line('lbl_email') ?> </label>
                                            <?php echo form_input(['id' => 'email', 'name' => 'email', 'type' => 'email', 'class' => 'form-control', 'placeholder' => $this->lang->line('lbl_write_email')]); ?>
                                            <span id="errorEmail" style="color: red;"></span>
                                        </div><!--./form-group -->
                                    </div><!--./col-lg-6 -->
                                </div><!--./row -->
                            </div><!--./tab -->

                            <div class="tab" id="tab3">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label><?= $this->lang->line('lbl_region_journey_started') ?> <span
                                                        style="color: red;">*</span></label>
                                            <?php
                                            $_options = [];
                                            if (isset($regions) && $regions) {
                                                foreach ($regions as $rg) {
                                                    $_options[$rg->id] = $rg->name;
                                                }
                                            }
                                            $_options = ['' => $this->lang->line('lbl_select')] + $_options;
                                            echo form_dropdown('location_origin', $_options, set_value('location_origin'), 'class="form-control" id="location_origin"'); ?>
                                            <span id="errorRegionOrigin" style="color: red;"></span>
                                        </div><!--./form-group -->
                                    </div><!--./col-lg-6 -->
                                </div><!--./row -->
                            </div><!--./tab -->

                            <div class="tab" id="tab4">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                        <h6 class="title"><?= $this->lang->line('lbl_region_visited') ?></h6>
                                    </div><!--./col-lg-6 -->
                                </div><!--./row -->

                                <div class="row field_wrapper">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label><?= $this->lang->line('lbl_region') ?></label>
                                            <?php
                                            $_options = [];
                                            if (isset($regions) && $regions) {
                                                foreach ($regions as $rg) {
                                                    $_options[$rg->id] = $rg->name;
                                                }
                                            }
                                            $_options = ['' => $this->lang->line('lbl_select')] + $_options;
                                            echo form_dropdown('region[]', $_options, set_value('region[]'), 'class="form-control" id="region"'); ?>
                                        </div><!--./form-group -->
                                    </div><!--./col-lg-2 -->

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label><?= $this->lang->line('lbl_location_region') ?></label>
                                            <?php echo form_input(['id' => 'location[]', 'name' => 'location[]', 'class' => 'form-control', 'type' => 'text']); ?>
                                        </div><!--./form-group -->
                                    </div><!--./col-lg-2 -->

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label><?= $this->lang->line('lbl_date') ?></label>
                                            <?php echo form_input(['id' => 'date', 'name' => 'date[]', 'class' => 'form-control', 'type' => 'date']); ?>
                                            <span id="errorDate" style="color: red;"></span>
                                        </div><!--./form-group -->
                                    </div><!--./col-lg-2 -->

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label><?= $this->lang->line('lbl_no_of_days') ?></label>
                                            <?php echo form_input(['id' => 'days', 'name' => 'days[]', 'class' => 'form-control', 'type' => 'number', 'min' => 1]); ?>
                                            <span id="errorDays" style="color: red;"></span>
                                        </div><!--./form-group -->
                                    </div><!--./col-lg-2 -->
                                </div><!--./row -->

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="pull-right">
                                            <a href="javascript:void(0);" class="add_button btn btn-info btn-sm"
                                               title="Add field">
                                                <?= $this->lang->line('lbl_add_another') ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div><!--./tab -->

                            <div class="tab" id="tab5">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                        <h6 class="title"><?= $this->lang->line('lbl_last_21_days_have_you') ?></h6>
                                    </div><!--./col-lg-6 -->
                                </div><!--./row -->

                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label><?= $this->lang->line('lbl_visited_case_due_to_ebola') ?></label><br/>
                                            <?php
                                            echo form_radio('visit_area_ebola', 'Yes', NULL, 'id="visit_area_ebola" ' . set_radio('visit_area_ebola', 'Yes'));
                                            echo '<label>' . $this->lang->line('lbl_yes') . '</label> &nbsp;&nbsp;&nbsp;';

                                            echo form_radio('visit_area_ebola', 'No', true, 'id="visit_area_ebola" ' . set_radio('visit_area_ebola', 'No'));
                                            echo '<label>' . $this->lang->line('lbl_no') . '</label>';
                                            ?>
                                            <span id="errorVisitedAreaEbola" style="color: red;"></span>
                                        </div><!--./form-group -->
                                    </div><!--./col-lg-12 -->

                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label><?= $this->lang->line('lbl_participate_take_care_sick_person') ?></label><br/>
                                            <?php
                                            echo form_radio('taken_care_sick_person_ebola', 'Yes', NULL, 'id="taken_care_sick_person_ebola" ' . set_radio('taken_care_sick_person_ebola', 'Yes'));
                                            echo '<label>' . $this->lang->line('lbl_yes') . '</label> &nbsp;&nbsp;&nbsp;';

                                            echo form_radio('taken_care_sick_person_ebola', 'No', true, 'id="taken_care_sick_person_ebola" ' . set_radio('taken_care_sick_person_ebola', 'No'));
                                            echo '<label>' . $this->lang->line('lbl_no') . '</label> &nbsp;&nbsp;&nbsp;'; ?>
                                            <span id="errorTakeCareSickPersonEbola" style="color: red;"></span>
                                        </div><!--./form-group -->
                                    </div><!--./col-lg-12 -->

                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label><?= $this->lang->line('lbl_participate_burial_of_dead_person') ?></label><br/>
                                            <?php
                                            echo form_radio('participated_burial_ebola', 'Yes', NULL, 'id="participated_burial_ebola" ' . set_radio('participated_burial_ebola', 'Yes'));
                                            echo '<label>' . $this->lang->line('lbl_yes') . '</label> &nbsp;&nbsp;&nbsp;';

                                            echo form_radio('participated_burial_ebola', 'No', true, 'id="participated_burial_ebola" ' . set_radio('participated_burial_ebola', 'No'));
                                            echo '<label>' . $this->lang->line('lbl_no') . '</label> &nbsp;&nbsp;&nbsp;'; ?>
                                            <span id="errorParticipateBurialEbola" style="color: red;"></span>
                                        </div><!--./form-group -->
                                    </div><!--./col-lg-12 -->
                                </div><!--./row -->
                            </div><!--./tab -->

                            <div class="tab" id="tab6">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                        <h6 class="title"><?= $this->lang->line('lbl_last_21_days_have_you') ?></h6>
                                    </div><!--./col-lg-6 -->
                                </div><!--./row -->

                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label><?= $this->lang->line('lbl_visited_case_due_to_corona') ?></label><br/>
                                            <?php
                                            echo form_radio('visit_area_corona', 'Yes', NULL, 'id="visit_area_corona" ' . set_radio('visit_area_corona', 'Yes'));
                                            echo '<label>' . $this->lang->line('lbl_yes') . '</label> &nbsp;&nbsp;&nbsp;';

                                            echo form_radio('visit_area_corona', 'No', true, 'id="visit_area_corona" ' . set_radio('visit_area_corona', 'No'));
                                            echo '<label>' . $this->lang->line('lbl_no') . '</label>';
                                            ?>
                                            <span id="errorVisitedAreaCorona" style="color: red;"></span>
                                        </div><!--./form-group -->
                                    </div><!--./col-lg-12 -->

                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label><?= $this->lang->line('lbl_participate_take_care_sick_person') ?></label><br/>
                                            <?php
                                            echo form_radio('taken_care_sick_person_corona', 'Yes', NULL, 'id="taken_care_sick_person_corona" ' . set_radio('taken_care_sick_person_corona', 'Yes'));
                                            echo '<label>' . $this->lang->line('lbl_yes') . '</label> &nbsp;&nbsp;&nbsp;';

                                            echo form_radio('taken_care_sick_person_corona', 'No', true, 'id="taken_care_sick_person_corona" ' . set_radio('taken_care_sick_person_corona', 'No'));
                                            echo '<label>' . $this->lang->line('lbl_no') . '</label> &nbsp;&nbsp;&nbsp;'; ?>
                                            <span id="errorTakeCareSickPersonCorona" style="color: red;"></span>
                                        </div><!--./form-group -->
                                    </div><!--./col-lg-12 -->

                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label><?= $this->lang->line('lbl_participate_burial_of_dead_person') ?></label><br/>
                                            <?php
                                            echo form_radio('participated_burial_corona', 'Yes', NULL, 'id="participated_burial_corona" ' . set_radio('participated_burial_corona', 'Yes'));
                                            echo '<label>' . $this->lang->line('lbl_yes') . '</label> &nbsp;&nbsp;&nbsp;';

                                            echo form_radio('participated_burial_corona', 'No', true, 'id="participated_burial_corona" ' . set_radio('participated_burial_corona', 'No'));
                                            echo '<label>' . $this->lang->line('lbl_no') . '</label> &nbsp;&nbsp;&nbsp;'; ?>
                                            <span id="errorParticipateBurialCorona" style="color: red;"></span>
                                        </div><!--./form-group -->
                                    </div><!--./col-lg-12 -->
                                </div><!--./row -->
                            </div><!--./tab -->

                            <div class="tab" id="tab7">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                        <h6 class="title"><?= $this->lang->line('lbl_experienced_following_conditions') ?></h6>
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
                                                           id="symptoms"
                                                           value="<?= $symptom->id; ?>" <?= set_checkbox('symptoms[]', $symptom->id); ?>>&nbsp;
                                                    <label for="<?= $symptom->id; ?>"><?= $this->lang->line('lbl_' . $symptom->alias); ?></label>
                                                    <br/>
                                                    <?php
                                                    $serial++;
                                                }
                                            } ?>
                                            <span id="errorSymptoms" style="color: red;"></span>
                                        </div><!--./form-group -->
                                    </div><!--./col-lg-12 -->
                                </div><!--./row -->

                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label><?= $this->lang->line('lbl_other_symptoms') ?></label>
                                            <?php echo form_input(['id' => 'other_symptoms', 'name' => 'other_symptoms', 'class' => 'form-control', 'type' => 'text']); ?>
                                        </div><!--./form-group -->
                                    </div><!--./col-lg-2 -->
                                </div><!--./row -->
                            </div><!--./tab -->

                            <div class="row" style="overflow:auto;">
                                <div class="col-lg-12 col-12">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary btn-xs" id="prevBtn"
                                                onclick="nextPrev(-1)"><?= $this->lang->line('lbl_previous') ?>
                                        </button>
                                        <button type="button" class="btn btn-secondary btn-xs" id="nextBtn"
                                                onclick="nextPrev(1)"><?= $this->lang->line('lbl_next') ?>
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
<?php $this->load->view('validation_local') ?>