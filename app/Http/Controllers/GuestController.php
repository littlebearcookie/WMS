<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wedding;
use App\Models\Guest;

class GuestController extends Controller
{
  public function all()
  {
    $guests =  Guest::select(
      "weddings.name as wedding_name",
      "guests.*"
    )
      ->leftJoin("weddings", "guests.wedding_id", "=", "weddings.id")
      ->where("weddings.owner", auth()->user()->id)
      ->orderBy("created_at", "DESC")
      ->get();
    return response()->json([
      "status" => "ok",
      "data" => $guests
    ]);
  }
  public function one($guest_id, $key)
  {
    $guest = Guest::where("id", $guest_id)->where("key", $key)->get();
    return response()->json([
      "status" => "ok",
      "data" => $guest
    ]);
  }
  public function add(Request $request)
  {
    $request->validate([
      "wedding_id" => "required|integer",
      "name" => "required|max:20",
    ]);
    $guest = new Guest;
    $guest->wedding_id = $request->input("wedding_id");
    $guest->name = $request->input("name");
    $guest->key = md5(time());
    $guest->save();
    return response()->json(["status" => "ok"]);
  }
  public function edit(Request $request, $guest_id)
  {
    $request->validate([
      "wedding_id" => "required|integer",
      "name" => "required|max:20",
    ]);
    $guest = Guest::find($guest_id);
    $guest->wedding_id = $request->input("wedding_id");
    $guest->name = $request->input("name");
    $guest->save();
    return response()->json(["status" => "ok"]);
  }
  public function delete($guest_id)
  {
    Guest::find($guest_id)->delete();
    return response()->json(["status" => "ok"]);
  }
}
