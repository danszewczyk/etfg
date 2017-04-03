<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Data as Data;
use App\Ticker as Ticker;
use App\Issuer as Issuer;
use App\User as User;
use App\Firm as Firm;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;


class DataController extends Controller
{   

    public function tickersPost(Request $request) {



        

    }
    
    public function tickers(Request $request)
    { 

        $query = Ticker::where('id', '>', 0);


        if ($request->has('q')) {
         //searching a ticker
          $query = $query->where('ticker', 'like', $request->q . "%");
        }

        if ($request->has('sort')) {
        // has sort
        // find out in which order
        $sort_field = $request->sort;

            if ($request->has($sort_field)) {
                $query = $query->orderBy($sort_field, $request->$sort_field);
            }

       }else{
          $query = $query->withCount('data')->orderBy('data_count', 'desc');
        }

       


       $query = $query->paginate(10);

       
    
       $data_total = Data::count();
      

        if ($request->has('sort')) {
            return view('ticker', [
                'rows' => $query,
                'request' => $request,
                'data_total' => $data_total,
                'sort_field' => $sort_field,
                'sort_order' => $request->$sort_field
            ]);
        }else{
            return view('ticker', [
            'rows' => $query,
            'request' => $request,
            'data_total' => $data_total,
            'sort_order' => ''
            ]);
        }
    
    


        
    }

}