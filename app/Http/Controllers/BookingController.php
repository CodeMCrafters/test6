<?php

namespace App\Http\Controllers;

use App\Mail\MailSample;
use App\Mail\WorkerSample;
use App\Models\Booking;
use App\Models\Booking_Statistic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    //

    public function storeBooking(Request $request){
        $data_booking = Validator::make($request->all(),[
            'id_provide' => ['required'],
            'id_frizer' => ['required'],
            'id_salons' => ['required'],
            'id_user' => ['required'],
            'date' => ['required'],
            'time' => ['required'],
        ]);

        if($data_booking->fails()){
            return response()->json([
                'status' => '442',
                'error' =>  $data_booking->messages()
            ],422);
        }
        else{
            $booking = Booking::create([
                'id_provide'=> $request->id_provide,
                'id_salons'=> $request->id_salons,
                'id_user'=> $request->id_user,
                'date' => $request->date,
                'time'=> $request->time,
                'id_frizer' => $request->id_frizer,
            ]); 

            $userMails = new User();
            $userMail = $userMails->userEmail($request->id_user);

            $berberEmails = new User();
            $berberEmail = $berberEmails->BarberEmail($request->id_frizer);

            try {
                if($booking){
                    
                    Mail::to($userMail)->send((new MailSample($booking)));

                    Mail::to($berberEmail)->send((new WorkerSample($booking)));

                    return response()->json([
                        'booking' => $booking,
                        'status' => '200',
                        'message' => 'Booking created succussful'
                        
                    ],200);
                    

                }
                else{
                    return response()->json([
                        'status' => '500',
                        'message' => 'Booking not created',
                    ],500);
                }
            } catch (\Throwable $th) {
                dd($th);
            }
        }
    }

 

    public function showBookingUser(Request $request,$id_user){
        $id_user = $request->id_user;

        $bookingUsers = new Booking();
        $bookingUser = $bookingUsers->readBookingUser($id_user);

        if($bookingUser->count()>0){
            return response()->json([
                'satus' => 200,
                '$bookingUser' => $bookingUser,
            ],200);

        }
        else{
            return response()->json([
                'satus' => 404,
                'message' => 'Not found booking'
            ],404);
        }
    }

    public function destroy($id){
        $booking = Booking::find($id);
        if($booking){
            try {
                $booking->delete();
                return response()->json([
                    'status' => '200',
                    'message' => 'Booking deleted succussful'
                ],200);
            } catch (\Throwable $th) {
                dd($th);
            }
        }
        else{
            return response()->json([
                'status' => '404',
                'message' => 'No Such Booking found'
            ],404);
        }
        
    }

    public function statistic($id_frizer){
        $statistic = new Booking();
        $stc = $statistic->all_barber_booking($id_frizer);

        $currentDate = date('Y-m-d'); // Trenutni datum u formatu 'YYYY-MM-DD'


        if($stc){
            foreach ($stc as $b) {
                try {
                    $userBookingCount = Booking::where('id_frizer', $b->id_frizer)
                    ->whereDate('date', '<', $currentDate)
                    ->count();
                    return response()->json([
                        'status' => 200,
                        "count_booking" => $userBookingCount,
                    ],200);
                    } 
                catch (\Throwable $th) {
                    dd($th);
                }
            }
        }
        else{
            return response()->json([
                'message' => "Not found booking statistic",
                'status' => 404
                ],404);
        }
        
       

        
    }


}

