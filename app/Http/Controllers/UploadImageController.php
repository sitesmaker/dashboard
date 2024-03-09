<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class UploadImageController extends Controller
{
    function save(Request $request) {
        $id = $request->get('id');
        $name = $request->file('avatar')->getClientOriginalName();
        $path = $request->file('avatar')->storeAs('uploads/avatars/' . $id, $name);
    
        $profile = Profile::all()->where('user_id', $id)->first();
        
        $profile->avatar = $path;
        $profile->save();
    
        if($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $file->move(public_path() . '/uploads/avatars/' . $id, $name);
        }
    }
}
