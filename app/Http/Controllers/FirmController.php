<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Firm as Firm;
use App\View as View;
use App\AssetClass as AssetClass;
use App\ProductCategory as Category;
use App\ProductFocus as Focus;
use App\ProductType as ProductType;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;


class FirmController extends Controller
{   

    

    public function index(Request $request)
    {

      $query = Firm::withCount('users')->withCount('views')->orderby('views_count', 'desc')->paginate(50);

        return view('firm', [
            'firms' => $query,
            'request' => $request
        ]);
    }

    public function show(Request $request, $id)
    {

      $firm = Firm::withCount('users', 'views')->find($id);

      $views = $firm->views()->with('product')->where('product_id', '!=', null)->paginate(10);
   

      $products = $firm->views()->whereHas('product')->selectRaw('*, count(*) as view_count')->groupby('product_id')->orderby('view_count', 'desc')->get();


      $users = $firm->users()->withCount('views')->orderby('views_count', 'desc')->get();

      $users_by_city = $firm->users()->selectRaw('*, count(*) as user_count')->groupby('city')->orderby('user_count', 'desc')->get();

      $views_by_asset_class = AssetClass::withCount(['views' => function($q) use ($firm) {
        return $q->whereHas('user', function($q) use ($firm) {
          return $q->where('firm_id', '=', $firm->id);
        });
      }])->orderby('views_count', 'desc')->get();

      $views_by_category = Category::withCount(['views' => function($q) use ($firm) {
        return $q->whereHas('user', function($q) use ($firm) {
          return $q->where('firm_id', '=', $firm->id);
        });
      }])->with('assetClass')->orderby('views_count', 'desc')->get();

      $views_by_focus = Focus::withCount(['views' => function($q) use ($firm) {
        return $q->whereHas('user', function($q) use ($firm) {
          return $q->where('firm_id', '=', $firm->id);
        });
      }])->with('category')->orderby('views_count', 'desc')->get();



      $views_by_product_type = ProductType::withCount(['views' => function($q) use ($firm) {
        return $q->whereHas('user', function($q) use ($firm) {
          return $q->where('firm_id', '=', $firm->id);
        });
      }])->orderby('views_count', 'desc')->get();



      $street_address = $firm->users()->where('address', '!=', '')->get();



      //dd($views1);

     // dd($firm->first()->views()->where('product_id', '!=', null)->toSql());

     
        //
      //$row->user->firm->first()->firm

      return view('item_details.firm', [
            'views' => $views,
            'firm' => $firm,
            'products' => $products,
            'users' => $users,
            'users_by_city'  => $users_by_city,
            'views_by_asset_class' => $views_by_asset_class,
            'views_by_category' => $views_by_category,
            'views_by_focus' => $views_by_focus,
            'views_by_product_type' => $views_by_product_type,
            'street_address' => $street_address,
            'request' => $request
        ]);
    }

}