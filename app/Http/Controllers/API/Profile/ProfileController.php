<?php

namespace App\Http\Controllers\API\Profile;

use App\Http\Controllers\Controller;
use App\Trait\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    use ApiResponse;

    public function profileDetails()
    {
        try {
            $user = Auth::user();
            return $this->success('Data get Successfully',$user);
        }catch (\Exception $e){
            return $this->error($e->getMessage());
        }
    }
}
