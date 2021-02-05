<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Option;

class OptionController extends Controller
{
  public static function all($question_id)
  {
    return Option::where("question_id", $question_id)->get();
  }
  public static function add($question_id, $options)
  {
    foreach ($options as $option) {
      $optionDB = new Option;
      $optionDB->question_id = $question_id;
      $optionDB->value = $option['value'];
      $optionDB->save();
    }
  }
  public static function delete($question_id)
  {
    Option::where("question_id", $question_id)
      ->delete();
  }
}
