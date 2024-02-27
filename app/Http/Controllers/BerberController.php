<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Http\Request;

class BerberController extends Controller
{
    //
    public function index(Request $request,$date,$id_frizer){

        $date = $request->date;
        $id_frizer = $request->id_frizer;

        $bookings = new Booking();
        $booking = $bookings->showBookingBerbers($date,$id_frizer);

        try {
            if($booking->count()>0){
            return  response()->json([
                'status' =>200,
                'barber' => $booking
            ],200);
            }
            else{
                return response()->json([
                    'status' => 404,
                    'message'=> 'No Records Found'
                ],404);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 400,
                'message'=> 'No Records Found'
            ],400);
        }
        
        
        
    }

    public function show(Request $request,$id_salon){
        $id_salon = $request->id_salon;

        try {
            $barber = User::where('id_salon',$id_salon)->get();


            return response()->json([
                'status'=> 200,
                'barber' => $barber,
                
            ],200);
            
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 404,
                'message' => 'No Records Found'
            ], 404);
        }
        
    }

    public function searchBooking(Request $request,$id_salons,$id_frizer){
       

        $date = $request->date;
        $id_salons = $request->id_salons;
        $id_frizer = $request->id_frizer;


        $bookings = new Booking();
        $booking = $bookings->showBooking($date,$id_salons,$id_frizer);
        
        if($booking->count()>0){
            return  response()->json([
                'status' =>200,
                'barber' => $booking
            ],200);
            }
            else{
                return response()->json([
                    'status' => 404,
                    'message'=> 'No Records Found'
                ],404);
            }
        
    }

    public function showShift(Request $request,$id_salon,$id_frizer){
        $id_frizer = $request->id_frizer;
        $id_salon = $request->id_salon;
        $shifts = new User();
        $shift = $shifts->shiftBarber($id_frizer,$id_salon);

        try {
            if($shift){
                return response()->json([
                    'status' => 200,
                    'shift' => $shift
                ],200);
            }
            else{
                return response()->json([
                    'status' => 404,
                    'message'=> 'No Records Found'
                ],404);
            }
        } catch (\Throwable $th) {
            dd($th);
        }
        
    }
}
