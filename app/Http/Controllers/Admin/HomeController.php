<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Review;
use App\Message;

// Import Carbon
use Carbon\Carbon;


class HomeController extends Controller
{
    
    public function index(){
        $id = Auth::id();

        // ---------------- Total review per MONTH----------------//

        $data_review=Review::select('id', 'created_at')->where('user_id', $id)->get()->groupBy(function($data){
            return \Carbon\Carbon::parse($data['created_at'])->format('M');
        });

        $monthsR=[];
        $monthCountReview=[];
        
        foreach ($data_review as $month => $values) {
            $monthsR[]=$month;
            $monthCountReview[]=count($values);
        }
        // ------------------------------------------------------//


        // ---------------- Total review per YEAR----------------//

        $data_review_year=Review::select('id', 'created_at')->where('user_id', $id)->orderBy('created_at')->get()->groupBy(function($data){
            return \Carbon\Carbon::parse($data['created_at'])->format('Y');
        });

        $yearsR=[];
        $yearCountReview=[];

        foreach ($data_review_year as $year => $values) {
            $yearsR[]=$year;
            $yearCountReview[]=count($values);
        }
        // ------------------------------------------------------//

        // ---------------- Total message per MONTH----------------//

        $data_message=Message::select('id', 'created_at')->where('user_id', $id)->get()->groupBy(function($data){
            return \Carbon\Carbon::parse($data['created_at'])->format('M');
        });

        $monthsM=[];
        $monthCountMessage=[];
        
        foreach ($data_message as $month => $values) {
            $monthsM[]=$month;
            $monthCountMessage[]=count($values);
        }
        // ------------------------------------------------------//

        // ---------------- Total message per YEAR----------------//

        $data_message_year=Message::select('id', 'created_at')->where('user_id', $id)->orderBy('created_at')->get()->groupBy(function($data){
            return \Carbon\Carbon::parse($data['created_at'])->format('Y');
        });

        $yearsM=[];
        $yearCountMessage=[];
        
        foreach ($data_message_year as $year => $values) {
            $yearsM[]=$year;
            $yearCountMessage[]=count($values);
        }
        // ------------------------------------------------------//

        return view('admin.home',compact('monthsR','monthCountReview', 'yearsR', 'yearCountReview', 'monthsM','monthCountMessage', 'yearsM', 'yearCountMessage',));
    }

    public function message(){
        // $data=Auth::user();
        $id = Auth::id();
        $data=Message::where('user_id', $id)->orderBy('created_at', 'ASC')->paginate(5);
        return view('admin.messages', compact('data'));
    }

    public function review(){
        $id = Auth::id();
        $data=Review::where('user_id', $id)->orderBy('created_at', 'ASC')->paginate(5);
        return view('admin.reviews', compact('data'));
    }

    // public function tags(){
    //     $tags = Tag::all();
    //     return view('admin.tags', compact('tags'));
    // }
}
