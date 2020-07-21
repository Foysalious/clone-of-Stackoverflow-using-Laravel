<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
class VoteQuestionController extends Controller
{
    public function __construct() {
        return $this->middleware('auth');
    }

    public function vote(Question $question){
        $vote =(int) request()->vote;
        auth()->user()->voteQuestion($question, $vote);
        return back();
    }
}
