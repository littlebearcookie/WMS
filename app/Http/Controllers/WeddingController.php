<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wedding;

class WeddingController extends Controller
{
  public function all()
  {
    $weddings = Wedding::where('owner', auth()->user()->id)
      ->orderBy("created_at", "DESC")
      ->get();
    return response()->json([
      "status" => "ok",
      "data" => $weddings
    ]);
  }
  public function one($wedding_id)
  {
    $wedding = Wedding::find($wedding_id);
    return response()->json([
      "status" => "ok",
      "data" => $wedding
    ]);
  }
  public function add(Request $request)
  {
    $request->validate([
      "name" => "required|max:20",
      "bride" => "required|max:10",
      "bridegroom" => "required|max:10",
      "date" => "required|date_format:Y-m-d H:i:s",
      "address" => "required|max:50",
    ]);
    $wedding = new Wedding;
    $wedding->name = $request->input("name");
    $wedding->bride = $request->input("bride");
    $wedding->bridegroom = $request->input("bridegroom");
    $wedding->date = $request->input("date");
    $wedding->address = $request->input("address");
    $wedding->owner = auth()->user()->id;
    $wedding->key = md5(time());
    $wedding->save();
    return response()->json([
      "status" => "ok"
    ]);
  }
  public function edit(Request $request, $wedding_id)
  {
    $request->validate([
      "name" => "required|max:20",
      "bride" => "required|max:10",
      "bridegroom" => "required|max:10",
      "date" => "required|date_format:Y-m-d H:i:s",
      "address" => "required|max:50",
    ]);
    $wedding = Wedding::find($wedding_id);
    $wedding->name = $request->input("name");
    $wedding->bride = $request->input("bride");
    $wedding->bridegroom = $request->input("bridegroom");
    $wedding->date = $request->input("date");
    $wedding->address = $request->input("address");
    $wedding->save();
    return response()->json([
      "status" => "ok"
    ]);
  }
  public function delete($wedding_id)
  {
    Wedding::find($wedding_id)->delete();
    return response()->json([
      "status" => "ok"
    ]);
  }
}
