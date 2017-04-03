<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Product as Product;
use App\Issuer as Issuer;
use App\AssetClass as AssetClass;
use App\ProductType as ProductType;
use App\ProductFocus as ProductFocus;
use App\Country as Country;
use App\Firm as Firm;
use App\View as View;
use App\ActionTypes as ActionType;

use Illuminate\Support\Facades\DB as DB;
use Illuminate\Contracts\Encryption\DecryptException;

class ProductController extends Controller
{   

    public function index_new(Request $request) {
      



      $asset_class = $request->input('asset_class');
      $category = $request->input('category');
      $focus = $request->input('focus');

      // Get all the prouducts and save to a collection
      $products = Product::where('is_etf', 1)->select('id', 'ticker', 'name', 'category_id', 'asset_class_id', 'focus_id', 'issuer_id', 'type_id')->with('focus', 'category', 'assetClass', 'issuer', 'type')->withCount('views')
      ->when($asset_class, function($query) use ($asset_class) {
        return $query->where('asset_class_id', $asset_class);
      })
      ->when($category, function($query) use ($category) {
        return $query->where('category_id', $category);
      })
      ->when($focus, function($query) use ($focus) {
        return $query->where('focus_id', $focus);
      })
      ->get();     

      if ($request->has('orderBy')) {
        $orderBy = $request->input('orderBy');
      } else {
        $orderBy = 'views_count';
      }

      if ($request->has('sort')) {
        $sort = $request->input('sort');
      } else {
        $sort = 'desc';
      }

      if ($sort == 'desc') {
        $products = $products->sortByDesc($orderBy);
      } else {
        $products = $products->sortBy($orderBy);
      }

      //$products = $products->sortByDesc('views_count');
      // Use the collection to sort, group, etc
      //$issuers = $products->groupBy('issuer.name')->toArray();

      //$asset_classes = $products->groupBy('assetClass.name')->toArray();

      $asset_classes = $products->groupBy('assetClass.name')->sortByDesc(function ($asset_class, $key) {
          return count($asset_class);
      });


      $categories = $products->groupBy('category.name')->sortByDesc(function ($category, $key) {
          return count($category);
      });

      $focuses = $products->groupBy('focus.name')->sortByDesc(function ($focus, $key) {
          return count($focus);
      });

      return view('home')->with([
        'products' => $products,
        'asset_classes' => $asset_classes,
        'categories' => $categories,
        'focuses' => $focuses,
        'request' => $request
      ]);


     
    }


    public function index(Request $request) {

      // requests ------

       


  
      // ---------------
 
      // $rows = Product::with('type')->with('assetClass')->with('issuer')->when($search, function($query) use ($search) {
      //   return $query->where('ticker', 'like', $search.'%' );
      // }, function($query) {
      //   return $query->where('ticker', 'like', 't%' );
      // })->paginate(10);

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
          $query = $query->orderBy('ticker');
            // or how I like $query->latest('price'); it's the same, just easier to remember
        }
         
        $rows = $query->withCount('views')->paginate(10);

        
       
        $query = new Issuer();

        if ($request->q) {

          $query = $query->withCount(['products' => function($query) use ($request){
              return $query->where('ticker', 'like', $request->q.'%' );
            }]);

        } else {

            $query = $query->withCount('products');
        }
       
       
        $issuers = $query->get()->sortByDesc('products_count');

        $filtered_issuers= $issuers->filter(function($value) {
          return $value->products_count > 0;
        });

      


        $query = new AssetClass();

        if ($request->q) {

          $query = $query->withCount(['products' => function($query) use ($request){
              return $query->where('ticker', 'like', $request->q.'%');
          }]);

        } else {

          $query = $query->withCount('products');

        }

        $asset_classes = $query->get()->sortByDesc('products_count');

        $filtered_asset_classes= $asset_classes->filter(function($value) {
          return $value->products_count > 0;
        });



        $query = new ProductType();

        if ($request->q) {

          $query = $query->withCount(['products' => function($query) use ($request) {
              return $query->where('ticker', 'like', $request->q.'%');
          }]);

        } else {

          $query = $query->withCount('products');

        }
      
        $product_types = $query->get()->sortByDesc('products_count');

        $filtered_product_types = $product_types->filter(function($value) {
          return $value->products_count > 0;
        });


        


      


      return view('product', [
        'rows' => $rows,
        'issuers' => $filtered_issuers,
        'asset_classes' => $filtered_asset_classes,
        'product_types' => $filtered_product_types,

        'request' => $request
      ]);

    }

    public function show(Request $request, $id)
    {




      $row = Product::find($id);

      

      $query = View::select('views.*')->where('views.product_id', '=', $id)
        ->leftJoin('users', 'users.id', '=', 'views.user_id')
        ->leftJoin('firms', 'firms.id', '=', 'users.firm_id')
        ->leftJoin('countries', 'users.country_id', '=', 'countries.id')
        ->leftJoin('regions', 'countries.region_id', '=', 'regions.id')
        ->leftJoin('products', 'products.id', '=', 'views.product_id');
       
      if ($request->orderBy && $request->sort) {


          $query = $query->orderby($request->orderBy, $request->sort)->orderBy('viewed_at', $request->sort);
      } else {

          // $query = $query->orderBy('ticker');
        $query = $query->orderBy('viewed_at');
          // or how I like $query->latest('price'); it's the same, just easier to remember
      }
       
      $views = $query->paginate(10);

   
      $users_by_city = $row->users()->selectRaw('*, count(*) as user_count')->groupby('city')->orderby('user_count', 'desc')->get();

      $users_by_state = $row->users()->selectRaw('*, count(*) as user_count')->groupby('state')->orderby('user_count', 'desc')->get();




      //$views = $row->views()->with('user', 'product')->paginate(10);

      $related_products = ProductFocus::find($row->focus->id)->products()->take(10)->orderby('name', 'asc')->get();

      $more_from_issuer = Issuer::find($row->issuer->id)->products()->take(10)->orderby('name', 'asc')->get();

      $views_by_type = ActionType::withCount(['views' => function($query) use ($row) {
        $query->where('product_id', $row->id);
      }])->orderBy('views_count', 'desc')->get();



      $countries = Country::withCount(['views' => function($query) use ($row) {
         return $query->where('product_id', '=', $row->id);
      }])->get()->sortByDesc('views_count');

      $filtered_countries = $countries->filter(function($value) {
        return $value->views_count > 0;
      });


      $firms = Firm::withCount(['views' => function($query) use ($row) {
         return $query->where('product_id', '=', $row->id);
      }])->get()->sortByDesc('views_count');


      $filtered_firms = $firms->filter(function($value) {
        return $value->views_count > 0;
      });


      

      return view('item_details.product', [
            'product' => $row,
            'related_products' => $related_products,
            'more_from_issuer' => $more_from_issuer,
            'views' => $views,
            'countries' => $filtered_countries,
            'request' => $request,
            'firms' => $filtered_firms,
            'users_by_city' => $users_by_city,
            'users_by_state' => $users_by_state,
            'views_by_type' => $views_by_type,

        ]);
    }

}