@extends('templates.default')

@section('content')

<div class="row" style="background-color:#dc5f13; margin-bottom:50px;">
    <h1 class="text-center" style="color:#fff; padding-top:20px; padding-bottom:20px;">Asset Classes</h1>
    <br/>
</div>

<div class="row">
    

  <div class="col-md-7 col-md-offset-1">

    
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

            @foreach ($asset_classes as $asset_class)

                <tr>
                    <td class="col-md-1 text-left">{{ $asset_classes->firstItem() + $loop->index }}.</td>
                    <td class="col-md-6 text-left"><a href="{!! route('assetClass.show', ['id' => $asset_class->id]) !!}">{{ $asset_class->name }}</td>
                    <td class="col-md-2 text-right">{{ $asset_class->products_count }}</td> 
                    <td class="col-md-2 text-right">{{ number_format($asset_class->views_count) }}</td>   
                   
                </tr>
            @endforeach

            </tbody>


        </table>



        <div class="text-center">{{ $asset_classes->links() }}</div>


        <p class="text-right"><a href="#">View Full Report</a></p>
      </div>
    </div>

  </div>
  </div>







@stop





