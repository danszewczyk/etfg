@extends('templates.homepage')

@section('content')

<div class="row">
  <div class="col-md-2"></div>
  <div class="col-md-10">
    <h1>Searching for <i>{{ $request->get('q') }}</i></h1><Br/>
  </div>
</div>

<div class="col-md-1"></div>
<div class="col-md-3">

   <div class="panel panel-default">
     
       

       <div class="list-group">
      
         <div class="list-group-item"> <h4>Products</h4> </div>

         @foreach ($products as $product) 
          <a href="{{ route('product.show', ['id' => $product->id]) }}" class="list-group-item">
              <h4 class="list-group-item-heading">{{ $product->ticker }}</h4>
              <p class="list-group-item-text">{{ $product->name }}</p>
            </a>
          @endforeach

         

       </div>

   </div>


</div>
<div class="col-md-3">

   <div class="panel panel-default">
     
       

       <div class="list-group">
      
         <div class="list-group-item"> <h4>Issuers</h4> </div> 
         
         @foreach ($issuers as $issuer) 
          <a href="{{ route('issuer.show', ['id' => $issuer->id]) }}" class="list-group-item">
              <h4 class="list-group-item-heading">{{ $issuer->name }}</h4>
              
            </a>
          @endforeach
         

       </div>

   </div>


</div>
<div class="col-md-3">

   <div class="panel panel-default">
     
       

       <div class="list-group">
      
         <div class="list-group-item"> <h4>Firms</h4> </div> 
         
         @foreach ($firms as $firm) 
          <a href="{{ route('firm.show', ['id' => $firm->id]) }}" class="list-group-item">
              <h4 class="list-group-item-heading">{{ $firm->name }}</h4>
              
            </a>
          @endforeach
         
         

       </div>

   </div>


</div>

<div class="col-md-1"></div>






@stop





