<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Country as Country;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;


class CountryController extends Controller
{   

    

    public function index(Request $request)
    {

      $query = Country::withCount('views')->orderby('views_count', 'desc')->paginate(10);

        return view('country', [
            'countries' => $query,
            'request' => $request
        ]);
    }

    public function show(Request $request, $id)
    {

      $country = Country::find($id);

      $views = $country->views()->paginate(10);



     // dd($firm->first()->views()->where('product_id', '!=', null)->toSql());

     
        //
      //$row->user->firm->first()->firm

      return view('item_details.country', [
            'rows' => $views,
            'country' => $country,
            'request' => $request
        ]);
    }

}