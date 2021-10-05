<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users =User::paginate(10);
        return response()->json([
            'success' => true,
            'results' => $users
        ]);
    }

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $user = User::where('slug', $slug)->with('specializations')->first();
        if($user){
            if($user->photo){
                $user->photo = url('storage/' .$user->photo);
            }

            return response()->json([
                'success' => true,
                'results' => $user
            ]);
        }
    }

   
}
