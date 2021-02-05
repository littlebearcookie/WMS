<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use App\Http\Controllers\QuestionController;

class FormController extends Controller
{
  public function all()
  {
    $forms = Form::where('owner', auth()->user()->id)
      ->orderBy("created_at", "DESC")
      ->get();
    return response()->json([
      "status" => "ok",
      "data" => $forms
    ]);
  }
  public function one($form_id)
  {
    $form = Form::find($form_id);
    $form['questions'] = QuestionController::all($form_id);
    return response()->json([
      "status" => "ok",
      "data" => $form
    ]);
  }
  public function add(Request $request)
  {
    $form = new Form;
    $form->owner = auth()->user()->id;
    $form->title = $request->input("title");
    $form->content = $request->input("content");
    $form->save();
    $form_id = $form->id;
    QuestionController::edit($form_id, $request->input("questions"));
    return response()->json([
      "status" => "ok"
    ]);
  }
  public function edit(Request $request, $form_id)
  {
    $form = Form::find($form_id);
    $form->title = $request->input("title");
    $form->content = $request->input("content");
    $form->save();
    QuestionController::delete($form_id);
    QuestionController::edit($form_id, $request->input("questions"));
    return response()->json([
      "status" => "ok"
    ]);
  }
  public function delete($form_id)
  {
    QuestionController::delete($form_id);
    Form::find($form_id)->delete();
    return response()->json([
      "status" => "ok"
    ]);
  }
}
