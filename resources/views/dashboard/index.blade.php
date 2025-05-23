@extends('home')
@section('js_before')
@section('header')
@endsection
@section('sidebarMenu')   
@endsection

@section('content')

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<style>
    .highcharts-figure,
.highcharts-data-table table {
    min-width: 360px;
    max-width: 100%;
    margin: 1em auto;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tbody tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

.highcharts-description {
    margin: 0.3rem 10px;
}

</style>
 
            <h3>:: Dashboard <font color="red"> (UI Only) </font> </h3>

            <div class="row">
                <div class="col-sm-3 col-md-3">
                    <div class="alert alert-success" role="alert">
                        <br>
                        <h4> Total  xxx   </h4>
                       <br>
                      </div>
                </div>

                <div class="col-sm-3 col-md-3">
                    <div class="alert alert-danger" role="alert">
                        <br>
                        <h4> Total  xxx   </h4>
                       <br>
                      </div>
                </div>


                <div class="col-sm-3 col-md-3">
                    <div class="alert alert-info" role="alert">
                        <br>
                        <h4> Total  xxx   </h4>
                       <br>
                      </div>
                </div>


                <div class="col-sm-3 col-md-3">
                    <div class="alert alert-primary" role="alert">
                        <br>
                        <h4> Total  xxx   </h4>
                       <br>
                      </div>
                </div>

            </div>


            <div class="row mt-3">
                <div class="col">
                    {{-- <h3>Charts</h3> --}}

                    <figure class="highcharts-figure">
                        <div id="container"></div>
                        <p class="highcharts-description">
                            Basic line chart showing trends in a dataset. This chart includes the
                            <code>series-label</code> module, which adds a label to each line for
                            enhanced readability.
                        </p>
                    </figure>

                    <script>
                        Highcharts.chart('container', {

title: {
    text: 'U.S Solar Employment Growth',
    align: 'left'
},

subtitle: {
    text: 'By Job Category. Source: <a href="https://irecusa.org/programs/solar-jobs-census/" target="_blank">IREC</a>.',
    align: 'left'
},

yAxis: {
    title: {
        text: 'Number of Employees'
    }
},

xAxis: {
    accessibility: {
        rangeDescription: 'Range: 2010 to 2022'
    }
},

legend: {
    layout: 'vertical',
    align: 'right',
    verticalAlign: 'middle'
},

plotOptions: {
    series: {
        label: {
            connectorAllowed: false
        },
        pointStart: 2010
    }
},

series: [{
    name: 'Installation & Developers',
    data: [
        43934, 48656, 65165, 81827, 112143, 142383,
        171533, 165174, 155157, 161454, 154610, 168960, 171558
    ]
}, {
    name: 'Manufacturing',
    data: [
        24916, 37941, 29742, 29851, 32490, 30282,
        38121, 36885, 33726, 34243, 31050, 33099, 33473
    ]
}, {
    name: 'Sales & Distribution',
    data: [
        11744, 30000, 16005, 19771, 20185, 24377,
        32147, 30912, 29243, 29213, 25663, 28978, 30618
    ]
}, {
    name: 'Operations & Maintenance',
    data: [
        null, null, null, null, null, null, null,
        null, 11164, 11218, 10077, 12530, 16585
    ]
}, {
    name: 'Other',
    data: [
        21908, 5548, 8105, 11248, 8989, 11816, 18274,
        17300, 13053, 11906, 10073, 11471, 11648
    ]
}],

responsive: {
    rules: [{
        condition: {
            maxWidth: 500
        },
        chartOptions: {
            legend: {
                layout: 'horizontal',
                align: 'center',
                verticalAlign: 'bottom'
            }
        }
    }]
}

});

                    </script>
                </div>
            </div>
       

            @endsection


            @section('footer')
            @endsection
        
            @section('js_before')
            @endsection
        
        {{-- devbanban.com --}}

 