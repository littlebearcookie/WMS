<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wedding;

class WeddingController extends Controller
{
  public function all(Request $request)
  {
    $weddings = Wedding::find(auth()->user()->id)->get();
    return response(
      [
        "status" => "ok",
        "data" => $weddings
      ],
      200
    );
  }
  public function add(Request $request)
  {
    $request->validate([
      "name" => "required|max:20",
      "bride" => "required|max:10",
      "bridegroom" => "required|max:10",
      "date" => "required|date_format:Y-m-d H:i:s",
    ]);
    $wedding = new Wedding;
    $wedding->name = $request->input("name");
    $wedding->bride = $request->input("bride");
    $wedding->bridegroom = $request->input("bridegroom");
    $wedding->date = $request->input("date");
    $wedding->owner = auth()->user()->id;
    $wedding->save();
    return response(["status" => "ok",], 200);
  }
  public function edit(Request $request, $wedding_id)
  {
    $request->validate([
      "name" => "required|max:20",
      "bride" => "required|max:10",
      "bridegroom" => "required|max:10",
      "date" => "required|date_format:Y-m-d H:i:s",
    ]);
    $wedding = Wedding::find($wedding_id);
    $wedding->name = $request->input("name");
    $wedding->bride = $request->input("bride");
    $wedding->bridegroom = $request->input("bridegroom");
    $wedding->date = $request->input("date");
    $wedding->save();
    return response(["status" => "ok",], 200);
  }
}
