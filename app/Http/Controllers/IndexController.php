<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Product as Product;
use App\Issuer as Issuer;
use App\Firm as Firm;
use App\Country as Country;

use App\AssetClass as AssetClass;
use App\ProductCategory as Category;
use App\ProductFocus as Focus;

use App\View as View;
use App\SelectListView as SelectListView;

use Illuminate\Http\Request;

use Carbon\Carbon as Carbon;



class IndexController extends Controller
{   

    public function __construct()
        {
            $this->middleware('auth');
        }

    public function index(Request $request) {      

      $products = Product::orderBy('view_count', 'desc')->limit(10)->get();

      $issuers = Issuer::orderBy('view_count', 'desc')->limit(10)->get();

      $asset_classes = AssetClass::orderBy('product_count', 'desc')->limit(10)->get();

      $firms = Firm::orderBy('view_count', 'desc')->limit(15)->get();

      /*
       *  Let's get all all the countries and their view counts
       *
       */

      $countries = Country::withCount('views')->orderby('views_count', 'desc')->get();


      /*
       *  Let's get the first select view 
       *
       */

      

     






      return view('dashboard', [
        'products' => $products,
        'issuers' => $issuers,
        'asset_classes' => $asset_classes,
        'firms' => $firms,
        'countries' => $countries,
       
        'request' => $request
      ]);
  
    }

}