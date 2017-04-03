@extends('templates.default')

@section('content')



  <div class="col-md-7">
    
   

    <div class="panel panel-default">



      <div class="panel-body text-center">
        <h3>Country: {{ $country->name }}</h3>
        Showing <strong>Page {{$rows->currentPage()}} </strong> of <strong>{{ $rows->lastPage() }}</strong> with <strong>{{ number_format($rows->total()) }}</strong> results (<strong>{{ $rows->perPage() }}</strong> per page) from <strong>1</strong> firm
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
                    <th><a href="{{ route('product.index', ['orderBy' => 'product_categories.name', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">Category @if ($request->orderBy == 'product_categories.name')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                    <th><a href="{{ route('product.index', ['orderBy' => 'product_focuses.name', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">Focus @if ($request->orderBy == 'product_focuses.name')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                    <th><a href="{{ route('product.index', ['orderBy' => 'product_types.name', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">Type @if ($request->orderBy == 'product_types.name')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span></a>@endif</th>
                    
                                  </tr>
            </thead>

            <tbody>

            @foreach ($rows as $row)


                <tr>
                    <td class="col-md-1 text-left">{{ $rows->firstItem() + $loop->index }}.</td>
                    <td class="col-md-1 text-left">{{ $row->product->ticker or 'n/a' }}</td>
                    <td class="col-md-1 ">{{ $row->product->name or 'n/a' }}</td>  
                    <td class="col-md-1 ">{{ $row->product->issuer->name or 'n/a' }}</td>  
                    <td class="col-md-1 ">{{ $row->product->category->name or 'n/a' }}</td>  
                    <td class="col-md-1 ">{{ $row->product->focus->name or 'n/a' }}</td>  
                    <td class="col-md-1 ">{{ $row->product->type->name or 'n/a' }}</td> 

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





