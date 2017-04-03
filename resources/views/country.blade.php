@extends('templates.default')

@section('content')

<div class="row" style="background-color:#dc5f13; margin-bottom:50px;">
    <h1 class="text-center" style="color:#fff">Countries</h1>
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
                    <th class="text-right">Views </th>
                    
                </tr>
            </thead>

            <tbody>

            @foreach ($countries as $country)

                <tr>
                    <td class="col-md-1 text-left">{{ $countries->firstItem() + $loop->index }}.</td>
                    <td class="col-md-7 text-left"><a href="{!! route('country.show', ['id' => $country->id]) !!}">{{ $country->name }}</td>
                    <td class="col-md-4 text-right">{{ number_format($country->views_count) }}</td>  
                   
                </tr>
            @endforeach

            </tbody>


        </table>



        <div class="text-center">{{ $countries->links() }}</div>


        <p class="text-right"><a href="#">View Full Report</a></p>
      </div>
    </div>

  </div>


</div>




@stop





