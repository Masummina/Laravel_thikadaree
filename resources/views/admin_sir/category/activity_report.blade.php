@extends('admin.layouts.layout')
@section('content')



    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Teamwise Prospect Activity </h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">

                        <!-- /.box-header -->
                        <div class="box-body">
                            <table  class="table  table-striped">
                                <thead>
                                <tr>
                                    <th >S# </th>
                                    <th> Name</th>
                                    <th >Previous</th>
                                    <th >New</th>
                                    <th >Escaped</th>
                                    <th >Client</th>
                                    <th >Total</th>
                                </tr>


                                </thead>
                                <tbody>


                                @foreach($activity_list as $active)
                                    <tr>
                                    <td>{{'#000'.$active['cid']}}</td>
                                        <td>{{$active['name']}}</td>
                                    <td>{{$active['prev_prospect']}}</td>
                                    <td>{{$active['current_prospect']}}</td>
                                    <td>{{$active['escaped']}}</td>
                                    <td>{{$active['client']}}</td>
                                    <td>{{$active['total']}}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td>{{'Total'}}</td>
                                    <td>{{' '}}</td>
                                    <td>{{$total_row['prev_prospect']}}</td>
                                    <td>{{$total_row['current_prospect']}}</td>
                                    <td>{{$total_row['escaped']}}</td>
                                    <td>{{$total_row['client']}}</td>
                                    <td>{{$total_row['total']}}</td>

                                </tr>

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <h3>Bar chart of Prospects</h3>
                        <div class="box-body">
                            <div class="container">
                                <canvas id="areaChart" height="550"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <h3>Total Prospects Status</h3>
                        <div class="box-body">
                            <div class="container">
                                <canvas id="totalChart" height="550"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<script type="text/javascript" src="{{URL::asset('js/chartjs/Chart.js')}}"></script>
