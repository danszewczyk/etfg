@extends('templates.default')

@section('content')



  <div class="col-md-7">
   

    <div class="panel panel-default">

      <div class="panel-body text-center">
        <h3>Issuer: {{ $issuer->name }}</h3>
        <h5>Total Views: {{ number_format($issuer->views_count) }}</h5>
        Showing <strong>Page {{$rows->currentPage()}} </strong> of <strong>{{ $rows->lastPage() }}</strong> with <strong>{{ number_format($rows->total()) }}</strong> results (<strong>{{ $rows->perPage() }}</strong> per page) from <strong>1</strong> issuer
      </div>
    </div>

    


    



    <div class="panel panel-default">
      <div class="panel-body">



        <table class="table table-hover" id="data_table">
            <thead>
                <tr>
                    <th></th>  
                    <th><a href="{{ route('issuer.show', ['id' => $issuer->id, 'orderBy' => 'ticker', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">Ticker @if ($request->orderBy == 'ticker')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                    <th><a href="{{ route('issuer.show', ['id' => $issuer->id, 'orderBy' => 'name', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">Name @if ($request->orderBy == 'name')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                    <th><a href="{{ route('issuer.show', ['id' => $issuer->id, 'orderBy' => 'asset_classes.name', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">Asset Class @if ($request->orderBy == 'asset_classes.name')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                    <th><a href="{{ route('issuer.show', ['id' => $issuer->id, 'orderBy' => 'product_categories.name', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">Category @if ($request->orderBy == 'product_categories.name')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                    <th><a href="{{ route('issuer.show', ['id' => $issuer->id, 'orderBy' => 'product_focuses.name', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">Focus @if ($request->orderBy == 'product_focuses.name')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                    <th><a href="{{ route('issuer.show', ['id' => $issuer->id, 'orderBy' => 'product_types.name', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">Type @if ($request->orderBy == 'product_types.name')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span></a>@endif</th>
                    <th><a href="{{ route('issuer.show', ['id' => $issuer->id, 'orderBy' => 'views_count', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">Views @if ($request->orderBy == 'views_count')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span></a>@endif</th>
                                  </tr>
            </thead>

            <tbody>

            @foreach ($rows as $row)

                <tr>
                    <td class="col-md-1 text-left">{{ $rows->firstItem() + $loop->index }}.</td>
                    <td class="col-md-1 text-left"><a href="{!! route('product.show', ['id' => $row->id]) !!}">{{ $row->ticker }}</td>
                    <td class="col-md-1 ">{{ $row->name }}</td>  
                    <td class="col-md-1 ">{{ $row->assetClass->name or 'n/a' }}</td>  
                    <td class="col-md-1 ">{{ $row->category->name or 'n/a' }}</td>  
                    <td class="col-md-1 ">{{ $row->focus->name or 'n/a' }}</td>  
                    <td class="col-md-1 ">{{ $row->type->name or 'n/a' }}</td> 
                    <td class="col-md-1 ">{{ number_format($row->views_count) }}</td>  
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





