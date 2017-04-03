@extends('templates.default')

@section('content')


<div class="row" style="background-color:#dc5f13; margin-bottom:50px;">
    <h1 class="text-center" style="color:#fff; padding-top:20px; padding-bottom:20px;">{{ $firm->name }}</h1>
    <br/>
</div>


  <div class="col-md-7 col-md-offset-1">
  
    <div class="panel panel-default" style="border-top-left-radius:0px; border-top-right-radius:0px; border-color:#616163 ">
        <div class="panel-heading" style="background-color:#616163; color: #fff; border-top-left-radius:0px; border-top-right-radius:0px;">
          Viewed Products
          <a href="#products_all" class="pull-right" style="color:#eee;">Show all ({{ count($products) }})</a>
        </div>

        <table class="table table-hover" id="data_table">
            <thead>
                <tr>
                    <th></th>  
                    <th><a href="{{ route('product.index', ['orderBy' => 'ticker', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">Ticker @if ($request->orderBy == 'ticker')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                    <th><a href="{{ route('product.index', ['orderBy' => 'name', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">Name @if ($request->orderBy == 'name')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                    <th><a href="{{ route('product.index', ['orderBy' => 'issuers.name', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">Issuer @if ($request->orderBy == 'issuers.name')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                    <th><a href="{{ route('product.index', ['orderBy' => 'product_types.name', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}"># of Views @if ($request->orderBy == 'product_types.name')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span></a>@endif</th>
                    
                    
                                  </tr>
            </thead>

            <tbody>


            @foreach ($products->take(10) as $product)




                <tr>
                    <td class="col-md-1 text-left">{{ $loop->iteration }}.</td>
                    <td class="col-md-1 text-left"><a href="{{ route('product.show', ['id' => $product->product->id]) }}">{{ $product->product->ticker or 'n/a' }}</a></td>
                    <td class="col-md-5 "><a href="{{ route('product.show', ['id' => $product->product->id]) }}">{{ $product->product->name or 'n/a' }}</td>  
                    <td class="col-md-3 ">{{ $product->product->issuer->name or 'n/a' }}</td>  
                    <td class="col-md-2 ">{{ $product->view_count or 'n/a' }}</td>   
                </tr>
            @endforeach

            </tbody>


        </table>

    </div> 


    


    


    <div class="panel panel-default" style="border-top-left-radius:0px; border-top-right-radius:0px; border-color:#616163 ">
        <div class="panel-heading" style="background-color:#616163; color: #fff; border-top-left-radius:0px; border-top-right-radius:0px;">
          Users
          <a href="#users_all" class="pull-right" style="color:#eee;">Show all ({{ count($users) }})</a>
        </div>

        <table class="table table-hover" id="data_table">
            <thead>
                <tr>
                    <th></th>  
                    <th><a href="{{ route('product.index', ['orderBy' => 'ticker', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">City @if ($request->orderBy == 'ticker')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                    <th><a href="{{ route('product.index', ['orderBy' => 'name', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">State @if ($request->orderBy == 'name')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                    <th><a href="{{ route('product.index', ['orderBy' => 'issuers.name', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">Country @if ($request->orderBy == 'issuers.name')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                    <th><a href="{{ route('product.index', ['orderBy' => 'product_types.name', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}"># of Views @if ($request->orderBy == 'product_types.name')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span></a>@endif</th>
                    
                    
                                  </tr>
            </thead>

            <tbody>


            @foreach ($users->take(10) as $user)




                <tr>
                    <td class="col-md-1 text-left">{{ $loop->iteration }}.</td>
                    <td class="col-md-4 text-left">{{ $user->city or 'n/a' }}</td>
                    <td class="col-md-2 ">{{ $user->state or 'n/a' }}</td>  
                    <td class="col-md-3 ">{{ $user->country->code or 'n/a' }}</td>  
                    <td class="col-md-2 ">{{ $user->views_count or 'n/a' }}</td>   
                </tr>
            @endforeach

            </tbody>


        </table>

    </div> 





  <div class="panel panel-default" style="border-top-left-radius:0px; border-top-right-radius:0px; border-color:#616163 ">
      <div class="panel-heading" style="background-color:#616163; color: #fff; border-top-left-radius:0px; border-top-right-radius:0px;">
        Cities
        <a href="#cities_all" class="pull-right" style="color:#eee;">Show all ({{ count($users_by_city) }})</a>
      </div>

      <table class="table table-hover" id="data_table">
          <thead>
              <tr>
                  <th></th>  
                  <th><a href="{{ route('product.index', ['orderBy' => 'ticker', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">City @if ($request->orderBy == 'ticker')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                  <th><a href="{{ route('product.index', ['orderBy' => 'name', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">State @if ($request->orderBy == 'name')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                  <th><a href="{{ route('product.index', ['orderBy' => 'name', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">Country @if ($request->orderBy == 'name')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                  <th><a href="{{ route('product.index', ['orderBy' => 'issuers.name', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}"># of Users @if ($request->orderBy == 'issuers.name')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                  
                  
                                </tr>
          </thead>

          <tbody>


          @foreach ($users_by_city->take(10) as $user)




              <tr>
                  <td class="col-md-1 text-left">{{ $loop->iteration }}.</td>
                  <td class="col-md-4 text-left">{{ $user->city or 'n/a' }}</td>
                  <td class="col-md-3 ">{{ $user->state or 'n/a' }}</td>  
                  <td class="col-md-2 ">{{ $user->country->code or 'n/a' }}</td>  
                  <td class="col-md-2 ">{{ $user->user_count or 'n/a' }}</td>  
                  
              </tr>
          @endforeach

          </tbody>


      </table>

  </div>


  <div id="products_all" class="panel panel-default" style="border-top-left-radius:0px; border-top-right-radius:0px; border-color:#616163 ">
        <div class="panel-heading" style="background-color:#616163; color: #fff; border-top-left-radius:0px; border-top-right-radius:0px;">
          Viewed Products (All)
          
        </div>

        <table class="table table-hover" id="data_table">
            <thead>
                <tr>
                    <th></th>  
                    <th><a href="{{ route('product.index', ['orderBy' => 'ticker', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">Ticker @if ($request->orderBy == 'ticker')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                    <th><a href="{{ route('product.index', ['orderBy' => 'name', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">Name @if ($request->orderBy == 'name')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                    <th><a href="{{ route('product.index', ['orderBy' => 'issuers.name', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">Issuer @if ($request->orderBy == 'issuers.name')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                    <th><a href="{{ route('product.index', ['orderBy' => 'product_types.name', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}"># of Views @if ($request->orderBy == 'product_types.name')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span></a>@endif</th>
                    
                    
                                  </tr>
            </thead>

            <tbody>


            @foreach ($products as $product)




                <tr>
                    <td class="col-md-1 text-left">{{ $loop->iteration }}.</td>
                    <td class="col-md-1"><a href="{{ route('product.show', ['id' => $product->product->id]) }}">{{ $product->product->ticker }}</a></td>
                    <td class="col-md-5"><a href="{{ route('product.show', ['id' => $product->product->id]) }}">{{ $product->product->name }}</a></td>
                    <td class="col-md-3 ">{{ $product->product->issuer->name or 'n/a' }}</td>  
                    <td class="col-md-2 ">{{ $product->view_count or 'n/a' }}</td>   
                </tr>
            @endforeach

            </tbody>


        </table>

    </div> 



  <div id="users_all" class="panel panel-default" style="border-top-left-radius:0px; border-top-right-radius:0px; border-color:#616163 ">
      <div class="panel-heading" style="background-color:#616163; color: #fff; border-top-left-radius:0px; border-top-right-radius:0px;">
        Users (All)
        <a href="#users_all" class="pull-right" style="color:#eee;">Show all</a>
      </div>

      <table class="table table-hover" id="data_table">
          <thead>
              <tr>
                  <th></th>  
                  <th><a href="{{ route('product.index', ['orderBy' => 'ticker', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">City @if ($request->orderBy == 'ticker')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                  <th><a href="{{ route('product.index', ['orderBy' => 'name', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">State @if ($request->orderBy == 'name')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                  <th><a href="{{ route('product.index', ['orderBy' => 'issuers.name', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">Country @if ($request->orderBy == 'issuers.name')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                  <th><a href="{{ route('product.index', ['orderBy' => 'product_types.name', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}"># of Views @if ($request->orderBy == 'product_types.name')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span></a>@endif</th>
                  
                  
                                </tr>
          </thead>

          <tbody>


          @foreach ($users as $user)




              <tr>
                  <td class="col-md-1 text-left">{{ $loop->iteration }}.</td>
                  <td class="col-md-4 text-left">{{ $user->city or 'n/a' }}</td>
                  <td class="col-md-2 ">{{ $user->state or 'n/a' }}</td>  
                  <td class="col-md-3 ">{{ $user->country->code or 'n/a' }}</td>  
                  <td class="col-md-2 ">{{ $user->views_count or 'n/a' }}</td>   
              </tr>
          @endforeach

          </tbody>


      </table>

  </div> 


  
  <div id="cities_all" class="panel panel-default" style="border-top-left-radius:0px; border-top-right-radius:0px; border-color:#616163 ">
      <div class="panel-heading" style="background-color:#616163; color: #fff; border-top-left-radius:0px; border-top-right-radius:0px;">
        Cities (All)
       
      </div>

      <table class="table table-hover" id="data_table">
          <thead>
              <tr>
                  <th></th>  
                  <th><a href="{{ route('product.index', ['orderBy' => 'ticker', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">City @if ($request->orderBy == 'ticker')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                  <th><a href="{{ route('product.index', ['orderBy' => 'name', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">State @if ($request->orderBy == 'name')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                  <th><a href="{{ route('product.index', ['orderBy' => 'name', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">Country @if ($request->orderBy == 'name')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                  <th><a href="{{ route('product.index', ['orderBy' => 'issuers.name', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}"># of Users @if ($request->orderBy == 'issuers.name')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                  
                  
                                </tr>
          </thead>

          <tbody>


          @foreach ($users_by_city as $user)




              <tr>
                  <td class="col-md-1 text-left">{{ $loop->iteration }}.</td>
                  <td class="col-md-4 text-left">{{ $user->city or 'n/a' }}</td>
                  <td class="col-md-3 ">{{ $user->state or 'n/a' }}</td>  
                  <td class="col-md-2 ">{{ $user->country->code or 'n/a' }}</td>  
                  <td class="col-md-2 ">{{ $user->user_count or 'n/a' }}</td>  
                  
              </tr>
          @endforeach

          </tbody>


      </table>

  </div>

  <div id ="categories_all" class="panel panel-default" style="border-top-left-radius:0px; border-top-right-radius:0px; border-color:#616163 ">
        <div class="panel-heading" style="background-color:#616163; color: #fff; border-top-left-radius:0px; border-top-right-radius:0px;">
          Categories (All)
        </div>

        <table class="table table-hover" id="data_table">
            <thead>
                <tr>
                    <th></th>  
                    <th><a href="{{ route('product.index', ['orderBy' => 'ticker', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">Name @if ($request->orderBy == 'ticker')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                    <th><a href="{{ route('product.index', ['orderBy' => 'name', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">Asset Class @if ($request->orderBy == 'name')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                    <th><a href="{{ route('product.index', ['orderBy' => 'name', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}"># of Views @if ($request->orderBy == 'name')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                    
                                  </tr>
            </thead>

            <tbody>


            @foreach ($views_by_category as $category)




                <tr>
                    <td class="col-md-1 text-left">{{ $loop->iteration }}.</td>
                    <td class="col-md-6 text-left">{{ $category->name or 'n/a' }}</td>
                    <td class="col-md-3 ">{{ $category->assetClass->name }}</td>  
                    <td class="col-md-2 ">{{ $category->views_count or 'n/a' }}</td>  
                    
                </tr>
            @endforeach

            </tbody>


        </table>

    </div> 


    <div id="focuses_all" class="panel panel-default" style="border-top-left-radius:0px; border-top-right-radius:0px; border-color:#616163 ">
        <div class="panel-heading" style="background-color:#616163; color: #fff; border-top-left-radius:0px; border-top-right-radius:0px;">
          Focuses (All)
          
        </div>

        <table class="table table-hover" id="data_table">
            <thead>
                <tr>
                    <th></th>  
                    <th><a href="{{ route('product.index', ['orderBy' => 'ticker', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">Name @if ($request->orderBy == 'ticker')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                    <th><a href="{{ route('product.index', ['orderBy' => 'ticker', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">Cateogry @if ($request->orderBy == 'ticker')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                    
                    <th><a href="{{ route('product.index', ['orderBy' => 'name', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}"># of Views @if ($request->orderBy == 'name')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                    
                                  </tr>
            </thead>

            <tbody>


            @foreach ($views_by_focus as $focus)




                <tr>
                    <td class="col-md-1 text-left">{{ $loop->iteration }}.</td>
                    <td class="col-md-6 text-left">{{ $focus->name or 'n/a' }}</td>
                    <td class="col-md-3 text-left">{{ $focus->category->name or 'n/a' }}</td>

                    
                    <td class="col-md-2 ">{{ $focus->views_count or 'n/a' }}</td>  
                    
                </tr>
            @endforeach

            </tbody>


        </table>

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
                    <th><a href="{{ route('product.index', ['orderBy' => 'product_types.name', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">Address @if ($request->orderBy == 'product_types.name')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span></a>@endif</th>
                    <th><a href="{{ route('product.index', ['orderBy' => 'product_categories.name', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">City @if ($request->orderBy == 'product_categories.name')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                    <th><a href="{{ route('product.index', ['orderBy' => 'product_focuses.name', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">State @if ($request->orderBy == 'product_focuses.name')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                    <th><a href="{{ route('product.index', ['orderBy' => 'product_types.name', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">Country @if ($request->orderBy == 'product_types.name')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span></a>@endif</th>
                    
                                  </tr>
            </thead>

            <tbody>


            @foreach ($views as $view)




                <tr>
                    <td class="col-md-1 text-left">{{ $loop->iteration }}.</td>
                    <td class="col-md-1 text-left">{{ $view->product->ticker or 'n/a' }}</td>
                    <td class="col-md-1 ">{{ $view->product->name or 'n/a' }}</td>  
                    <td class="col-md-1 ">{{ $view->product->issuer->name or 'n/a' }}</td>  
                    <td class="col-md-1 ">{{ $view->user->address or 'n/a' }}</td>  
                    <td class="col-md-1 ">{{ $view->user->city or 'n/a' }}</td>  
                    <td class="col-md-1 ">{{ $view->user->state or 'n/a' }}</td> 
                    <td class="col-md-1 ">{{ $view->user->country->code or 'n/a' }}</td>  
                </tr>
            @endforeach

            </tbody>


        </table>



        <div class="text-center">{{ $views->appends(['q' => $request->q, 'orderBy' => $request->orderBy, 'sort' => $request->sort])->links() }}</div>


        <p class="text-right"><a href="#">View Full Report</a></p>
      </div>
    </div>

    <div class="panel panel-default">
      <div class="panel-body text-center">
        Showing <strong>Page {{$views->currentPage()}} </strong> of <strong>{{ $views->lastPage() }}</strong> - <strong>{{ number_format($views->total()) }}</strong> results (<strong>{{ $views->perPage() }}</strong> per page)
      </div>
    </div>

    <div class="panel panel-default">
      <div class="panel-body">

        <h1>products viewed</h1>

        

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

  <div class="col-md-3">

  <div class="panel panel-default" style="border-top-left-radius:0px; border-top-right-radius:0px; border-color:#616163 ">
      <div class="panel-heading" style="background-color:#616163; color: #fff; border-top-left-radius:0px; border-top-right-radius:0px;">
        Info
      </div>

        <table class="table">
          <tbody>
            <tr>
              <td class="col-md-6 text-right"><strong>Products Viewed</strong></td>
              <td class="col-md-6 text-left">{{ count($products) }}</td>
            </tr>
             <tr>
              <td class="col-md-6 text-right"><strong>Total Views</strong></td>
              <td class="col-md-6 text-left">{{ $firm->views_count }}</td>
            </tr>
            <tr>
              <td class="col-md-6 text-right"><strong>Users</strong></td>
              <td class="col-md-6 text-left">{{ count($users) }}</td>
            </tr>
            <tr>
              <td class="col-md-6 text-right"><strong>Cities</strong></td>
              <td class="col-md-6 text-left">{{ count($users_by_city) }}</td>
            </tr>
          </tbody>
        </table>



  <div class="panel-body">
            @foreach ( $street_address as $address )
              <img src="https://maps.googleapis.com/maps/api/staticmap?center={{ $address->address }} {{ $address->city }}, {{ $address->state }} {{ $address->zip }} {{ $address->country->name }}&zoom=12&size=300x300&key=AIzaSyCPTIOUq7u4XAHqIdiQ7scZuugZ8AE8VDM
      " alt="">
      <hr/>
              {{ $address->address }} <br/>{{ $address->city }}, {{ $address->state }} {{ $address->zip }} <br/>{{ $address->country->name }}
            @endforeach

  </div>
      

      
  </div> 




    
    <div class="panel panel-default" style="border-top-left-radius:0px; border-top-right-radius:0px; border-color:#616163 ">
        <div class="panel-heading" style="background-color:#616163; color: #fff; border-top-left-radius:0px; border-top-right-radius:0px;">
          Asset Classes
        </div>

        <table class="table table-hover" id="data_table">
            <thead>
                <tr>
                    <th></th>  
                    <th><a href="{{ route('product.index', ['orderBy' => 'ticker', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">Name @if ($request->orderBy == 'ticker')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                    <th><a href="{{ route('product.index', ['orderBy' => 'name', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}"># of Views @if ($request->orderBy == 'name')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                    
                                  </tr>
            </thead>

            <tbody>


            @foreach ($views_by_asset_class as $asset_class)




                <tr>
                    <td class="col-md-1 text-left">{{ $loop->iteration }}.</td>
                    <td class="col-md-7 text-left">{{ $asset_class->name or 'n/a' }}</td>
                    <td class="col-md-4 ">{{ $asset_class->views_count or 'n/a' }}</td>  
                    
                </tr>
            @endforeach

            </tbody>


        </table>

    </div> 

    <div class="panel panel-default" style="border-top-left-radius:0px; border-top-right-radius:0px; border-color:#616163 ">
        <div class="panel-heading" style="background-color:#616163; color: #fff; border-top-left-radius:0px; border-top-right-radius:0px;">
          Categories
          <a href="#categories_all" class="pull-right" style="color:#eee;">Show all ({{ count($views_by_category) }})</a>
        </div>

        <table class="table table-hover" id="data_table">
            <thead>
                <tr>
                    <th></th>  
                    <th><a href="{{ route('product.index', ['orderBy' => 'ticker', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">Name @if ($request->orderBy == 'ticker')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                    
                    <th><a href="{{ route('product.index', ['orderBy' => 'name', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}"># of Views @if ($request->orderBy == 'name')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                    
                                  </tr>
            </thead>

            <tbody>


            @foreach ($views_by_category->take(10) as $category)




                <tr>
                    <td class="col-md-1 text-left">{{ $loop->iteration }}.</td>
                    <td class="col-md-6 text-left">{{ $category->name or 'n/a' }}</td>
                    
                    <td class="col-md-4 ">{{ $category->views_count or 'n/a' }}</td>  
                    
                </tr>
            @endforeach

            </tbody>


        </table>

    </div> 

    <div class="panel panel-default" style="border-top-left-radius:0px; border-top-right-radius:0px; border-color:#616163 ">
        <div class="panel-heading" style="background-color:#616163; color: #fff; border-top-left-radius:0px; border-top-right-radius:0px;">
          Focuses
          <a href="#focuses_all" class="pull-right" style="color:#eee;">Show all ({{ count($views_by_focus) }})</a>
        </div>

        <table class="table table-hover" id="data_table">
            <thead>
                <tr>
                    <th></th>  
                    <th><a href="{{ route('product.index', ['orderBy' => 'ticker', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">Name @if ($request->orderBy == 'ticker')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                    
                    <th><a href="{{ route('product.index', ['orderBy' => 'name', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}"># of Views @if ($request->orderBy == 'name')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                    
                                  </tr>
            </thead>

            <tbody>


            @foreach ($views_by_focus->take(10) as $focus)




                <tr>
                    <td class="col-md-1 text-left">{{ $loop->iteration }}.</td>
                    <td class="col-md-6 text-left">{{ $focus->name or 'n/a' }}</td>
                    
                    <td class="col-md-4 ">{{ $focus->views_count or 'n/a' }}</td>  
                    
                </tr>
            @endforeach

            </tbody>


        </table>

    </div> 


  

    <div class="panel panel-default" style="border-top-left-radius:0px; border-top-right-radius:0px; border-color:#616163 ">
        <div class="panel-heading" style="background-color:#616163; color: #fff; border-top-left-radius:0px; border-top-right-radius:0px;">
          Product Types
        </div>

        <table class="table table-hover" id="data_table">
            <thead>
                <tr>
                    <th></th>  
                    <th><a href="{{ route('product.index', ['orderBy' => 'ticker', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">Name @if ($request->orderBy == 'ticker')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                    
                    <th><a href="{{ route('product.index', ['orderBy' => 'name', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}"># of Views @if ($request->orderBy == 'name')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                    
                                  </tr>
            </thead>

            <tbody>


            @foreach ($views_by_product_type as $type)




                <tr>
                    <td class="col-md-1 text-left">{{ $loop->iteration }}.</td>
                    <td class="col-md-6 text-left">{{ $type->name or 'n/a' }}</td>
                    
                    <td class="col-md-4 ">{{ $type->views_count or 'n/a' }}</td>  
                    
                </tr>
            @endforeach

            </tbody>


        </table>

    </div> 



  </div>
  <div class="col-md-1"></div>






@stop





