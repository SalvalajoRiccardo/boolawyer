<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Specialization;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        $specs = request('specialization');
        
        if(!$specs){
            $users = User::with(['specializations'])->paginate(9);
        } else {
            // $users = User::with(['specializations'])->where('id', $specs )->paginate(9);
            // $users = User::join('specialization_user', 'users.id', '=', 'specialization_user.user_id')->where('specialization_id',$specs)->select('users.*')->get();
        
        $users = DB::table('users')
        ->join('specialization_user', 'users.id', '=', 'specialization_user.user_id')
        ->where('specialization_id',$specs)
        ->select('users.*')
        ->get();
    
        }

        

        
        foreach($users as $user){
            if($user->photo){
                $user->photo = url('storage/' . $user->photo); 
            }
        }

        foreach($users as $user){
            if($user->cv){
                $user->cv = url('storage/' . $user->cv); 
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

            if($user->cv){
                $user->cv = url('storage/' .$user->cv);
            }

            return response()->json([
                'success' => true,
                'results' => $user
            ]);
        }
    }

    // // public function searchData($data){
    // //     dd($data);

        
    //     // $user_query= User::with(['specializations']);
    //     // if ($data) {
    //     //     $user_query->whereHas('specializations', function($query) use($data){
    //     //         $query->where('name',$data );
    //     //     });
    //     // }
        
    //     // $user= $user_query->get();
    //     // return response()->json([
    //     //     'success' => true,
    //     //     'results' => $user
    //     // ]);
    // // }

   
}
