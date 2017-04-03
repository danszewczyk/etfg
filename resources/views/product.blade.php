@extends('templates.default')

@section('content')

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Issuer', 'Products'],
@foreach ($issuers as $issuer)
          ['{{ $issuer->name }}', {{ $issuer->products_count }}],
@endforeach
        ]);

        var options = {
          sliceVisibilityThreshold: 0.02,
          legend: 'none',
          chartArea: {top: 10}

        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));


        var data2 = google.visualization.arrayToDataTable([
          ['Asset Class', 'Products'],
@foreach ($asset_classes as $asset_class)
          ['{{ $asset_class->name }}', {{ $asset_class->products_count }}],
@endforeach
        ]);

        var options2 = {
          sliceVisibilityThreshold: 0.02,
          legend: 'none',
          chartArea: {top: 10}

        };

        var chart2 = new google.visualization.PieChart(document.getElementById('piechart2'));

        var data3 = google.visualization.arrayToDataTable([
          ['Product Types', 'Products'],
@foreach ($product_types as $product_type)
          ['{{ $product_type->name }}', {{ $product_type->products_count }}],
@endforeach
        ]);

        var options3 = {
          sliceVisibilityThreshold: 0.02,
          legend: 'none',
          chartArea: {top: 10}

        };

        var chart3 = new google.visualization.PieChart(document.getElementById('piechart3'));


        chart.draw(data, options);
        chart2.draw(data2, options2);
        chart3.draw(data3, options3);
      }
    </script>

  <div class="col-md-10">
    
    </div>

    <div class="panel panel-default">
      <div class="panel-body text-center">
        Showing <strong>Page {{$rows->currentPage()}} </strong> of <strong>{{ $rows->lastPage() }}</strong> with <strong>{{ number_format($rows->total()) }}</strong> results (<strong>{{ $rows->perPage() }}</strong> per page) from <strong>{{ $issuers->count() }}</strong> issuers, <strong>{{ $asset_classes->count() }}</strong> Asset Classes, and <strong>{{ $product_types->count() }}</strong> Product Types.
      </div>
    </div>

    


    



    <div class="panel panel-default">
      <div class="panel-body">



        <table class="table table-hover" id="data_table">
            <thead>
                <tr>
                    <th></th>  
                    <th><a href="{{ route('product.index', ['orderBy' => 'ticker', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">Ticker @if ($request->orderBy == 'ticker')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                    <th><a href="{{ route('product.index', ['orderBy' => 'name', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">Name @if ($request->orderBy == 'name')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                    <th><a href="{{ route('product.index', ['orderBy' => 'issuers.name', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">Issuer @if ($request->orderBy == 'issuers.name')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                    <th><a href="{{ route('product.index', ['orderBy' => 'asset_classes.name', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">Asset Class @if ($request->orderBy == 'asset_classes.name')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                    <th><a href="{{ route('product.index', ['orderBy' => 'product_categories.name', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">Category @if ($request->orderBy == 'product_categories.name')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                    <th><a href="{{ route('product.index', ['orderBy' => 'product_focuses.name', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">Focus @if ($request->orderBy == 'product_focuses.name')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                    <th><a href="{{ route('product.index', ['orderBy' => 'product_types.name', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">Type @if ($request->orderBy == 'product_types.name')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span></a>@endif</th>
                    <th><a href="{{ route('product.index', ['orderBy' => 'views_count', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">Views @if ($request->orderBy == 'views_count')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span></a>@endif</th>
                                  </tr>
            </thead>

            <tbody>

            @foreach ($rows as $row)

                <tr>
                    <td class="col-md-1 text-left">{{ $rows->firstItem() + $loop->index }}.</td>
                    <td class="col-md-1 text-left"><a href="{!! route('product.show', ['id' => $row->id]) !!}">{{ $row->ticker }}</td>
                    <td class="col-md-1 "><a href="{!! route('product.show', ['id' => $row->id]) !!}">{{ $row->name }}</a></td>  
                    <td class="col-md-1 "><a href="{!! route('issuer.show', ['id' => $row->issuer->id]) !!}">{{ $row->issuer->name }}<a/></td>  
                    <td class="col-md-1 "><a href="{!! route('assetClass.show', ['id' => $row->assetClass->id]) !!}">{{ $row->assetClass->name or 'n/a' }}</a></td>  
                    <td class="col-md-1 ">{{ $row->category->name or 'n/a' }}</td>  
                    <td class="col-md-1 ">{{ $row->focus->name or 'n/a' }}</td>  
                    <td class="col-md-1 ">{{ $row->type->name or 'n/a' }}</td> 
                    <td class="col-md-1 ">{{ $row->views_count or 'n/a' }}</td>  
                </tr>
            @endforeach

            </tbody>


        </table>



        <div class="text-center">{{ $rows->appends(['q' => $request->q, 'orderBy' => $request->orderBy, 'sort' => $request->sort])->links() }}</div>


        <p class="text-right"><a href="#">View Full Report</a></p>
      </div>
    </div>

    <div class="panel panel-default">
      <div class="panel-body">

          <div class="row">

            <div class="col-md-4">
              <h5 class="text-center">Issuers</h5>
              <div id="piechart" style="height: 250px;"></div>

            </div>
            
            <div class="col-md-4">
              <h5 class="text-center">Asset Classes</h5>
              <div id="piechart2" style="height: 250px;"></div>
            </div>

            <div class="col-md-4">
              <h5 class="text-center">Product Types</h5>
              <div id="piechart3" style="height: 250px;"></div>
            </div>


          </div>

      </div>
    </div>


  </div>
  <div class="col-md-1"></div>






@stop





