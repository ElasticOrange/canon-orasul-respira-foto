<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Hash;
use Session;

class Admin extends Model
{
    protected $fillable = [
        'email',
        'password'
    ];

    public static function login($email, $password)
    {
        $admin = self::where('email', $email)->first();
        if (Hash::check($password, $admin->password)) {
            Session::put('admin_logged', true);
            return true;
        }

        return false;
    }

    public static function logout()
    {
        Session::forget('admin_logged');
        return true;
    }


}
