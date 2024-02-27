<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{

    use HasFactory;

    protected $fillable = [
        'id_provide',
        'id_frizer',
        'id_salons',
        'id_user',
        'date',
        'time',
    ];

    

    public function showBooking($date,$id_salons,$id_frizer){
        
        return $this->where('date' , $date)->where('id_salons',$id_salons)->where('id_frizer',$id_frizer)->get();

    }

    

    public function showBookingBerbers($date,$id_frizer){
        return $this->select('id','id_provide','date','time','id_user')
        ->where('date',$date)
        ->where('id_frizer',$id_frizer)
        ->with('userTable')
        ->get();
    }

    public function userTable(){
        return $this
        ->belongsTo(User::class,'id_user','id');
    }

    public function readBookingUser($id_user){
        return $this->select('id','id_provide','id_frizer','date','time','id_user')
            ->where('id_user', $id_user)
            ->with('provideTable','barbersTable')
            ->get();
    }

    public function provideTable(){
        return $this->belongsTo(Provide::class, 'id_provide', 'id');
    }

    public function barbersTable(){
        return $this->belongsTo(User::class, 'id_frizer', 'id')->where('flag','frizer');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function user_read($id_frizer){
        return $this->get();
    }

    public function all_barber_booking($id_frizer){
        return $this->select('id_frizer','date','time')->where('id_frizer',$id_frizer)->get();
    }

   
}
