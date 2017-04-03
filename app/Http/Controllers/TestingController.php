<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Product as Product;
use App\Issuer as Issuer;
use App\AssetClass as AssetClass;
use App\Firm as Firm;
use App\ProductCategory as Category;
use App\ProductFocus as Focus;

use App\View as View;

use Illuminate\Http\Request;

use Carbon\Carbon;




class TestingController extends Controller
{   

    public function index(Request $request) {
      
      $asset_class = $request->input('asset_class');
      $category = $request->input('category');
      $focus = $request->input('focus');

      // Get all the prouducts and save to a collection
      $products = Product::select('id', 'ticker', 'name', 'category_id', 'asset_class_id', 'focus_id', 'issuer_id', 'type_id')->with('focus', 'category', 'assetClass', 'issuer', 'type')->withCount('views')
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

      $products = $products->sortByDesc('views_count');
      // Use the collection to sort, group, etc
      //$issuers = $products->groupBy('issuer.name')->toArray();

      //$asset_classes = $products->groupBy('assetClass.name')->toArray();

      $asset_classes = $products->groupBy('assetClass.name');




      $categories = $products->groupBy('category.name');

      $focuses = $products->groupBy('focus.name');

      return view('product_v2')->with([
        'products' => $products,
        'asset_classes' => $asset_classes,
        'categories' => $categories,
        'focuses' => $focuses
      ]);


     
    }

    public function update_views() {


      $visitorTraffic = View::select('id', 'product_id', 'viewed_at')
    ->get()
    ->groupBy(function($date) {
        return Carbon::parse($date->created_at)->format('Y'); // grouping by years
        //return Carbon::parse($date->created_at)->format('m'); // grouping by months
    });

    return $visitorTraffic;

    }

}