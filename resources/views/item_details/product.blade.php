@extends('templates.default')

@section('content')

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
          google.charts.load('current', {'packages':['corechart']});
          google.charts.setOnLoadCallback(drawChart);
          function drawChart() {

            var data = google.visualization.arrayToDataTable([
              ['Country', 'Views'],
    @foreach ($countries as $country)
              ['{{ $country->name }}', {{ $country->views_count }}],
    @endforeach
            ]);

            var options = {
              sliceVisibilityThreshold: 0.02,
          chartArea: {top: 20, left:10, right:10, bottom:15}

            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));


            var data2 = google.visualization.arrayToDataTable([
              ['Firms', 'Views'],
    @foreach ($firms as $firm)
              ['{{ $firm->name }}', {{ $firm->views_count }}],
    @endforeach
            ]);

            var options2 = {
              sliceVisibilityThreshold: 0.02,
          chartArea: {top: 20, left:10, right:10, bottom:15}

            };

            var chart2 = new google.visualization.PieChart(document.getElementById('piechart2'));

            var data3 = google.visualization.arrayToDataTable([
              ['Firms', 'Views'],
    @foreach ($views_by_type as $type)
              ['{{ $type->name }}', {{ $type->views_count }}],
    @endforeach
            ]);

            var options3 = {
              sliceVisibilityThreshold: 0.02,
          chartArea: {top: 20, left:10, right:10, bottom:15}

            };

            var chart3 = new google.visualization.PieChart(document.getElementById('piechart3'));

            chart.draw(data, options);
            chart2.draw(data2, options2);
            chart3.draw(data3, options3);
          }
    </script>


<div class="row" style="background-color:#dc5f13; margin-bottom:50px;">
    <h1 class="text-center" style="color:#fff; margin-bottom: -15px;">{{ $product->name }}</h1>
    <h3 class="text-center" style="color:#fff">{{ $product->ticker }} ({{ $product->issuer->name }})</h3>
    <br/>
