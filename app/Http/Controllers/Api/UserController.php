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
    public function index(Request $request)
    {
        $data = $request->all();
        
        // $users = User::with(['specializations'])->paginate(9);
        if($data) {
            $users = User::with(['specializations'])->where('name', $data)->paginate(9);
           
        } else {
            $users = User::with(['specializations'])->paginate(9);
        }
       
        
        foreach($users as $user){
            if($user->photo){
                $user->photo = url('storage/' . $user->photo); 
            }
        }
        
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
