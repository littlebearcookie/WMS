<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guest;

class GuestController extends Controller
{
    public function all(Request $request, $wedding_id)
    {
        $guests = Guest::where("wedding_id", $wedding_id)->get();
        return response()->json([
            "status" => "ok",
            "data" => $guests
        ]);
    }
    public function one(Request $request, $guest_id)
    {
        $guest = Guest::find($guest_id);
        return response()->json([
            "status" => "ok",
            "data" => $guest
        ]);
    }
    public function add(Request $request)
    {
        $request->validate([
            "name" => "required|max:20",
            "phone" => "required|max:20",
            "whose" => "required",
            "relation" => "required",
            "remark" => "string|nullable",
            "attend" => "required",
            "attend_num" => "integer|nullable",
            "gift_money" => "nullable",
        ]);
        $guest = new Guest;
        $guest->wedding = $request->input("wedding_id");
        $guest->name = $request->input("name");
        $guest->phone = $request->input("phone");
        $guest->whose = $request->input("whose");
        $guest->relation = $request->input("relation");
        $guest->remark = $request->input("remark");
        $guest->attend = $request->input("attend");
        $guest->attend_num = $request->input("attend_num");
        $guest->gift_money = $request->input("gift_money");
        $guest->save();
        return response(["status" => "ok",], 200);
    }
    public function edit(Request $request, $guest_id)
    {
        $request->validate([
            "name" => "required|max:20",
            "phone" => "required|max:20",
            "whose" => "required",
            "relation" => "required",
            "remark" => "string|nullable",
            "attend" => "required",
            "attend_num" => "integer|nullable",
            "gift_money" => "nullable",
        ]);
        $guest = Guest::find($guest_id);
        $guest->name = $request->input("name");
        $guest->phone = $request->input("phone");
        $guest->whose = $request->input("whose");
        $guest->relation = $request->input("relation");
        $guest->remark = $request->input("remark");
        $guest->attend = $request->input("attend");
        $guest->attend_num = $request->input("attend_num");
        $guest->gift_money = $request->input("gift_money");
        $guest->save();
        return response(["status" => "ok",], 200);
    }
    public function delete(Request $request, $guest_id)
    {
        $guest = Guest::find($guest_id);
        $guest->delete();
        return response(["status" => "ok",], 200);
    }
}