</div>

  <div class="col-md-7 col-md-offset-1">

      <div class="panel panel-default" style="border-top-left-radius:0px; border-top-right-radius:0px; border-color:#616163 ">
        <div class="panel-heading" style="background-color:#616163; color: #fff; border-top-left-radius:0px; border-top-right-radius:0px;">
          Views by Firm
          <a href="#firms_all" class="pull-right" style="color:#eee;">Show all ({{ count($firms) }})</a>
        </div>
        
        <div class="panel-body">
          <div id="piechart2" style="height: 250px;"></div>
        </div>
      </div>


      <div class="panel panel-default" style="border-top-left-radius:0px; border-top-right-radius:0px; border-color:#616163 ">
        <div class="panel-heading" style="background-color:#616163; color: #fff; border-top-left-radius:0px; border-top-right-radius:0px;">
          Views by User Action
        </div>
        <div class="panel-body">
          <div id="piechart3" style="height: 250px;"></div>
        </div>
      </div>



    <div class="panel panel-default" style="border-top-left-radius:0px; border-top-right-radius:0px; border-color:#616163 ">
        <div class="panel-heading" style="background-color:#616163; color: #fff; border-top-left-radius:0px; border-top-right-radius:0px;">
          Views by Country
          <a href="#countries_all" class="pull-right" style="color:#eee;">Show all ({{ count($countries) }})</a>
        </div>
        <div class="panel-body">
          <div id="piechart" style="height: 250px;"></div>
        </div>
      </div>


    

  




      <div id="countries_all"class="panel panel-default" style="border-top-left-radius:0px; border-top-right-radius:0px; border-color:#616163 ">
          <div class="panel-heading" style="background-color:#616163; color: #fff; border-top-left-radius:0px; border-top-right-radius:0px;">
            Views by Country
          </div>

          <table class="table table-hover" id="data_table">
              <thead>
                  <tr>
                      <th></th>  
                      <th>Name</th>
                      <th># of Views</th>
                    
                      
                  </tr>
              </thead>

              <tbody>

      

              @foreach ($countries as $country)




                  <tr>
                      <td class="col-md-1 text-left">{{ $loop->iteration }}.</td>
                      <td class="col-md-9 text-left"><a href="{{ route('country.show', ['id' => $country->id]) }}">{{ $country->name or 'n/a' }}</a></td>
                      <td class="col-md-2 ">{{ $country->views_count or 'n/a' }}</td>   
                  </tr>
              @endforeach

              </tbody>


          </table>

      </div> 

      
      


      <div class="panel panel-default" style="border-top-left-radius:0px; border-top-right-radius:0px; border-color:#616163 ">
          <div class="panel-heading" style="background-color:#616163; color: #fff; border-top-left-radius:0px; border-top-right-radius:0px;">
            Views by State
            <a href="#states_all" class="pull-right" style="color:#eee;">Show all ({{ count($users_by_state) }})</a>
          </div>

          <table class="table table-hover" id="data_table">
              <thead>
                  <tr>
                      <th></th>  
                      
                      <th><a href="{{ route('product.index', ['orderBy' => 'name', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">State @if ($request->orderBy == 'name')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                      <th><a href="{{ route('product.index', ['orderBy' => 'name', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">Country @if ($request->orderBy == 'name')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                      <th><a href="{{ route('product.index', ['orderBy' => 'issuers.name', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}"># of Users @if ($request->orderBy == 'issuers.name')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                      
                      
                                    </tr>
              </thead>

              <tbody>


              @foreach ($users_by_state->take(10) as $user)




                  <tr>
                      <td class="col-md-1 text-left">{{ $loop->iteration }}.</td>
                      <td class="col-md-7 ">{{ $user->state or 'n/a' }}</td>  
                      <td class="col-md-2 ">{{ $user->country->code or 'n/a' }}</td>  
                      <td class="col-md-2 ">{{ $user->user_count or 'n/a' }}</td>  
                      
                  </tr>
              @endforeach

              </tbody>


          </table>

      </div>
      

      


      <div class="panel panel-default" style="border-top-left-radius:0px; border-top-right-radius:0px; border-color:#616163 ">
          <div class="panel-heading" style="background-color:#616163; color: #fff; border-top-left-radius:0px; border-top-right-radius:0px;">
            Views by City
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

    
      <div class="panel panel-default" style="border-top-left-radius:0px; border-top-right-radius:0px; border-color:#616163 ">
          <div class="panel-heading" style="background-color:#616163; color: #fff; border-top-left-radius:0px; border-top-right-radius:0px;">
            Views by State - All
            <a href="#states_all" class="pull-right" style="color:#eee;">Show all ({{ count($users_by_state) }})</a>
          </div>

          <table class="table table-hover" id="data_table">
              <thead>
                  <tr>
                      <th></th>  
                      
                      <th><a href="{{ route('product.index', ['orderBy' => 'name', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">State @if ($request->orderBy == 'name')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                      <th><a href="{{ route('product.index', ['orderBy' => 'name', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}">Country @if ($request->orderBy == 'name')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                      <th><a href="{{ route('product.index', ['orderBy' => 'issuers.name', 'sort' => $request->sort == 'desc' ? 'asc' : 'desc' , 'q' => $request->q]) }}"># of Users @if ($request->orderBy == 'issuers.name')<span class="glyphicon glyphicon-triangle-{{ $request->sort == 'desc' ? 'bottom' : 'top' }}" aria-hidden="true"></span>@endif</a></th>
                      
                      
                                    </tr>
              </thead>

              <tbody>


              @foreach ($users_by_state as $user)




                  <tr>
                      <td class="col-md-1 text-left">{{ $loop->iteration }}.</td>
                      <td class="col-md-7 ">{{ $user->state or 'n/a' }}</td>  
                      <td class="col-md-2 ">{{ $user->country->code or 'n/a' }}</td>  
                      <td class="col-md-2 ">{{ $user->user_count or 'n/a' }}</td>  
                      
                  </tr>
              @endforeach

              </tbody>


          </table>

      </div>
      



      <div id="firms_all"class="panel panel-default" style="border-top-left-radius:0px; border-top-right-radius:0px; border-color:#616163 ">
          <div class="panel-heading" style="background-color:#616163; color: #fff; border-top-left-radius:0px; border-top-right-radius:0px;">
            Views by Firm (All)
          </div>

          <table class="table table-hover" id="data_table">
              <thead>
                  <tr>
                      <th></th>  
                      <th>Firm</th>
                      <th># of Views</th>
                    
                      
                  </tr>
              </thead>

              <tbody>

   

              @foreach ($firms as $firm)




                  <tr>
                      <td class="col-md-1 text-left">{{ $loop->iteration }}.</td>
                      <td class="col-md-9 text-left"><a href="{{ route('firm.show', ['id' => $firm->id]) }}">{{ $firm->name or 'n/a' }}</a></td>
                      <td class="col-md-2 ">{{ $firm->views_count or 'n/a' }}</td>   
                  </tr>
              @endforeach

              </tbody>


          </table>

      </div> 


  <div id="cities_all" class="panel panel-default" style="border-top-left-radius:0px; border-top-right-radius:0px; border-color:#616163 ">
      <div class="panel-heading" style="background-color:#616163; color: #fff; border-top-left-radius:0px; border-top-right-radius:0px;">
        Views by City - All
       
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







