<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;

class HomeController extends Controller
{
    
    public function index(){
        return view('admin.home');
    }

    public function message(){
        $data=Auth::user();
        return view('admin.messages', compact('data'));
    }

    public function review(){
        $data=Auth::user();
        return view('admin.reviews', compact('data'));
    }

    // public function tags(){
    //     $tags = Tag::all();
    //     return view('admin.tags', compact('tags'));
    // }
}
