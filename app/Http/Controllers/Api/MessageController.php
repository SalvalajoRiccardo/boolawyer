<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Message;

class MessageController extends Controller
{
    public function store(Request $request){

        $data = $request->all();
        
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'text' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }
       
        // salviamo i dati nella tabella
        $new_message = new Message();
        $new_message->fill($data);
        $new_message->save();

        return response()->json(['success' => true ]);
    }
}
