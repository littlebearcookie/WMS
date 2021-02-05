<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reply;

class ReplyController extends Controller
{

  public static function delete($question_id)
  {
    Reply::where("question_id", $question_id)
      ->delete();
  }
}
