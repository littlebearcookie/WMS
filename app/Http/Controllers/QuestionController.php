<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\ReplyController;

class QuestionController extends Controller
{
  public static function all($form_id)
  {
    $questions = Question::where('form_id', $form_id)
      ->orderBy("sort", "ASC")
      ->get();
    foreach ($questions as $key => $question) {
      $questions[$key]['options'] = OptionController::all($question->id);
    }
    return $questions;
  }
  public static function edit($form_id, $questions)
  {
    $sort = 1;
    foreach ($questions as $question) {
      $questionDB = new Question;
      $questionDB->form_id = $form_id;
      $questionDB->type = $question['type'];
      $questionDB->text = $question['text'];
      $questionDB->required = $question['required'];
      $questionDB->sort = $sort;
      $questionDB->save();
      $question_id = $questionDB->id;
      OptionController::add($question_id, $question['options']);
      $sort++;
    }
  }
  public static function delete($form_id)
  {
    $questions = Question::where("form_id", $form_id)->get();
    foreach ($questions as $question) {
      OptionController::delete($question->id);
      ReplyController::delete($question->id);
    }
    Question::where("form_id", $form_id)->delete();
  }
}
