<?php

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pegawai extends Authenticatable
{
    protected $table = 'PEGAWAI';
    protected $primaryKey = 'ID_PEGAWAI';
    public $timestamps = false;
    protected $fillable = [
        'USERNAME',
        'PASSWORD',
        'ROLE'
    ];

    protected $hidden = [
        'PASSWORD'
    ];

    public function getAuthPassword(){
        return $this->PASSWORD;
    }

    // Sesuaikan kolom password jika namanya bukan 'password' di Oracle
    // public function getAuthPassword() { return $this->PASSWORD; }
}
