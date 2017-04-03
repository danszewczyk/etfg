@extends('templates.default')

@section('content')
    
<div class="row" style="background-color:#dc5f13; margin-bottom:50px;">
    <h1 class="text-center" style="color:#fff; padding-bottom:20px; padding-top:20px;">Firms</h1>
    <br/>
</div>

<div class="row">
  <div class="col-md-7 col-md-offset-1">

    
   <div class="panel panel-default" style="border-top-left-radius:0px; border-top-right-radius:0px; border-color:#616163 ">
        


        <table class="table table-hover" id="data_table">
            <thead style="background-color:#616163; color:#fff;">
                <tr>
                    <th></th>  
                    <th>Name </th>
                    <!-- <th class="text-right"># of Users </th> -->
                    <th class="text-right"># of Users </th>
                    <th class="text-right"># of Views </th>
                    
                </tr>
            </thead>

            <tbody>

            @foreach ($firms as $firm)

                <tr>
                    <td class="col-md-1 text-left">{{ $firms->firstItem() + $loop->index }}.</td>
                    <td class="col-md-7 text-left"><a href="{!! route('firm.show', ['id' => $firm->id]) !!}">{{ $firm->name }}</td>
                    <!-- <td class="col-md-2 text-right">@{{ $firm->users_count }}</td>   -->
                    <td class="col-md-2 text-right">{{ number_format($firm->users_count) }}</td>  
                    <td class="col-md-2 text-right">{{ number_format($firm->views_count) }}</td>  
                   
                </tr>
            @endforeach

            </tbody>


        </table>



        <div class="text-center">{{ $firms->links() }}</div>


      </div>
    </div>

  </div>





</div>


@stop





