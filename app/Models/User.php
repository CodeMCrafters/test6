<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Messages\VonageMessage;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    
    protected $fillable = [
        'name',
        'surname',
        'email',
        'flag',
        'password',
        'phone',
        'smena',
        'id_salon',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function showBarbers($id_salon){
        return $this->select('id','name','surname','email','phone','smena')->where('flag','frizer')->where('id_salon', $id_salon)->get();
    }


    public function shiftBarber($id_frizer,$id_salon){
        return $this->where('id',$id_frizer)->where('id_salon',$id_salon)->value('smena');
    }

    public function getData($email){
        return $this->where('email',$email)->select('email','phone','name','surname','flag','id')->get();
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($user) {
            if ($user->flag === 'frizer') {
                $user->bookings()->delete();
            }
        });
    }

    public function bookings()
    {
        return $this->hasMany('App\Models\Booking', 'id_frizer');
    }

    public function userEmail($id_user){
    // Pronađi korisnika na osnovu id_user iz tabele Booking
    $user = User::find($id_user);
    // Ako korisnik postoji, vrati njegov email, inače vrati null
    return $user ? $user->email : null;
    }

    public function userBarber($id_frizer){
        $barber = User::find($id_frizer);

        return $barber ? $barber->name : null;
    }

    public function BarberEmail($id_frizer){
        $barber = User::find($id_frizer);

        return $barber ? $barber->email : null;
    }
 
}
