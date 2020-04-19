<!-- Page content -->
<div class="page-content">

    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Page header -->
        <div class="page-header page-header-light">
            <div class="page-header-content header-elements-md-inline" style="margin-top: -25px;
            margin-bottom: -25px !important;">
                <div class="page-title d-flex">
                    <h4><i class="icon-home4 mr-2"></i> <span class="font-weight-semibold">PoE Entries</span></h4>
                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div><!--./page-title -->
            </div><!--./page-header-content -->
        </div><!-- /page header -->


        <!-- Content area -->
        <div class="content">
            <!-- Basic datatable -->
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">PoE Entries</h5>

                    <span class="pull-right">
                        <a data-toggle="modal" data-target="#exampleModal">Advanced Search</a>
                    </span>
                </div>

                <table class="table table-bordered datatable-basic">
                    <thead>
                    <tr>
                        <th width="3%"></th>
                        <th width="15%">Name</th>
                        <th width="6%">Age</th>
                        <th width="6%">Sex</th>
                        <th width="10%">Passport No.</th>
                        <th width="10%">Nationality</th>
                        <th width="10%">Flight/Vehicle</th>
                        <th width="10%">Arrival Date</th>
                        <th width="30%">Temp (&#8451;)</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php if (isset($entries) && $entries) {
                        $serial = 1;
                        foreach ($entries as $values) { ?>
                            <tr>
                                <td><?= $serial ?></td>
                                <td>
                                    <a href="<?= site_url('entries/details/' . $values->id) ?>"><?= $values->name ?></a>
                                </td>
                                <td><?= $values->age ?></td>
                                <td><?= $values->sex ?></td>
                                <td><?= $values->passport_number ?></td>
                                <td><?= $values->nationality ?></td>
                                <td><?= $values->flight ?></td>
                                <td><?= date('d M, Y', strtotime($values->created_at)) ?></td>
                                <td>
                                    <form id="formElem" method="post">
                                        <input type="hidden" name="base_url" value="<?= base_url() ?>">
                                        <input type="hidden" name="entry_id" value="<?= $values->id ?>">

                                        <div class="input-group">
                                            <input type="number" name="temp" id="temp"
                                                   value="<?= (!empty($values->temperature) ? $values->temperature : '') ?>"
                                                   class="form-control"/>
                                            <select id="action_taken" name="action_taken">
                                                <option>Action</option>
                                                <option>Allowed to proceed</option>
                                                <option>Sent to secondary screening</option>
                                            </select>

                                            <span class="input-group-btn">
                                                    <button type="submit" name="search" class="btn btn-primary btn-sm">
                                                    <i class="icon-arrow-right5"></i></button>
                                                </span>
                                        </div><!--./form-group -->
                                        <span id="errorname" style="color: red;"></span>
                                    </form>
                                </td>
                            </tr>
                            <?php $serial++;
                        }
                    } ?>
                    </tbody>
                </table>
            </div><!-- /basic datatable-->
        </div><!-- /content area-->

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Advanced Search</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?= form_open(uri_string()) ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Passenger Name</label>
                                    <?= form_input(['name' => 'name', 'id' => 'name', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Passenger name ...']) ?>
                                </div><!--./form-group -->
                            </div><!--./col-md-12 -->
                        </div><!--./row -->

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Passport No.</label>
                                    <?= form_input(['name' => 'passport_no', 'id' => 'passport_no', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Passport No ...']) ?>
                                </div><!--./form-group -->
                            </div><!--./col-md-12 -->
                        </div><!--./row -->

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Vessel/Flight/Vehicle Name/No</label>
                                    <?= form_input(['name' => 'vessel', 'id' => 'vessel', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Vessel/Flight/Vehicle Name/No ...']) ?>
                                </div><!--./form-group -->
                            </div><!--./col-md-12 -->
                        </div><!--./row -->

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Arrival Date</label>
                                    <?= form_input(['name' => 'arrival_date', 'id' => 'arrival_date', 'type' => 'date', 'class' => 'form-control', 'placeholder' => 'Arrival date ...']) ?>
                                </div><!--./form-group -->
                            </div><!--./col-md-12 -->
                        </div><!--./row -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <?php echo form_submit('search', 'Search', array('class' => "btn btn-primary")); ?>
                                </div>
                            </div>
                        </div><!--./row -->
                        <?= form_close() ?>
                    </div><!--./modal-body -->
                </div><!--./modal-content -->
            </div><!--./modal-dialog -->
        </div><!--./modal -->

        <script type="text/javascript">
            //on form submit
            let form = document.getElementById('formElem');
            errorMessage = document.getElementById('errorname');
            form.onsubmit = function () {
                let formData = new FormData(form);

                //entries
                let base_url = formData.get("base_url");
                let entry_id = formData.get("entry_id");
                let temp = formData.get("temp");

                // validation fails if the input is blank
                if (temp === "") {
                    errorMessage.innerText = 'Temperature is empty!';
                    return false;
                }

                //validate temp and alert
                if (temp < 35 || temp > 40) {
                    errorMessage.innerText = 'Temperature range 35 to 40';
                    return false
                }

                //append formData
                formData.append('entry_id', entry_id);
                formData.append('temp', temp);

                let xhr = new XMLHttpRequest();
                // Add any event handlers here...
                xhr.open('POST', base_url + '/entries/record_temp', true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        let response = xhr.responseText;
                        if (response !== "") {
                            temp.innerHTML = temp;
                            temp.style.display = "block";
                        } else {
                            temp.style.display = "none";
                        }

                    }
                };
                xhr.send(formData);
            }
        </script>