</div>
<div class="col-md-3">
    
    <div class="panel panel-default" style="border-top-left-radius:0px; border-top-right-radius:0px; border-color:#616163 ">
        <div class="panel-heading" style="background-color:#616163; color: #fff; border-top-left-radius:0px; border-top-right-radius:0px;">
          Info
        </div>

          <table class="table">
            <tbody>
              <tr>
                <td class="col-md-5 text-right"><strong>Name</strong></td>
                <td class="col-md-6 text-left">{{ $product->name }}</td>
              </tr>
               <tr>
                <td class="col-md-5 text-right"><strong>Ticker</strong></td>
                <td class="col-md-6 text-left">{{ $product->ticker }}</td>
              </tr>
              <tr>
                <td class="col-md-5 text-right"><strong>Issuer</strong></td>
                <td class="col-md-6 text-left">{{ $product->issuer->name }}</td>
              </tr>
              <tr>
                <td class="col-md-5 text-right"><strong>Type</strong></td>
                <td class="col-md-6 text-left">{{ $product->type->name or 'n/a' }}</td>
              </tr>

              <tr>
                <td class="col-md-5 text-right"><strong>Development Class</strong></td>
                <td class="col-md-6 text-left">{{ $product->development_class or 'n/a' }}</td>
              </tr>

              <tr>
                <td class="col-md-5 text-right"><strong>Region</strong></td>
                <td class="col-md-6 text-left">{{ $product->region or 'n/a' }}</td>
              </tr>
              <tr>
                <td class="col-md-5 text-right"><strong>Sub-region</strong></td>
                <td class="col-md-6 text-left">{{ $product->sub_region or 'n/a' }}</td>
              </tr>



              <tr>
                <td class="col-md-5 text-right"><strong>Views</strong></td>
                <td class="col-md-6 text-left">{{ number_format($product->views->count()) }}</td>
              </tr>
              <tr>
                <td class="col-md-5 text-right"><strong>Asset Class</strong></td>
                <td class="col-md-6 text-left">{{ $product->issuer->name or 'n/a' }}</td>
              </tr>
              <tr>
                <td class="col-md-5 text-right"><strong>Category</strong></td>
                <td class="col-md-6 text-left">{{ $product->category->name or 'n/a' }}</td>
              </tr>
              <tr>
                <td class="col-md-5 text-right"><strong>Focus</strong></td>
                <td class="col-md-6 text-left">{{ $product->focus->name or 'n/a' }}</td>
              </tr>
            </tbody>
          </table>

  










    <div class="panel-body">
              

    </div>
        

        
    </div> 




</div>

</div>

<div class="row">
    
    <div class="col-md-7 col-md-offset-1">



    <div class="panel panel-default">
      <div class="panel-body">


        <table class="table table-hover" id="data_table">
            
            <thead>
                <tr>
                    <th></th>  
                    <th>Date/Time </th>
                    <th>Firm </th>
                    <th>Location</th>
                    <th>Action Type</th>
                    <th></th>
                    
                    
                </tr>
            </thead>

            <tbody>

            @foreach ($views as $id => $view)

                <tr>
                    
                    <td class="col-md-1 text-left">{{ $views->firstItem() + $id }}.</td>
                    <td class="col-md-3 ">{{ Carbon\Carbon::parse($view->viewed_at)->format('m/d/Y h:i:s A') }}</td>  
                    <td class="col-md-3 ">{{ $view->user->firm->name or 'Visitor' }}</td>
                    <td class="col-md-4 ">{{ $view->user->city or '' }}, {{ $view->user->state or '' }}, {{ $view->user->country->code or '' }}</td>  
                    <td class="col-md-1 ">{{ $view->action->type->name }}</td>
           
                    
                    
                    
                </tr>
            @endforeach

            </tbody>


        </table>
        
        <div class="text-center">{{ $views->links() }}</div>

        <p class="text-right"><a href="#">View Full Report</a></p>
      </div>
    </div>


    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
              <div class="panel-body">
                <h5>Products with {{ $product->focus->name }}</h5>
                    <ul>
                    @foreach($related_products as $related_product)
                        <li><a href="{!! route('product.show', ['id' => $related_product->id]) !!}">{{ $related_product->ticker }} - {{ $related_product->name }}</a></li>
                    @endforeach
                    </ul>
              </div>
          </div>
        </div>

        <div class="col-md-6">
              <div class="panel panel-default">
                <div class="panel-body">
                  <h5>Products from {{ $product->issuer->name }}</h5>
                    <ul>
                    @foreach($more_from_issuer as $issuer_product)
                        <li><a href="{!! route('product.show', ['id' => $issuer_product->id]) !!}">{{ $issuer_product->ticker }} - {{ $issuer_product->name }}</a></li>
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>

       
    </div>


     <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
              <div class="panel-body">
                <h5>Views by Countries</h5>
                    <ul>
                    @foreach($countries as $country)
                        <li>{{ $country->name }} ({{ $country->views_count }} views)</li>
                    @endforeach
                    </ul>
              </div>
          </div>
        </div>

        <div class="col-md-6">
              
        </div>

       
    </div>

    




  </div>

  
  <div class="col-md-1"></div>






@stop





