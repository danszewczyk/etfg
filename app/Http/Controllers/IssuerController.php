<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Issuer as Issuer;
use App\Product as Product;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;


class IssuerController extends Controller
{   

    

    public function index(Request $request)
    {

      $query = Issuer::withCount('products', 'views');

      if ($request->q) {
          $query = $query->where('name', 'like', $request->q."%");
      }
       
       
      $query = $query->orderby('views_count', 'desc')->paginate(10);




        return view('issuer', [
            'issuers' => $query,
            'request' => $request
        ]);
    }

    public function show(Request $request, $id)
    {



      $query = Product::select('products.*')
          ->leftJoin('issuers', 'products.issuer_id', '=', 'issuers.id')
          ->leftJoin('product_types', 'products.type_id', '=', 'product_types.id')
          ->leftJoin('asset_classes', 'products.asset_class_id', '=', 'asset_classes.id')
          ->leftJoin('product_categories', 'products.category_id', '=', 'product_categories.id')
          ->leftJoin('product_focuses', 'products.focus_id', '=', 'product_focuses.id');


         
        if ($request->q) {
            $query = $query->where('ticker', 'like', $request->q."%");
        }
         
        if ($request->orderBy && $request->sort) {

            $query = $query->orderby($request->orderBy, $request->sort)->orderBy('ticker', $request->sort);
        } else {
            // $query = $query->orderBy('ticker');
          $query = $query->orderBy('views_count', 'desc');
            // or how I like $query->latest('price'); it's the same, just easier to remember
        }
         
        $products = $query->withCount('views')->where('issuer_id', '=', $id)->paginate(10);


        $issuer = Issuer::withCount('views')->find($id);

        // - - --------------





      // $issuer = Issuer::with('products')->withCount('views')->where('id', $id);

      // //$issuer = Issuer::with('products')->where('id', $id);

      // $products = $issuer->first()->products()->withCount('views')->where('ticker', 'like', $request->q.'%')->orderby('views_count', 'desc');
      
      // // if ($request->q) {

      // //     $products = $products->where('name', 'like', $request->q."%");
      // // }

      // $products = $products->paginate(10);

      // $issuer = $issuer->first();

      
        //
      //$row->user->firm->first()->firm

      return view('item_details.issuer', [
            'rows' => $products,
            'issuer' => $issuer,
            'request' => $request
        ]);
    }

}