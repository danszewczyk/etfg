<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Data as Data;
use App\Ticker as Ticker;
use App\Issuer as Issuer;
use App\UserView as User;
use App\Firm as Firm;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;


class CategoryController extends Controller
{   

    public function show($id)
    {

      $category = Category::find($id);

      

        //
      //$row->user->firm->first()->firm

      return view('item_details.category', [
            'category' => $category,
            'paginated' => $category->data()->paginate(10)
        ]);
    }

    public function index(Request $request)
    {

       //

       if ($request->has('q')) {
        //searching a ticker
         $paginated = Category::where('name', 'like', $request->q . "%")->paginate(10);
       }else{
         $paginated = Category::orderBy('name', 'desc')->paginate(10); 
       }

       $data_total = Data::count();

       
    

      
    
    


        return view('category', [
            'rows' => $paginated,
            'request' => $request,
            'data_total' => $data_total
        ]);
    }

}