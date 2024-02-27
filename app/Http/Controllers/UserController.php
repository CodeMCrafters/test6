<?php

namespace App\Http\Controllers;

use App\Mail\VerificationMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{

   


    public function store(Request $request){
        $data_user = Validator::make($request->all(),[
            'name' =>['required'],
            'surname' =>['required'],
            'email'=>['required','unique:users,email,except,id'],
            'flag'=>['required'],
            'password'=>['required'],
            'phone'=>['required'],
        ]);

        if($data_user->fails()){
                        return response()->json([
                            'status' => '442',
                            'error' => $data_user->messages()
                        ],442);
                    }
                    else{
                        $user = User::create([
                            'name'=>$request->name,
                            'surname'=>$request->surname,
                            'email'=>$request->email,
                            'flag'=>$request->flag,
                            'password'=>$request->password,
                            'phone'=>$request->phone,

                        ]);
                    }

        try {
           if($user){
            $user->sendEmailVerificationNotification();
            Mail::to($request->email)->send(new VerificationMail());
                return response()->json([
                    'status' => '200',
                    'message' => 'User Created Successful'
                ],200);
           }
           else{
                return response()->json([
                    'status' => '500',
                    'message' => 'User not created'
                ],500);
           }

        } catch (\Throwable $th) {
            dd($th);
        }
    }
    
}
