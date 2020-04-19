<!-- Page content -->
<div class="page-content">

    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Page header -->
        <div class="page-header page-header-light">
            <div class="page-header-content header-elements-md-inline" style="margin-top: -25px;
            margin-bottom: -25px !important;">
                <div class="page-title d-flex">
                    <h4><i class="icon-home4 mr-2"></i> <span class="font-weight-semibold">PoE Risk Assessment</span>
                    </h4>
                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div><!--./page-title -->
            </div><!--./page-header-content -->
        </div><!-- /page header -->


        <!-- Content area -->
        <div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <?php
                    if ($this->session->flashdata('message') != '') {
                        echo '<div class="success_message">' . $this->session->flashdata('message') . '</div>';
                    } ?>
                </div>
            </div><!--./row -->

            <!-- Basic datatable -->
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">Information</h5>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h6 class="title">Traveller Information</h6>
                                </div><!--./col-lg-12 -->
                            </div><!--./row -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <p>Full Name : <?= $entry->surname . ', ' . $entry->other_names ?></p>
                                    <p>Age : <?= $entry->age ?></p>
                                    <p>Sex : <?= $entry->sex ?></p>
                                    <p>Passport Number : <?= $entry->passport_number ?></p>
                                    <p>Passport Country : <?= $entry->passport_country ?></p>
                                    <p>Emergency Contact : <?= $entry->emergency_contact ?></p>
                                </div>
                            </div>
                        </div><!--./col-lg-6 -->

                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h6 class="title mt-2">Location where traveller either had exposure of became
                                        ill</h6>
                                </div><!--./col-lg-12 -->
                            </div><!--./row -->

                            <div class="row">
                                <div class="col-lg-4">
                                    <p>Village or Town : <?= $entry->village ?></p>
                                    <p>District : <?= $entry->district ?></p>
                                    <p>Province or Region : <?= $entry->region ?></p>
                                    <p>From Date : <?= date('d-M-Y', strtotime($entry->from_date)) ?></p>
                                    <p>To Date : <?= date('d-M-Y', strtotime($entry->to_date)) ?></p>
                                    <p>Did you have contact : <?= $entry->contact_with ?></p>
                                    <p>Appropriate PPE : <?= $entry->appropriate_ppe ?></p>
                                </div><!--./col-lg-6 -->

                                <div class="col-lg-4">
                                    <p><label>PPE Breach</label> : <?= $entry->ppe_breaches ?></p>
                                    <p><label>Work in Lab</label> : <?= $entry->work_in_lab ?></p>
                                    <p><label>Biosafety measures </label> : <?= $entry->biosafety_measures ?></p>
                                    <p><label>Biosafety Breach </label> : <?= $entry->biosafety_breach ?></p>
                                    <p><label>Funeral Attendance</label> : <?= $entry->funeral_attendance ?></p>
                                </div><!--./col-lg-6 -->

                                <div class="col-lg-4">
                                    <p><label>Travel Outside</label> : <?= $entry->travel_outside ?></p>
                                    <p><label>Hospitalized</label> : <?= $entry->hospitalized ?></p>
                                    <p><label>Hospital Name</label> : <?= $entry->hospital_name ?></p>
                                    <p><label>Consultation</label> : <?= $entry->consultation ?></p>
                                    <p><label>Exposure Date</label>
                                        : <?= date('d-M-Y', strtotime($entry->exposure_date)) ?></p>
                                </div><!--./col-lg-4 -->
                            </div><!--./row -->
                        </div><!--./col-lg-6 -->
                    </div><!--./row -->
                    <hr/>
                    <div class="row">
                        <div class="col-lg-12">
                            <h6 class="title">Clinical Signs and Symptoms</h6>
                            <p>Pain Medication : <?= $entry->pain_medication ?></p>
                            <p>Symptoms : <?= $symptoms ?></p>
                            <p>Temperature
                                : <?= ($entry->temperature != '') ? $entry->temperature . ' &#8451;' : '' ?></p>
                        </div><!--./col-lg-6 -->
                    </div><!--./row -->
                    <hr/>

                    <div class="row">
                        <div class="col-lg-12">
                            <h6 class="title">Record Temperature</h6>
                            <?= form_open(uri_string()); ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Temperature (&#8451;)<span style="color: red;">*</span></label>
                                        <input type="hidden" name="temp" id="temp" required />
                                        <span style="color: red;"><?= form_error('temperature'); ?></span>
                                    </div>
                                </div><!--./col-lg-12 -->
                            </div><!--./row -->

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <?php echo form_submit('submit', 'Record', array('class' => "btn btn-primary")); ?>
                                        <?= anchor('Surveillance', 'Cancel', 'class="btn btn-warning"') ?>
                                    </div>
                                </div>
                            </div><!--./row -->
                            <?= form_close(); ?>
                        </div><!--./col-lg-12-->
                    </div><!--./row -->
                </div><!--./card-body -->
            </div><!-- /basic datatable-->
        </div><!-- /content area-->