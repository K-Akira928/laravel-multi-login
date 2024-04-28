<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\UploadImageRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Services\ImageService;

use App\Models\Shop;

class ShopController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:owners');
    $this->middleware(function ($request, $next) {
      $id = $request->route()->parameter('shop');

      if (is_null($id)) {
        return $next($request);
      }

      $shopsOwnerId = Shop::findOrFail($id)->owner->id;
      $shopId = (int)$shopsOwnerId;
      $ownerId = Auth::id();

      if ($shopId === $ownerId) {
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
    $shops = Shop::where('owner_id', Auth::id())->get();

    return view(
      'owner.shops.index',
      compact('shops')
    );
  }
  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    $shop = Shop::findOrFail($id);

    return view('owner.shops.edit', compact('shop'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UploadImageRequest $request, string $id)
  {
    $imageFile = $request->image;

    if (!is_null($imageFile) && $imageFile->isValid()) {
      $fileNameToStore = ImageService::upload($imageFile, 'shops');
    }

    return redirect()->route('owner.shops.index');
  }
}
