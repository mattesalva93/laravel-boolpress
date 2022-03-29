<?php

namespace App\Http\Controllers\Api;

use App\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request){
        $data = $request->all();
        
        $validator = Validator::make($data, [
            'name'=>'nullable|string',
            'testo'=>'required|string',
            'post_id'=>'exists:posts,id'
        ]);
        // if ($validator->fails()){
        //     dd($validator->errors());
        //     return response()->json([
        //         "success" => false,
        //         "errors" => $validator->errors(),
        //         "data" => $data            
        //     ], 400);/api/comments/
        // }

        $nuovoCommento = new Comment();
        if( !empty( $data["name"]) ) {
            $nuovoCommento->name = $data["name"];
        }
        $nuovoCommento->testo = $data["testo"];
        $nuovoCommento->post_id = $data["post_id"];
        $nuovoCommento->save();

        return response()->json([
            "success" => true
        ]);
    }
}
