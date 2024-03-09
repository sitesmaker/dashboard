<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;

class ProfileController extends Controller
{
    function getProfileData(Request $request): \Illuminate\Http\JsonResponse
    {
        $user_id = $request->get('user_id');
        $profile_data = Profile::all()->where('user_id', $user_id)->first();
        
        return response()->json($profile_data);
    }
}
