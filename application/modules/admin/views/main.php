<div class="content" id="content">
    <div class="row mt-2">
        <div class="col-md-12">
            <div class="pull-right">
                <?= form_open(uri_string(), 'method="POST"'); ?>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <?php
                            $_option = ['' => '-- Select --', 'today' => 'Today', 'yesterday' => 'Yesterday', 'week' => 'Last week', 'month' => 'Last month', 'overall' => 'Overall'];
                            echo form_dropdown('days', $_option, set_value('days'), 'class="form-control"'); ?>
                        </div> <!-- /form-group -->
                    </div><!--./col-lg-4 -->

                    <div class="col-lg-2">
                        <div class="form-group">
                            <button type="submit" name="filter" class="btn btn-secondary">
                                <i class="fa fa-search"></i> Filter
                            </button>
                        </div> <!-- /form-group -->
                    </div><!--./col-lg-4 -->
                </div><!--./row -->
                <?= form_close() ?>
            </div>
        </div>
    </div><!--./row -->

    <div class="row">
        <div class="col-lg-3 col-md-2">
            <div class="card bg-primary-200">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 col-xs-3">
                            <i class="fa fa-reg-users"></i>
                        </div>
                        <div class="col-md-9 col-xs-9 text-right">
                            <div class="text-medium">
                                Total Passengers
                            </div>
                            <br/>
                            <div class="text-large">
                                <?= (isset($total_passengers) ? number_format($total_passengers) : '') ?>
                            </div>
                        </div><!--./col-xs-9 -->
                    </div>
                </div>
            </div>
        </div><!--./col-md-3 -->

        <div class="col-lg-3 col-md-3">
            <div class="card bg-secondary-200">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 col-xs-3">
                            <i class="fa fa-couple-users"></i>
                        </div>
                        <div class="col-md-9 col-xs-9 text-right">
                            <div class="text-medium">
                                Male: <?= calc_percentage($male, $total_passengers) ?>%
                            </div>
                            <br/>
                            <div class="text-medium">
                                Female: <?= calc_percentage($female, $total_passengers) ?>%
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--./col-md-3 -->

        <div class="col-lg-3 col-md-3">
            <div class="card bg-danger">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 col-xs-3">
                            <i class="fa fa-above-temp"></i>
                        </div>
                        <div class="col-md-9 col-xs-9 text-right">
                            <div class="text-medium">Above Temp</div>
                            <div class="text-large"><?= number_format(count($total_above_temp)) ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--./col-md-3 -->

        <div class="col-lg-3 col-md-3">
            <div class="card bg-success">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 col-xs-3">
                            <i class="fa fa-normal-temp"></i>
                        </div>
                        <div class="col-md-9 col-xs-9 text-right">
                            <div class="text-medium">Normal Temp</div>
                            <div class="text-large"><?= number_format(count($total_normal_temp)) ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--./col-md-3 -->
    </div><!--./row -->

    <div class="row mt-4 mb-4">
        <div class="col-md-9 col-12">
            <div class="card card-flat bg-graph p-2">
                <div class="card-heading">
                    <b class="text-uppercase">Registered Passengers per POE</b>
                </div>
                <div class="card-body">
                    <div id="registered-passengers" style="height: 350px; width: 100%;"></div>
                </div>
            </div><!--./card-->
        </div><!--./col-md-6 -->

        <div class="col-md-3 col-12">
            <div class="card card-flat bg-graph p-2">
                <div class="card-heading">
                    <b class="text-uppercase">Actions</b>
                </div>

                <div class="card-body">
                    <div class="info" style="height: 350px; width: 100%;">
                        <p>Number of Flight
                            <span>5</span>
                        </p>

                        <p>International Passengers
                            <span>200</span>
                        </p>

                        <p>Domestic Passengers
                            <span>100</span>
                        </p>

                        <p>Going to secondary screening
                            <span>240</span>
                        </p>

                        <p>Allowed to Proceed
                            <span>255</span>
                        </p>
                    </div><!--stats -->
                </div>
            </div><!--./card-->
        </div><!--./col-md-3 -->
    </div><!--./row -->

    <div class="row mt-4 mb-4">
        <div class="col-md-12 col-12">
            <div class="card card-flat bg-graph p-2">
                <div class="card-heading">
                    <b class="text-uppercase">Reported symptoms</b>
                </div>
                <div class="card-body">
                    <div id="reported-symptoms" style="height: 400px; width: 100%;"></div>
                </div>
            </div><!--./card-->
        </div><!--./col-md-6 -->
    </div><!--./row -->

</div><!--./content -->

<script type="text/javascript">
    //Registered Passengers
    $(function () {
        Highcharts.setOptions({
            lang: {
                thousandsSep: ','
            }
        });

        $('#registered-passengers').highcharts({
                chart: {
                    type: 'column',
                    backgroundColor: '#fafafa'
                },
                title: {
                    text: null
                },
                xAxis: {
                    categories: <?= (isset($poe_array) ? $poe_array : '') ?>,
                    crosshair: true
                },
                yAxis: {
                    title: {
                        text: null
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:,.0f}</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0,
                        minPointLength: 3,
                        dataLabels: {
                            enabled: true,
                            style: {
                                fontWeight: 'bold',
                                fontSize: '8px'
                            }
                        }
                    },
                    series: {
                        cursor: 'pointer',
                        point: {
                            events: {
                                click: function () {
                                    //todo: prompt link to a specific poe

                                }
                            }
                        }
                    }
                },
                series: [
                    {
                        showInLegend: false,
                        name: 'Passengers',
                        color: '#1565c0',
                        data: <?= (isset($passengers_array) ? $passengers_array : '')?>
                    }
                ],
                credits: {
                    enabled: false
                }
            }
        );
    });


    //reported-symptoms
    $(function () {
        Highcharts.setOptions({
            lang: {
                thousandsSep: ','
            }
        });

        $('#reported-symptoms').highcharts({
                chart: {
                    type: 'column',
                    backgroundColor: '#fafafa'
                },
                title: {
                    text: null
                },
                xAxis: {
                    categories: <?= (isset($symptoms_array) ? $symptoms_array : '') ?>,
                    crosshair: true
                },
                yAxis: {
                    title: {
                        text: null
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:,.0f}</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0,
                        minPointLength: 3,
                        dataLabels: {
                            enabled: true,
                            style: {
                                fontWeight: 'bold',
                                fontSize: '8px'
                            }
                        }
                    },
                    series: {
                        cursor: 'pointer',
                        point: {
                            events: {
                                click: function () {
                                    //todo: prompt link to a specific poe

                                }
                            }
                        }
                    }
                },
                series: [
                    {
                        showInLegend: false,
                        name: 'Reported symptoms',
                        color: '#B71C1C',
                        data: <?= (isset($symptom_occurrences_array) ? $symptom_occurrences_array : '')?>
                    }
                ],
                credits: {
                    enabled: false
                }
            }
        );
    });
</script>






