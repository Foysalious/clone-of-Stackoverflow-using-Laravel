<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
class AcceptAnswerController extends Controller
{
    public function accept(Answer $answer){
        $this->authorize('accept', $answer);
        $answer->question->bestAcceptAnswer($answer);
        return back();
    }
}
