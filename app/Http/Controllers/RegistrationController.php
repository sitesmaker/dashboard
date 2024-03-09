<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    function addUser(Request $request) {
        $User = new User;
        $email =$request->get('email');
        $password = $request->get('password');
    
        $User->email = $email;
        $User->password = $password;
    
        $User->save();
    }
}
