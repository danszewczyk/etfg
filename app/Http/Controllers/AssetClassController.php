<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\AssetClass as AssetClass;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;


class AssetClassController extends Controller
{   

    

    public function index(Request $request)
    {

      $query = AssetClass::withCount('products', 'views')->orderby('views_count', 'desc')->paginate(10);

        return view('asset_class', [
            'asset_classes' => $query,
            'request' => $request
        ]);
    }

    public function show(Request $request, $id)
    {

      $asset_class = AssetClass::with('products')->where('id', $id);

      $products = $asset_class->first()->products()->withCount('views')->paginate(10);

      $asset_class = $asset_class->first();
        //
      //$row->user->firm->first()->firm

      return view('item_details.asset_class', [
            'rows' => $products,
            'asset_class' => $asset_class,
            'request' => $request
        ]);
    }

}