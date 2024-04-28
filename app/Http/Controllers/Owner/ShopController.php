<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    $ownerId = Auth::id();
    $shops = Shop::where('owner_id', $ownerId)->get();

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
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    $owner = Owner::findOrFail($id);
    $owner->name = $request->name;
    $owner->email = $request->email;
    $owner->password = Hash::make($request->password);
    $owner->save();

    return redirect()->route('admin.owners.index')->with(['message' => 'オーナー情報を更新しました', 'status' => 'info']);
  }
}
