@extends('templates.homepage')

@section('content')

<div class="row" style="background-color:#dc5f13; margin-bottom:50px;">
    <h1 class="text-center" style="color:#fff; padding-top:20px; padding-bottom:20px;">Products</h1>
    <br/>
</div>

<div class="col-md-3 col-md-offset-1">

   <div class="panel panel-default">
     
       

       <div class="list-group">
      
         <div class="list-group-item"> <h4>Filter <span class="pull-right" style="font-weight:400;"> <small>Product Count</small></span></h4> 
          <a href="{{ route('product.index') }}"> Reset</a>
         </div> 
         
         <a href="#asset_classes" class="list-group-item" data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample"><strong>Asset Class</strong> <span class="glyphicon glyphicon-menu-down pull-right" aria-hidden="true"></span></a>
          
         <div class="collapse in" id="asset_classes">
          @foreach ($asset_classes as $asset_class => $value)
              <a class="list-group-item" style="padding-left:20px;" href="{!! route('product.index', ['asset_class' => $value->first()->asset_class_id]) !!}">
                {{ $asset_class }}
                <span class="badge">{{ number_format(count($value)) }}</span>
              </a>
              @endforeach
         </div> 

         <a href="#categories" class="list-group-item" data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample"><strong>Category</strong> <span class="glyphicon glyphicon-menu-down pull-right" aria-hidden="true"></span></a>
         <div class="collapse @if($request->has('asset_class') || $request->has('category') || $request->has('focus')) in @endif" id="categories">
          @foreach ($categories as $category => $value)
              <a class="list-group-item" style="padding-left:20px;" href="{!! route('product.index', ['category' => $value->first()->category_id]) !!}">
                {{ $category }}
                <span class="badge">{{ number_format(count($value)) }}</span>
              </a>
              @endforeach
         </div> 

         <a href="#focuses" class="list-group-item" data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample"><strong>Focus</strong> <span class="glyphicon glyphicon-menu-down pull-right" aria-hidden="true"></span></a>
          <div class="collapse @if($request->has('category') || $request->has('focus')) in @endif" id="focuses">
           @foreach ($focuses as $focus => $value)
               <a class="list-group-item" style="padding-left:20px;" href="{!! route('product.index', ['focus' => $value->first()->focus_id]) !!}">
                 {{ $focus }}
                 <span class="badge">{{ number_format(count($value)) }}</span>
               </a>
               @endforeach
          </div> 

       </div>

   </div>


</div>

  <div class="col-md-7">

    <div class="panel panel-default">
      <div class="panel-body">



        <table class="table table-hover" id="data_table">
            <thead>
                <tr>
                  <th></th>
                  <th><a href="{{ route('product.index', ['orderBy' => 'ticker', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">Ticker @if ($request->orderBy == 'ticker')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                  <th><a href="{{ route('product.index', ['orderBy' => 'name', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">Name @if ($request->orderBy == 'name')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                  <th><a href="{{ route('product.index', ['orderBy' => 'issuer.name', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">Issuer @if ($request->orderBy == 'issuer.name')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                  <th><a href="{{ route('product.index', ['orderBy' => 'views_count', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">Views @if ($request->orderBy == 'views_count')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>

                </tr>
            </thead>

            <tbody>
              @foreach ($products as $product)
              <tr>
                <td class="col-md-1">{{ $loop->iteration }}. </td>
                <td class="col-md-1"><a style="color:black;" href="{!! route('product.show', ['id' => $product->id]) !!}">{{ $product->ticker }}</a></td>
                <td class="col-md-6"><a style="color:black;" href="{!! route('product.show', ['id' => $product->id]) !!}">{{ $product->name }}</a></td>
                <td class="col-md-3"><a style="color:black;" href="{!! route('issuer.show', ['id' => $product->issuer->id]) !!}">{{ $product->issuer->name }}</a></td>
                <td class="col-md-1">{{ number_format($product->views_count) }}</td>

              </tr>
              @endforeach
            </tbody>


        </table>

       

        <p class="text-right"><a href="#">View Full Report</a></p>
      </div>
    </div>

    

  </div>
  <div class="col-md-1"></div>






@stop





