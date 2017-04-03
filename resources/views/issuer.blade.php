@extends('templates.default')

@section('content')

<div class="row" style="background-color:#dc5f13; margin-bottom:50px;">
    <h1 class="text-center" style="color:#fff">Issuers</h1>
    <br/>
</div>

<div class="row">
  


  <div class="col-md-7 col-md-offset-1">
    

    <div class="panel panel-default">
      <div class="panel-body text-center">
        Showing <strong>Page {{$issuers->currentPage()}} </strong> of <strong>{{ $issuers->lastPage() }}</strong> with <strong>{{ number_format($issuers->total()) }}</strong> results (<strong>{{ $issuers->perPage() }}</strong> per page)
      </div>
    </div>

    


    



    <div class="panel panel-default">
      <div class="panel-body">



        <table class="table table-hover" id="data_table">
            <thead>
                <tr>
                    <th></th>  
                    <th>Name </th>
                    <th class="text-right"># of Products </th>
                    <th class="text-right"># of Views </th>
                    
                </tr>
            </thead>

            <tbody>

            @foreach ($issuers as $issuer)

                <tr>
                    <td class="col-md-1 text-left">{{ $issuers->firstItem() + $loop->index }}.</td>
                    <td class="col-md-7 text-left"><a href="{!! route('issuer.show', ['id' => $issuer->id]) !!}">{{ $issuer->name }}</td>
                    <td class="col-md-2 text-right">{{ $issuer->products_count }}</td>  
                    <td class="col-md-2 text-right">{{ number_format($issuer->views_count) }}</td>  
                   
                </tr>
            @endforeach

            </tbody>


        </table>



        <div class="text-center">{{ $issuers->appends(['q' => $request->q, 'orderBy' => $request->orderBy, 'sort' => $request->sort])->links() }}</div>


        <p class="text-right"><a href="#">View Full Report</a></p>
      </div>
    </div>

  </div>


</div>




@stop





