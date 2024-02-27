<?php

namespace App\Http\Controllers;

use App\Models\Provide;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class SalonController extends Controller
{
    //

   

    public function index(Request $request){
        $id = $request->id;
    
        try {
            // Pokušaj pronaći red u bazi prema ID-u
            $provides = Provide::select('id','id_salon', 'name', 'price', 'time')->where('id_salon',$id)->get();

    
            // Ako red postoji, vrati podatke
            return response()->json([
                'status' => 200,
                'provide' => $provides,
            ], 200);
        } catch (ModelNotFoundException $exception) {
            // Ako red nije pronađen, vrati odgovarajuću poruku
            return response()->json([
                'status' => 404,
                'message' => 'No Records Found'
            ], 404);
        }  
    }



    public function sisarkica(Request $request,$id){
        $id = $request->id;
        return response()->json([
            'status' => 200,
            'id' => $id
        ],200);
    }
}
