@extends('templates.homepage')

@section('content')

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Views'],
          ['2015',  92961],
          ['2016',  226168],
          ['2017 e\'', 1000000]
        ]);

        var options = {
          curveType: 'function',
          legend: { position: 'bottom' },
          chartArea: {top: 20, left:70, right:20, bottom:80}
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

        chart.draw(data, options);
      }
    </script> 


    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Issuer', 'Products'],
          ['Firms', 164677],
          ['Visitors', 220077],
        ]);

        var options = {

          sliceVisibilityThreshold: 0.02,
          chartArea: {top: 20, left:10, right:10, bottom:15}

        };

        var data2 = google.visualization.arrayToDataTable([
          ['Country', 'Views'],
        @foreach($countries as $country)
          ['{{$country->name}}', {{ $country->views_count }}],
        @endforeach
        ]);

        var options2 = {

          sliceVisibilityThreshold: 0.02,
          chartArea: {top: 20, left:10, right:10, bottom:15}

        };


        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        var chart2 = new google.visualization.PieChart(document.getElementById('piechart2'));
        chart.draw(data, options);
        chart2.draw(data2, options2);
      }
    </script> 

   
<div class="row" style="background-color:#dc5f13; margin-bottom:50px;">
    <h1 class="text-center" style="color:#fff; padding-top:20px; padding-bottom:20px;">Dashboard</h1>
    <br/>
</div>

<div class="col-md-10 col-md-offset-1">
  
  <div class="row">

    <div class="col-md-6">

      <div class="panel panel-default" style="border-top-left-radius:0px; border-top-right-radius:0px; border-color:#616163 ">
        <div class="panel-heading" style="background-color:#616163; color: #fff; border-top-left-radius:0px; border-top-right-radius:0px;">Total Viewership</div>
        <div class="panel-body">
          <div id="chart_div" style="height:400px;"></div>
        </div>
      </div>

    </div>

    <div class="col-md-6">
      <div class="panel panel-default" style="border-top-left-radius:0px; border-top-right-radius:0px; border-color:#616163 ">
        <div class="panel-heading" style="background-color:#616163; color: #fff; border-top-left-radius:0px; border-top-right-radius:0px;">
          My Products
          <a class="pull-right" style="color:#eee;" href="{{ route('product.index') }}">Show all</a>
        </div>
        

      <table class="table table-striped">
        <thead>
          <tr>
             <th>#</th>
             <th>Ticker</th>
             <th>Name</th>
             <th>Views</th>
          </tr>
        </thead>

        <tbody>

        @foreach ($products as $product)

          <tr>
            <td>{{ $loop->iteration }}.</td>
            <td><a href="{{ route('product.show', ['id' => $product->id]) }}">{{ $product->ticker }}</a></td>
            <td><a href="{{ route('product.show', ['id' => $product->id]) }}">{{ $product->name }}</a></td>
            <td>{{ number_format($product->view_count) }}</td>
          </tr>

        @endforeach
        </tbody>
      </table>
     </div>
    </div>

  </div>


  <div class="row">
    

    <div class="col-md-6">

      <div class="panel panel-default" style="border-top-left-radius:0px; border-top-right-radius:0px; border-color:#616163 ">
        <div class="panel-heading" style="background-color:#616163; color: #fff; border-top-left-radius:0px; border-top-right-radius:0px;">Types of Views</div>
        <div class="panel-body">
          <div id="piechart" style="height: 250px;"></div>
        </div>
      </div>

      <div class="panel panel-default" style="border-top-left-radius:0px; border-top-right-radius:0px; border-color:#616163 ">
        <div class="panel-heading" style="background-color:#616163; color: #fff; border-top-left-radius:0px; border-top-right-radius:0px;">Views by Country</div>
        <div class="panel-body">
          <div id="piechart2" style="height: 250px;"></div>
        </div>
      </div>

    </div>




    <div class="col-md-6">
      <div class="panel panel-default" style="border-top-left-radius:0px; border-top-right-radius:0px; border-color:#616163 ">
        <div class="panel-heading" style="background-color:#616163; color: #fff; border-top-left-radius:0px; border-top-right-radius:0px;">
          Views by Firm
          <a class="pull-right" style="color:#eee;" href="{{ route('firm.index') }}" >Show all</a>
        </div>

      <table class="table table-striped">
        <thead>
          <tr>
             <th>#</th>
             <th>Name</th>
             <th>Views</th>
          </tr>
        </thead>

        <tbody>

        @foreach ($firms as $firm)

          <tr>
            <td>{{ $loop->iteration }}.</td>
            <td><a href="{{ route('firm.show', ['id' => $firm->id]) }}">{{ $firm->name }}</a></td>
            <td>{{ number_format($firm->view_count) }}</td>
          </tr>

        @endforeach
        </tbody>
      </table>


     </div>
    </div>

  </div>


  <div class="col-md-4">

     


  </div>

 
</div>
<div class="col-md-1"></div>





@stop





