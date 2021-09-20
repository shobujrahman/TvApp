<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Feedback;
use Session;

class FeedbackController extends Controller
{
    
    public function index(){
        session::put('page','feedback');
        $feedback = Feedback::orderBy('id', 'DESC')->get();
        return view('admin.feedback_index',compact('feedback'))->with('no', 1);
    }
}