<script type="text/javascript">
    $(function () {
        /* ChartJS
         * -------
         * Here we will create a few charts using ChartJS
         */

        //--------------
        //- AREA CHART -
        //--------------

        // Get context with jQuery - using jQuery's .get() method.
      /*  var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
        // This will get the first returned node in the jQuery collection.
        var areaChart = new Chart(areaChartCanvas);

        var areaChartData = {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [
                {
                    label: "Electronics",
                    fillColor: "rgba(210, 214, 222, 1)",
                    strokeColor: "rgba(210, 214, 222, 1)",
                    pointColor: "rgba(210, 214, 222, 1)",
                    pointStrokeColor: "#c1c7d1",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: [65, 59, 80, 81, 56, 55, 40]
                },
                {
                    label: "Digital Goods",
                    fillColor: "rgba(60,141,188,0.9)",
                    strokeColor: "rgba(60,141,188,0.8)",
                    pointColor: "#3b8bba",
                    pointStrokeColor: "rgba(60,141,188,1)",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(60,141,188,1)",
                    data: [28, 48, 40, 19, 86, 27, 90]
                }
            ]
        };

        var areaChartOptions = {
            //Boolean - If we should show the scale at all
            showScale: true,
            //Boolean - Whether grid lines are shown across the chart
            scaleShowGridLines: false,
            //String - Colour of the grid lines
            scaleGridLineColor: "rgba(0,0,0,.05)",
            //Number - Width of the grid lines
            scaleGridLineWidth: 1,
            //Boolean - Whether to show horizontal lines (except X axis)
            scaleShowHorizontalLines: true,
            //Boolean - Whether to show vertical lines (except Y axis)
            scaleShowVerticalLines: true,
            //Boolean - Whether the line is curved between points
            bezierCurve: true,
            //Number - Tension of the bezier curve between points
            bezierCurveTension: 0.3,
            //Boolean - Whether to show a dot for each point
            pointDot: false,
            //Number - Radius of each point dot in pixels
            pointDotRadius: 4,
            //Number - Pixel width of point dot stroke
            pointDotStrokeWidth: 1,
            //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
            pointHitDetectionRadius: 20,
            //Boolean - Whether to show a stroke for datasets
            datasetStroke: true,
            //Number - Pixel width of dataset stroke
            datasetStrokeWidth: 2,
            //Boolean - Whether to fill the dataset with a color
            datasetFill: true,
            //String - A legend template

            //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
            maintainAspectRatio: false,
            //Boolean - whether to make the chart responsive to window resizing
            responsive: true

        };*/
       // areaChart.Line(areaChartData, areaChartOptions);

        var persons = <?php echo json_encode($activity_list); ?>;

      //  console.log(persons);
        var p_l= [];
        var prospects = [];
        var clients  = [];
        var escape = [];
        var total = [];
        var new_p =[]
         console.log(persons);
        for (var i in persons)
        {
           p_l.push(persons[i].name);
           prospects.push(persons[i].prev_prospect);
            clients.push(persons[i].client);
            new_p.push(persons[i].current_prospect);
            total.push(persons[i].total);
            escape.push(persons[i].escaped);


        }




        var areaChartData = {
            labels: p_l,
            datasets: [
                {
                    label: "Previous",
                    fillColor: "rgba(60,141,188,0.9)",
                    strokeColor: "rgba(60,141,188,0.9)",
                    pointColor: "rgba(210, 214, 222, 1)",
                    pointStrokeColor: "#c1c7d1",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: prospects
                },
                {
                    label: "New",
                    fillColor: "rgb(191, 0, 255,1)",
                    strokeColor: "rgb(191, 0, 255,1)",
                    pointColor: "#3b8bba",
                    pointStrokeColor: "rgba(60,141,188,1)",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(60,141,188,1)",
                    data: new_p
                },
                {
                    label: "Escape",
                    fillColor: "rgba(255,0,0,0.9)",
                    strokeColor: "rgba(255,0,0,0.9)",
                    pointColor: "#3b8bba",
                    pointStrokeColor: "rgba(60,141,188,1)",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(60,141,188,1)",
                    data: escape
                },
                {
                    label: "Client",
                    fillColor: "rgba(255, 204, 153,0.9)",
                    strokeColor: "rgba(255, 204, 153,0.8)",
                    pointColor: "#3b8bba",
                    pointStrokeColor: "rgba(60,141,188,1)",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(60,141,188,1)",
                    data: clients
                },
                {
                    label: "Total",
                    fillColor: "rgba(102, 224, 255,0.9)",
                    strokeColor: "rgba(102, 224, 255,0.8)",
                    pointColor: "#3b8bba",
                    pointStrokeColor: "rgba(60,141,188,1)",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(60,141,188,1)",
                    data: total
                }
            ]
        };

        var totalChartData ={
          labels : ['Total Prospects Status'],
            datasets: [
                {
                    label: "Previous",
                    fillColor: "rgba(60,141,188,0.9)",
                    strokeColor: "rgba(60,141,188,0.9)",
                    pointColor: "rgba(210, 214, 222, 1)",
                    pointStrokeColor: "#c1c7d1",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: [eval(prospects.join("+")) ]
                },
                {
                    label: "New",
                    fillColor: "rgb(191, 0, 255,1)",
                    strokeColor: "rgb(191, 0, 255,1)",
                    pointColor: "#3b8bba",
                    pointStrokeColor: "rgba(60,141,188,1)",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(60,141,188,1)",
                    data: [eval(new_p.join("+"))]
                },
                {
                    label: "Escape",
                    fillColor: "rgba(255,0,0,0.9)",
                    strokeColor: "rgba(255,0,0,0.9)",
                    pointColor: "#3b8bba",
                    pointStrokeColor: "rgba(60,141,188,1)",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(60,141,188,1)",
                    data: [eval(escape.join("+"))]
                },
                {
                    label: "Client",
                    fillColor: "rgba(255, 204, 153,0.9)",
                    strokeColor: "rgba(255, 204, 153,0.8)",
                    pointColor: "#3b8bba",
                    pointStrokeColor: "rgba(60,141,188,1)",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(60,141,188,1)",
                    data: [eval(clients.join("+"))]
                },
                {
                    label: "Total",
                    fillColor: "rgba(102, 224, 255,0.9)",
                    strokeColor: "rgba(102, 224, 255,0.8)",
                    pointColor: "#3b8bba",
                    pointStrokeColor: "rgba(60,141,188,1)",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(60,141,188,1)",
                    data: [eval(total.join("+"))]
                }
            ]

        };




        var barChartCanvas = $("#areaChart").get(0).getContext("2d");
        var barChart = new Chart(barChartCanvas);
        var barChartData = areaChartData;

        var barChartOptions = {
            //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
            scaleBeginAtZero: true,
            //Boolean - Whether grid lines are shown across the chart
            scaleShowGridLines: true,
            //String - Colour of the grid lines
            scaleGridLineColor: "rgba(0,0,0,.05)",
            //Number - Width of the grid lines
            scaleGridLineWidth: 1,
            //Boolean - Whether to show horizontal lines (except X axis)
            scaleShowHorizontalLines: true,
            //Boolean - Whether to show vertical lines (except Y axis)
            scaleShowVerticalLines: true,
            //Boolean - If there is a stroke on each bar
            barShowStroke: true,

            //Number - Pixel width of the bar stroke
            barStrokeWidth: 2,
            //Number - Spacing between each of the X value sets
            barValueSpacing: 5,
            //Number - Spacing between data sets within X values
            barDatasetSpacing: 1,

            responsive: true,
            maintainAspectRatio: false,
            legend: {
                display: true
            }

            //String - A legend template

        };


        barChartOptions.datasetFill = true;
        barChart.Bar(barChartData, barChartOptions);

        var total = $("#totalChart").get(0).getContext("2d");
        var barChart1 = new Chart(total);

        barChart1.Bar(totalChartData,barChartOptions);



      });


</script>


@endsection