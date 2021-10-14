<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Review;

class ReviewController extends Controller
{
    public function store(Request $request){

        $data = $request->all();
        
        $validator = Validator::make($request->all(), [
            'reviewer' => 'required',
            'vote' => 'required|numeric|min:1|max:5',
            'text' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }
       
        // salviamo i dati nella tabella
        $new_review = new Review();
        $new_review->fill($data);
        $new_review->save();

        return response()->json(['success' => true ]);
    }
}
