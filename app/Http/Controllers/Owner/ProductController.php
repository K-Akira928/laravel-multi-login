<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Image;
use App\Models\SecondaryCategory;
use App\Models\Owner;
use App\Models\Product;

class ProductController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:owners');

    $this->middleware(function ($request, $next) {
      $id = $request->route()->parameter('product');

      if (is_null($id)) {
        return $next($request);
      }

      $productOwnerId = Product::findOrFail($id)->shop->owner->id;
      $productId = (int)$productOwnerId;
      $ownerId = Auth::id();

      if ($productId === $ownerId) {
        return $next($request);
      }

      abort(404);
    });
  }
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    // $products = Owner::findOrFail(Auth::id())->shop->product;
    $ownerInfo = Owner::with('shop.product.imageFirst')
      ->where('id', Auth::id())->get();

    return view('owner.prodcuts.index', compact('ownerInfo'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }
}
