@extends('templates.default')

@section('content')
  <div class="col-md-7">
    <h1>{{ $ticker->ticker_name }}</h1>
    <br/>
    <div class="panel panel-default">
      <div class="panel-body">
        <p>Ticker: <strong>{{ $ticker->ticker }}</strong></p>
        <p>Category: <strong>{{ $ticker->category->name }}</strong></p>
      </div>
    </div>

    <div class="panel panel-default">
      <div class="panel-body">
         



          <table class="table table-hover" id="data_table">
            <thead>
                <tr>
                    <th></th>  
                    <th><a href="{{ route('ticker', ['sort' => 'ticker', 'ticker' => 'asc']) }}">Date</a></th>
                    <th><a href="{{ route('ticker', ['sort' => 'issuer', 'issuer' => 'asc']) }}">Time</a></th>
                    <th><a href="{{ route('ticker', ['sort' => 'firm', 'firm' => 'asc']) }}">Firm</a></th>
                    <th class="text-right"><a href="{{ route('ticker', ['sort' => 'firm', 'firm' => 'asc']) }}">City</a></th>
                    <th class="text-right"><a href="{{ route('ticker', ['sort' => 'firm', 'firm' => 'asc']) }}">Country</a></th>
                   
                </tr>
            </thead>

            <tbody>

            @foreach ($paginated as $id=>$row)

                <tr>
                    <td class="col-md-1">{{ $paginated->firstItem() + $id }}.</td>
                    <td class="col-md-2">{{ $row->date or 'n/a'}}</a></td>
                    <td class="col-md-1">{{ $row->time or 'n/a'}}</a></td>
                    <td class="col-md-3">{{ $row->user->firm->first()->firm or '' }}</td>
                    <td class="col-md-2 text-right">{{ $row->user->city or 'n/a' }}</td>
                    <td class="col-md-1">{{ $row->user->country->code or 'n/a' }}</td>
   
                </tr>
            @endforeach

            </tbody>


        </table>

        <div class="text-center">{{ $paginated->links() }}</div>

      </div>
    </div>

  <div class="col-md-1"></div>






@stop





