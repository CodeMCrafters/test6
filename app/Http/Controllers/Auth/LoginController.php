<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function login(Request $request){

        $request->validate([
            'email' => ['required','email'],
            'password' => ['required']
        ]);

        $formLog = $request->only('email','password');

        $dataUsers = new User();
        $dataUser = $dataUsers->getData($request->email);

        if(Auth::attempt($formLog)){
            $user = Auth::user();

            if($user->flag === 'admin'){
                return response()->json([
                    'status' => '200',
                    'dataUser' => $dataUser
                ],200);
            }
            elseif($user->flag === 'frizer'){
                return response()->json([
                    'status' => '200',
                    'dataUser' => $dataUser

                ],200);
            }
            elseif($user->flag === 'user'){
                return response()->json([
                    'status' => '200',
                    'dataUser' => $dataUser
                ],200);
            }


        }
        
        return response()->json(['error' => 'Neuspela autentikacija'], 401);

    }
}
