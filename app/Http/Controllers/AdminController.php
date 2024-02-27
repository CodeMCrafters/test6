<?php

namespace App\Http\Controllers;

use App\Models\Salon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class AdminController extends Controller
{    //

    public function index(){
        $id_salon = '1';

        $barbers = new User();
        $barber = $barbers->showBarbers($id_salon);
        //Ovde se ubacuje putanja do pocetne strane za admin u return!!!

        if($barber->count()>0){
            return  response()->json([
            'status' =>200,
            'barber' => $barber
        ],200);
        }
        else{
            return response()->json([
                'status' => 404,
                'message'=> 'No Records Found'
            ],404);
        }
    }

    public function destroy($id){
        $barber = User::findOrFail($id);

        if($barber){
            try {
                $barber->delete();

                return response()->json([
                    'status' => '200',
                    'message' => 'Barber deleted successful'
                ],200);
            } catch (\Throwable $th) {
                dd($th);
            }
        }
        else{
            return response()->json([
                'status' => '404',
                'message' => 'No Such Product found'
            ],404);
        }
    }

    public function storeBarbers(Request $request){
        $data_barber = Validator::make($request->all(),[
            'name'=>['required'],
            'surname' =>['required'],
            'flag'=>['required'],
            'email' =>['required'],
            'phone' =>['required'],
            'smena' =>['required'],
            'password' =>['required'],
            'id_salon' =>['required']
        ]);

        if($data_barber->fails()){
            return response()->json([
                'status' => '442',
                'error' =>  $data_barber->messages()
            ],422);
        }
        else{
            $data_barber=User::create([
                'name' => $request->name,
                'surname' =>$request->surname,
                'flag'=>$request->flag,
                'email' =>$request->email,
                'phone' =>$request->phone,
                'smena' =>$request->smena,
                'password' =>$request->password,
                'id_salon' => $request->id_salon,
            ]);

            try {
                if($data_barber){
                    return response()->json([
                        'data' =>$data_barber,
                        'status' => '200',
                        'message' => 'Barber created succussful'
                        
                    ],200);
                }
                else{
                    return response()->json([
                        'status' => '500',
                        'message' => 'Barber not created',
                    ],500);
                }
            } catch (\Throwable $th) {
                dd($th);
            }
        }
    }

    public function showSalon(){
        $salons = new Salon();

        $salon = $salons->showSalon();

        if($salon->count() > 0){
            return response()->json([
                'status' => "200",
                'message' => $salon
            ],200);
        }
        else{
            return response()->json([
                'status' => "404",
                'message' => "Salon not exsist"
            ]);
        }
    }
}
