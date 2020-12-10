<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Participant;

class ParticipantController extends Controller
{
  public function all(Request $request, $wedding_id)
  {
    $participants = Participant::find($wedding_id)->get();
    return response(["msg" => $participants], 200);
  }
}
