<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'PEGAWAI';
    protected $primaryKey = 'id_pegawai';
    public $incrementing = false; // Jika ID-nya bukan auto-increment angka
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'username',
        'password',
        'role'
    ];

    protected $hidden = [
        'password'
    ];

    public function getAuthPassword(){
        return $this->password;
    }
}
