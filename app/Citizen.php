<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Citizen extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'citizens';

    protected $fillable = [
        'name', 'password', 'aadhaar','mobile',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function family(){
      return $this->hasOne('App\FamilyDetail');
    }

    public function member()
    {
      return $this->hasOne('App\Member');
    }
}
